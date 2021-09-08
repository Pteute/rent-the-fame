<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploader
{
    private $targetDirectory;
    private $slugger;

    public function __construct($targetDirectory, SluggerInterface $slugger)
    {
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
    }

    public function upload(UploadedFile $file) //gère ll'upload
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); //récupère le nom 
        $safeFilename = $this->slugger->slug($originalFilename); //slug le nom (pas de maj pas d'espace pas de ,.@$)
        $fileName = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension(); // concatène pour lui donner un id unique 

        try {
            $file->move($this->getTargetDirectory(), $fileName);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
        }

        return $fileName;
    }

    public function remove(string $name)
    {
        $file = $this->targetDirectory . '/' . $name;
        if (file_exists($file))
            unlink($file);
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
