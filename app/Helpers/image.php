<?php

if (!function_exists('imageUpload')) {
    function imageUpload($image, $path = null, $wh = [], $watermark = false, $deleteImage = false, $fullpath = null)
    {
        if (!empty($wh)) {
            $wh = [
                'w' =>  $wh[0],
                'h' =>  $wh[1],
            ];
        }
        if ($deleteImage !== false) {
            DeleteImage($fullpath);
        }

        return SalokaUploads($image, 'image', $path, $wh, false, $watermark);
    }
}

if (!function_exists('fileUpload')) {
    function fileUpload($image, $path = null, $deleteFile = false, $fullpath = null)
    {
        if ($deleteFile !== false) {
            DeleteFile($fullpath);
        }
        return SalokaUploads($image, 'file', $path);
    }
}

if (!function_exists('base64Uploud')) {
    function base64Uploud($file, $path = null, $wh = [], $watermark = false)
    {
        if (!empty($wh)) {
            $wh = [
                'w' =>  $wh[0],
                'h' =>  $wh[1],
            ];
        }
        return SalokaUploads($file, 'image', $path, [], true, $watermark);
    }
}

if (!function_exists('SalokaUploads')) {
    function SalokaUploads($file, $type = 'image', $path = null, $wh = [], $base64 = false, $watermark = false)
    {
        $destinationPath = (is_null($path)) ? 'uploads' : 'uploads/' . $path;
        if (!is_dir($destinationPath)) {
            mkdir($destinationPath, 0755, true);
        }
        if ($type != 'image') {
            // $filename = time() . rand(10000, 99999) . '.' . $file->getClientOriginalExtension();
            $filename = $file->getClientOriginalName();
            $path     = $destinationPath;
            $file->move($destinationPath, $filename);
            return $destinationPath . '/' . $filename;
        }
        if ($base64 == true) {
            $input = time() . rand(10000, 99999) . '.webp';
            $file = \Image::make(base64_decode($file));
        } else {
            $input = time() . rand(10000, 99999) . '.webp';
            $file = \Image::make($file->getRealPath());
        }
        if (!empty($wh)) {
            $file->resize($wh['w'], $wh['h']);
        }
        if ($watermark == true) {
            $file->insert('/test.png');
        }
        $file->save($destinationPath . '/' . $input);
        return $destinationPath . '/' . $input;
    }
}

if (!function_exists('DeleteImage')) {
    function DeleteImage($path)
    {
        if(!is_null($path)){
            $path = str_replace('/', '\\', $path);
            $path = public_path($path);
            if (file_exists($path)) {
                unlink($path);
            }
            return true;
        }else{
            return false;
        }
    }
}

if (!function_exists('DeleteFile')) {
    function DeleteFile($path)
    {
        if(!is_null($path)){
            $path = str_replace('/', '\\', $path);
            $path = public_path($path);
            if (file_exists($path)) {
                unlink($path);
            }
            return true;
        }else{
            return false;
        }
    }
}
