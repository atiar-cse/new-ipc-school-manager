<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class ImageUploaderService
{
    public static  function upload(UploadedFile $file, $folder = 'images')
    {
        // Generate a unique file name
        // uniqid() . '_' . 
        $fileName = time() . '.' . $file->getClientOriginalExtension();

        // Store the file in the specified folder
        $file->storeAs($folder, $fileName, 'public');

        // Return the path to the uploaded image
        return $folder . '/' . $fileName;
    }
}
