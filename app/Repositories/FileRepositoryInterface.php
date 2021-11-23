<?php

namespace App\Repositories;

use App\Models\File;

interface FileRepositoryInterface
{
    public function removeById(int $id): void;

    public function save(File $file): File;

    public function findByID(int $id): ?File;
}
