<?php

namespace App\Service;

use Gedmo\Sluggable\Util\Urlizer;
use Symfony\Component\HttpFoundation\File\UploadedFile;

/**
 * Class FileService
 * @package App\Service
 */
class FileService implements FileServiceInterface
{
    /**
     * @inheritDoc
     */
    public function upload(string $pathUpload, UploadedFile $uploadedFile): string
    {
        $originalFilename = pathinfo($uploadedFile->getClientOriginalName(), PATHINFO_FILENAME);
        $newFilename = Urlizer::urlize($originalFilename) . '-' . uniqid() . '.' . $uploadedFile->guessExtension();

        $uploadedFile->move($pathUpload, $newFilename);

        return $newFilename;
    }

    /**
     * @inheritDoc
     */
    public function delete(string $path, string $name): void
    {
        unlink($path . $name);
    }
}
