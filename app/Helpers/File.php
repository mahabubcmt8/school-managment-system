<?php

namespace App\Helpers;

use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


trait File
{

    public function fileUpload($file, $path)
    {
        if ($file) {
            $image = $file;
            $extension = $image->getClientOriginalExtension();
            $image_name = time() . uniqid() . '.' . $extension;
            $path = $file->storeAs($path, $image_name);
            return $image_name;
        }
    }
}
