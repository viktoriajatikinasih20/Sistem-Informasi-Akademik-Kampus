<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'setting';

    protected $fillable = ['key', 'value'];

    public $timestamps = false;

    public static function getValue(string $key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function setValue(string $key, $value): bool
    {
        $setting = self::updateOrCreate(
            ['key' => $key],
            ['value' => $value]
        );

        return (bool) $setting;
    }
}
