<?php
namespace niluap\core;

/**
 * Class File
 * @package niluap\core
 * The class manages the upload of projects' pictures.
 * It could easily be extended to manage all kind of files to upload.
 */
class File {

    private static $extensions = [
        'image/png',
        'image/jpeg'
    ];

    private static $directory = '../public/images/projects/';

    public static function uploadImage (string $image) {
        if (is_uploaded_file($_FILES[$image]['tmp_name']) && in_array($_FILES[$image]['type'], self::$extensions, true)) {
            $imageUniqueName = uniqid($_FILES[$image]['name']);
            move_uploaded_file($_FILES[$image]['tmp_name'], self::$directory . $imageUniqueName);
            return $imagePath = '/public/images/projects/' . $imageUniqueName;
        }
        return null;
    }

    public static function deleteImage (string $image) {
        unlink($image);
    }

}