<?php
namespace App\Service;

use App\Entity\Interfaces\IFileEntity;

class UploaderService
{
    const DIR = 'files';

    public function upload(IFileEntity $entity): void
    {
        $file = $entity->getFile();

        if ($file === null)
        {
            return;
        }

        $absolute_dir = self::getAbsoluteDir();
        $ext = $file->guessExtension();

        $filename = bin2hex(random_bytes(16)); // generate safely a filename (128bits -> 32 chars)
        $full_filename = $filename . '.' . $ext;

        $entity->setFilename($full_filename);
        $old = $entity->getOldFilename();

        if ($old !== null)
        {
            $this->deleteFile($old);
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $file->move($absolute_dir, $full_filename);
        $entity->setFile(null); // clear
    }

    public function delete(IFileEntity $entity): void
    {
        $filename = $entity->getFilename();

        $this->deleteFile($filename);
    }

    protected function deleteFile(string $filename): void
    {
        $absolute_dir = self::getAbsoluteDir();
        $full_filename = $absolute_dir . '/' . $filename;

        unlink($full_filename);
    }

    public static function getAbsoluteDir(): string
    {
        return (WEB_DIRECTORY . '/' . self::DIR);
    }

    public static function getWebDir(): string
    {
        return self::DIR;
    }
}
