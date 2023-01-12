<?php /** @noinspection PhpUnused */

namespace DefStudio\Tools\Concerns\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @mixin Model
 */
trait BackupsAttributes
{
    protected static bool $_attributes_backup_enabled = true;
    protected array $_attributes_backup = [];

    public static function bootBackupsAttributes(): void
    {
        self::retrieved(function (self $model) {
            if(!self::$_attributes_backup_enabled){
                return;
            }

            $model->_attributes_backup = $model->attributesToArray();
        });

        self::created(function (self $model) {
            if(!self::$_attributes_backup_enabled){
                return;
            }

            $model->_attributes_backup = $model->attributesToArray();
        });
    }

    public static function disableAttributesBackup(): void
    {
        self::$_attributes_backup_enabled = false;
    }

    public function get_backup(string $attribute): mixed
    {
        return $this->_attributes_backup[$attribute] ?? null;
    }
}
