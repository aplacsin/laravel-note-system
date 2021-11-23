<?php

namespace App\Repositories;

use App\Models\Image;

interface ImageRepositoryInterface
{
    public function removeById(int $id): void;

    public function save(Image $image): Image;

    public function findById(int $id): ?Image;

}
