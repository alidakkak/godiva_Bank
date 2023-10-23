<?php

namespace App\Http\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

trait AttachFilesTrait
{
    function uploade_image($name, $path, $file){
        $extension=$file->extension();
        $newimg=time()."-".$name.".".$extension;
        $file->move($path,$newimg);
        return $path ."/". $newimg;
    }

    function deleteFile($filePath)
    {
        if (File::exists($filePath)) {
            File::delete($filePath);

        }

    }
}
