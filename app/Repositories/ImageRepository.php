<?php

namespace App\Repositories;

use App\Models\Image;

class ImageRepository implements ImageRepositoryInterface
{

    public function removeById(int $id): void
    {
        Image::where('id', $id)->delete();
    }

    public function save(Image $image): Image
    {
        $image->save();

        return $image;
    }

    public function findById(int $id): ?Image
    {
        return Image::findorfail($id);
    }
}
