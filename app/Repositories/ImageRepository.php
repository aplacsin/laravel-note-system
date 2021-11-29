<?php

namespace App\Repositories;

use App\Models\Image;
use Facade\FlareClient\Http\Exceptions\NotFound;

class ImageRepository implements ImageRepositoryInterface
{

    public function removeById(int $id): void
    {
        Image::query()
            ->where('id', $id)
            ->delete();
    }

    public function save(Image $image): Image
    {
        $image->save();

        return $image;
    }

    /**
     * @throws NotFound
     */
    public function findById(int $id): ?Image
    {
        $model = Image::query()
            ->findorfail($id);

        if(!$model) {
            throw new NotFound();
        }

        /** @var Image $model */
        return $model;
    }
}
