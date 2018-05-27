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

    private static $directory = '/public/images/projects/';

    /**
     * @param string $image
     * @return bool|null|string
     * return string (the path to file) if there was one, return null if extensions are incorrect and return false if no file were uploaded.
     */
    public static function uploadImage (string $image, string $path = null) {
        if (is_uploaded_file($_FILES[$image]['tmp_name'])) {
            if (in_array($_FILES[$image]['type'], self::$extensions, true)) {
                $imageUniqueName = uniqid() . $_FILES[$image]['name'];
                if ($path === null) {
                    move_uploaded_file($_FILES[$image]['tmp_name'], '..' . self::$directory . $imageUniqueName);
                    return $imagePath = self::$directory . $imageUniqueName;
                }
                move_uploaded_file($_FILES[$image]['tmp_name'], '..' . $path . $imageUniqueName);
                return $imagePath = $path . $imageUniqueName;
            }
            return null;
        }
        return false;
    }

    /**
     * @param string $image
     * delete a file. The path is needed.
     */
    public static function deleteImage (string $imagePath) {
        unlink($imagePath);
    }

}