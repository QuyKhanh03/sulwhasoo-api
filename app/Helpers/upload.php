<?php
// upload image to
//URL_PREFIX="https://khanh-pham-laravel-project.s3.eu-west-2.amazonaws.com/"

use Illuminate\Support\Facades\Storage;

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


?>
