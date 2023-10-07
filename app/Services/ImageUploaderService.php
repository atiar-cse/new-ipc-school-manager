<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploaderService
{
    public static  function upload(UploadedFile $file, $folder = 'images')
    {
        $fileName = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();

        // Store the file in the specified folder
        $file->storeAs($folder, $fileName, 'public');
        return $folder . '/' . $fileName;
    }
}
