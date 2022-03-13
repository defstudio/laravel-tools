<?php /** @noinspection PhpUnused */

namespace DefStudio\Tools\Concerns;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait BackupsAttributes
{
    protected array $_attributes_backup = [];

    public static function bootBackupsAttributes(): void
    {
        self::retrieved(function (self $model) {
            $model->_attributes_backup = $model->attributesToArray();
        });
    }

    public function get_backup(string $attribute): mixed
    {
        return $this->_attributes_backup[$attribute] ?? null;
    }
}
