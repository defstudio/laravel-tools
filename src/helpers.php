<?php

use App\Models\User;
use Illuminate\Http\RedirectResponse;

if (!function_exists('user')) {
    function user(): User|null
    {
        return Auth::user();
    }
}

if (!function_exists('str')) {
    /**
     * Get a new stringable object from the given string.
     *
     * @param  string|\Illuminate\Support\Stringable  $string  $string
     *
     * @return \Illuminate\Support\Stringable
     */
    function str(null|string|\Illuminate\Support\Stringable $string): \Illuminate\Support\Stringable
    {
        return \Illuminate\Support\Str::of($string ?? '');
    }
}

if (!function_exists('back')) {
    function back($status = 302, $headers = [], $fallback = false): RedirectResponse
    {
        if (request()->has('referer')) {
            return app('redirect')->to(request()->referer, $status, $headers);
        }
        return app('redirect')->back($status, $headers, $fallback);
    }
}
