<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Interface FileServiceInterface
 * @package App\Service
 */
interface FileServiceInterface
{
    /**
     * @param string $pathUpload
     * @param UploadedFile $uploadedFile
     * @return string
     */
    public function upload(string $pathUpload, UploadedFile $uploadedFile): string;

    /**
     * @param string $path of the file
     * @param string $name of the file
     */
    public function delete(string $path, string $name): void;
}
