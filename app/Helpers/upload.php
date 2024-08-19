<?php
// upload image to
//URL_PREFIX="https://khanh-pham-laravel-project.s3.eu-west-2.amazonaws.com/"

if(!function_exists('uploadImage')){
    function uploadImage($file){
        $path = $file->storePublicly('uploads');
        return getenv('URL_PREFIX').$path;
    }
}

?>
