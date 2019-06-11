<?php

namespace Files;

/**
 * Class UploadFile
 *
 * @package UploadFiles
 */
class FileUploader
{
    /**
     * Move file to Files folder
     *
     * @return string|null
     */
    public function moveFileToFolder(): ?string
    {
        $fileName = $_FILES['jsonFile']['name'];
        $tempName = $_FILES['jsonFile']['tmp_name'];
        if (isset($fileName) && !empty($fileName)) {
            $location = "Files/";
            $file = $location . $fileName;
            move_uploaded_file($tempName, $file);
        }
        return $file;
    }
}
