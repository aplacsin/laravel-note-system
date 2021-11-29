<?php

namespace App\Services;

use App\Http\Requests\StoreNoteRequest;
use App\Models\Image;
use App\Repositories\ImageRepositoryInterface;
use Illuminate\Support\Str;

class ImageService
{
    private ImageRepositoryInterface $imageRepository;

    public function __construct(ImageRepositoryInterface $imageRepository)
    {
        $this->imageRepository = $imageRepository;
    }

    public function deleteById(int $id)
    {
        $imageName = $this->imageRepository->findById($id)->image;
        $this->imageRepository->removeById($id);
        $path = public_path() . '/images/' . $imageName;
        unlink($path);
    }

    public function create($file, int $noteId)
    {
        $name = $file->getClientOriginalName();
        $fileName = 'file-' . Str::random(10) . '_' . $name;
        $file->move(public_path() . '/images/', $fileName);

        $image = new Image();
        $image->note_id = $noteId;
        $image->image = $fileName;

        $this->imageRepository->save($image);
    }

    public function bulkCreate(StoreNoteRequest $request, $notes)
    {
        /* Add image */
        if ($files = $request->file('image')) {
            $noteId = $notes->id;

            foreach ($files as $file) {

                if (!isset($file)) {
                    break;
                }

                $this->create($file, $noteId);
            }
        }
    }
}

