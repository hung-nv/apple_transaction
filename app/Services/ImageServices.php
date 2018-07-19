<?php

namespace App\Services;

use Illuminate\Support\Facades\File as File;

class ImageServices
{
    /**
     * Copy image
     * string $srcImage : image path
     * @return string
     */
    public function copyImage($srcImage)
    {
        $pathImage = '';

        if ($srcImage && File::exists(public_path($srcImage))) {
            // get folder to upload
            $folderUpload = $this->getFolderUpload($srcImage);

            // set folder to save
            $folderPath = $this->setFolderUpload($folderUpload);

            // get and create container folder if needed
            if (!is_dir(public_path($folderPath))) {
                File::makeDirectory(public_path($folderPath), intval(0755, 8), true);
            }

            // set file name
            $fileName = date('YmdHis', time()) . '-' . $this->getImageNameByPath($srcImage);

            // copy file to same path
            if (File::copy(public_path($srcImage), public_path($folderPath) . $fileName)) {
                $pathImage = $folderPath . $fileName;
            }
        }

        return $pathImage;
    }

    /**
     * Upload image
     * @param $file : instance of file upload
     * @param string $folderUpload : folder name
     * @param string $name : image name
     * @return bool|string
     */
    public function uploads($file, $folderUpload, $name)
    {
        //name of uploaded file
        $pathinfo = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);

        //extension
        $extension = $file->getClientOriginalExtension();

        //set folder to save
        $folderPath = $this->setFolderUpload($folderUpload);

        //get and create container folder if needed
        if (!is_dir(public_path($folderPath))) {
            File::makeDirectory(public_path($folderPath), intval(0755, 8), true);
        }

        if (isset($name) && $name) {
            $fileName = $name;
        } else {
            $fileName = date('YmdHis', time()) . '-' . str_slug($pathinfo) . '.' . $extension;
        }

        //save image to path
        if ($file->move(public_path($folderPath), $fileName)) {
            return $folderPath . $fileName;
        } else {
            return false;
        }
    }

    /**
     * Make folder to upload image
     * @param string $folderUpload
     * @param int $level
     * @return string
     */
    private function setFolderUpload($folderUpload, $level = 2)
    {
        //remove special char
        $folder = str_replace(' ', '-', $folderUpload); // Replaces all spaces with hyphens.
        $imagePath = '/uploads/' . strtolower(preg_replace('/[^A-Za-z0-9\-]/', '', $folder)) . '/';

        switch ($level) {
            case 1:
                $folderPath = $imagePath . date('Y', time()) . '/';
                break;
            case 2:
                $folderPath = $imagePath . date('Y', time()) . '/' . date('m', time()) . '/';
                break;
            case 3:
                $folderPath = $imagePath . date('Y', time()) . '/' . date('m', time()) . '/' . date('d', time()) . '/';
                break;
            default:
                $folderPath = $imagePath . date('Y', time()) . '/' . date('m', time()) . '/' . date('d', time()) . '/';
        }

        return $folderPath;
    }

    /**
     * Delete image
     * @param string $srcImage
     */
    public function deleteImage($srcImage)
    {
        if ($srcImage && file_exists(public_path($srcImage))) {
            File::delete(public_path($srcImage));
        }
    }

    /**
     * @param $srcImage
     * @return mixed
     */
    private function getFolderUpload( $srcImage ) {
        $srcImage = explode( '/', $srcImage );

        return $srcImage[2];
    }

    /**
     * @param $srcImage
     * @return array|string
     */
    private function getImageNameByPath( $srcImage ) {
        $srcImage    = explode( '/', $srcImage );

        $originImage = array_last( $srcImage );

        $image       = explode( '-', $originImage );

        array_shift( $image );

        $image = implode( '-', $image );

        return $image;
    }
}