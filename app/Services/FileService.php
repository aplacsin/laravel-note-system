<?php

namespace App\Services;

use App\Models\File;
use App\Repositories\FileRepositoryInterface;
use Illuminate\Support\Str;

class FileService
{
    private FileRepositoryInterface $fileRepository;

    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function deleteById(int $id): void
    {
        $fileName = $this->fileRepository->findByID($id)->file;
        $this->fileRepository->removeById($id);
        $path = public_path().'/files/'.$fileName;
        unlink($path);
    }

    public function create($file, int $noteId): void
    {
        $name = $file->getClientOriginalName();
        $fileName = 'file-'.Str::random(10).'_'.$name;
        $file->move(public_path().'/files/', $fileName);

        $file = new File();
        $file->note_id = $noteId;
        $file->file = $fileName;

        $this->fileRepository->save($file);
    }

    public function bulkCreate(?array $files, int $noteId): void
    {
        if (!$files) {
            return;
        }

        foreach ($files as $file) {

            if (!isset($file)) {
                break;
            }

            $this->create($file, $noteId);
        }
    }
}
