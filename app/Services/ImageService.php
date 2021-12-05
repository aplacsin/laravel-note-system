<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\Image;
use App\Repositories\ImageRepositoryInterface;
use Illuminate\Support\Facades\Storage;
use App\Enums\ImageDiskType;

class ImageService
{
    private ImageRepositoryInterface $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function deleteById(int $id): void
    {
        $image = $this->imageRepository->findById($id);
        $this->imageRepository->removeById($id);
        Storage::disk(ImageDiskType::public()->label)->delete("images/$image->image");
    }

    public function create($file, int $noteId): void
    {
        $storagePath = Storage::disk(ImageDiskType::public()->label)->put('images', $file);
        $storageName = basename((string)$storagePath);

        $image = new Image();
        $image->note_id = $noteId;
        $image->image = $storageName;
        $image->disk = ImageDiskType::public()->label;

        $this->imageRepository->save($image);
    }

    public function bulkCreate(?array $images, int $noteId): void
    {
        if (!$images) {
            return;
        }

        foreach ($images as $file) {

            if (!isset($file)) {
                break;
            }

            $this->create($file, $noteId);
        }
    }
}

