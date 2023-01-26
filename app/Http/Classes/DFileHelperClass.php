<?php

namespace App\Http\Classes;

class DFileHelperClass
{
    public static function getRandomFileName(string $path, string $file_name): string
    {
        $extension = strtolower(substr(strrchr($file_name, '.'), 1));
        $path = $path ? $path : '';
 
        do {
            $name = md5(microtime() . rand(0, 9999)) . '.' . $extension;
            $file_name = $path . $name;
        } while (file_exists($file_name));
 
        return $name;
    }
}
