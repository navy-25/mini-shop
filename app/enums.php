<?php
date_default_timezone_set('Asia/Jakarta');

if (!function_exists('statusCategory')) {
    function statusCategory($status = '')
    {
        $list_status = [
            1 => 'Aktif',
            0 => 'Non Aktif',
        ];
        return $status == '' ? $list_status : $list_status[$status];
    }
}

if (!function_exists('statusProduct')) {
    function statusProduct($status = '')
    {
        $list_status = [
            1 => 'Aktif',
            0 => 'Non Aktif',
        ];
        return $status == '' ? $list_status : $list_status[$status];
    }
}
