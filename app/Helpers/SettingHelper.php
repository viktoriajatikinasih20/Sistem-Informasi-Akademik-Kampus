<?php

use App\Models\Setting;

if (!function_exists('setting')) {
    /**
     * Ambil atau simpan setting.
     * 
     * @param string|array|null $key
     * @param mixed $default
     * @return mixed|null
     */
    function setting($key = null, $default = null)
    {
        if (is_null($key)) {
            return null;
        }

        if (is_array($key)) {
            // Simpan banyak setting sekaligus
            foreach ($key as $k => $v) {
                Setting::setValue($k, $v);
            }
            return true;
        }

        // Ambil setting
        return Setting::getValue($key, $default);
    }
}
