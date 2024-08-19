<?php
// upload image to

if(!function_exists('uploadImage')){
    function uploadImage($file){
        $path = $file->storePublicly('uploads');
        return getenv('URL_PREFIX').$path;
    }
}

?>
