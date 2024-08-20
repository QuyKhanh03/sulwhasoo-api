<?php
// upload image to
//URL_PREFIX="https://khanh-pham-laravel-project.s3.eu-west-2.amazonaws.com/"

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

if(!function_exists('uploadImage')){
    function uploadImage($file){
        $path = $file->storePublicly('uploads');
        return getenv('URL_PREFIX').$path;
    }
}

//delete image from s3
if (!function_exists('deleteImage')) {
    function deleteImage($filePath)
    {
        // Remove the URL_PREFIX from the path if it exists
        $path = str_replace(getenv('URL_PREFIX'), '', $filePath);
        // Delete the file from S3
        if (Storage::disk('s3')->exists($path)) {
            Storage::disk('s3')->delete($path);
            return true;
        }
        return false;
    }
}


//encryption image from s3
if (!function_exists('encryptImage')) {
    function encryptImage($filePath)
    {
        // Remove the URL_PREFIX from the path if it exists
        $path = str_replace(getenv('URL_PREFIX'), '', $filePath);
        // Encrypt the file from S3
        if (Storage::disk('s3')->exists($path)) {
            $encrypted = Storage::disk('s3')->get($path);
            return $encrypted;
        }
        return false;
    }
}


if (!function_exists('createSlug')) {
    function createSlug($string)
    {
        $string = Str::ascii($string);
        $slug = Str::slug($string);
        return $slug;
    }
}
?>
