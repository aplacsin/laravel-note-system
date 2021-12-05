<?php

declare(strict_types=1);

namespace App\Services;

use App\Enums\FileDiskType;
use App\Models\File;
use App\Repositories\FileRepositoryInterface;
use Illuminate\Support\Facades\Storage;

class FileService
{
    private FileRepositoryInterface $fileRepository;

    public function __construct(FileRepositoryInterface $fileRepository)
    {
        $this->fileRepository = $fileRepository;
    }

    public function deleteById(int $id): void
    {
        $file = $this->fileRepository->findByID($id);
        $this->fileRepository->removeById($id);
        Storage::disk(FileDiskType::public()->label)->delete("files/$file->file");
    }

    public function create($file, int $noteId): void
    {
        $storagePath = Storage::disk(FileDiskType::public()->label)->put('files', $file);
        $storageName = basename((string)$storagePath);

        $file = new File();
        $file->note_id = $noteId;
        $file->file = $storageName;
        $file->disk = FileDiskType::public()->label;

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
