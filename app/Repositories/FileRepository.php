<?php

namespace App\Repositories;

use App\Models\File;
use Facade\FlareClient\Http\Exceptions\NotFound;

class FileRepository implements FileRepositoryInterface
{
    public function removeById(int $id): void
    {
        File::query()
            ->where('id', $id)
            ->delete();
    }

    public function save(File $file): File
    {
        $file->save();

        return $file;
    }

    /**
     * @throws NotFound
     */
    public function findById(int $id): ?File
    {
        $model = File::query()
            ->findorfail($id);

        if(!$model) {
            throw new NotFound();
        }

        /** @var File $model */
        return $model;
    }
}
