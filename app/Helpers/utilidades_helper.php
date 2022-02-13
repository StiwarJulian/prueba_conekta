<?php

if (!function_exists("extraerMenuJson")) {
    function extraerMenuJson()
    {
        $menu = json_decode(file_get_contents(APPPATH . '/views/platform/json/menu.json'), true);
        return $menu;
    }
}
