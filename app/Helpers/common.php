<?php

use App\Models\GeneralSetting;

/** Site Information */

if (!function_exists('settings')) {
    function settings()
    {
        $settings = GeneralSetting::take(1)->first();
        if (!is_null($settings)) {
            return $settings;
        }
    }
}
