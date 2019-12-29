<?php
namespace App\Entity\Interfaces;

use Symfony\Component\HttpFoundation\File\File;

interface IFileEntity
{
    function getOldFilename(): ?string;
    function getFilename(): ?string;
    function setFilename(?string $filename);

    function getFile(): ?File;
    function setFile(?File $file);
}
