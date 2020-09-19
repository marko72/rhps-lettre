<?php
/**
 * Created by PhpStorm.
 * User: mradi
 * Date: 3/15/2019
 * Time: 1:39 PM
 */

namespace App\Helpers;


use Illuminate\Http\UploadedFile;

class UploadFile
{
    public static function move(UploadedFileFile $request){
        $fileWithExtension = $request->getClientOriginalName();
        $fileName = pathinfo($fileWithExtension,PATHINFO_FILENAME);
        $extension = $request->guessClientExtension();
        $source = time() . $fileName . "." . $extension;
        $path = "images/news" . $source;
        $request->move(public_path('images'),$path);
        return ['path' => $path];
    }
}