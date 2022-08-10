<?php

use \Illuminate\Support\Str;

function uploadImage($folder, $file)
{
    $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();
    $file->move(public_path($folder), $filename);
    $path = $folder . $filename;
    return $path;
}

function getFloder()
{
    return app()->getLocale() == 'ar' ? 'style-rtl' : 'style';
}
