<?php

namespace DefStudio\Tools\Helpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class Classmap
{
    protected $composer;
    protected $base_path;

    public static function make(): self
    {
        return new self();
    }

    public function __construct()
    {
        $this->composer = require base_path('vendor/autoload.php');
        $this->base_path = app_path();
    }

    public function classes(string $filter = null): Collection
    {
        $classes = array_merge($this->composer->getClassMap(), $this->listClassesInPsrMaps());

        return collect($classes)
            ->keys()
            ->when(
                $filter,
                fn (Collection $collection) => $collection ->filter(fn(string $class) => str($class)->startsWith($filter))
            );
    }

    /** @return array<string, mixed> */
    private function listClassesInPsrMaps(): array
    {
        // TODO: This is incorrect. Doesnt list all fqcns. Need to parse namespace? e.g. App\LoginController is wrong

        $prefixes = array_merge(
            $this->composer->getPrefixes(),
            $this->composer->getPrefixesPsr4()
        );

        $classes = [];

        foreach ($prefixes as $namespace => $directories) {
            foreach ($directories as $directory) {
                if (file_exists($directory)) {
                    $files = (new Finder)
                        ->in($directory)
                        ->files()
                        ->name('*.php');

                    foreach ($files as $file) {
                        if ($file instanceof SplFileInfo) {
                            $fqcn = $this->getFullyQualifiedClassNameFromFile($namespace, $file);

                            $classes[$fqcn] = $file->getRelativePathname();
                        }
                    }
                }
            }
        }

        return $classes;
    }


    protected function getFullyQualifiedClassNameFromFile(string $rootNamespace, SplFileInfo $file): string
    {
        $class = trim(str_replace($this->base_path, '', (string)$file->getRealPath()), DIRECTORY_SEPARATOR);

        $class = str_replace(
            [DIRECTORY_SEPARATOR, 'App\\'],
            ['\\', app()->getNamespace()],
            ucfirst(Str::replaceLast('.php', '', $class))
        );

        return $rootNamespace . $class;
    }
}
