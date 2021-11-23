<?php

namespace App\Services;

use App\Http\Requests\StoreNoteRequest;
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

    public function deleteById(int $id)
    {
        $fileName = $this->fileRepository->findByID($id)->file;
        $this->fileRepository->removeById($id);
        $path = public_path().'/files/'.$fileName;
        unlink($path);
    }

    public function create($file, int $noteId)
    {
        $name = $file->getClientOriginalName();
        $fileName = 'file-'.Str::random(10).'_'.$name;
        $file->move(public_path().'/files/', $fileName);

        $file = new File();
        $file->note_id = $noteId;
        $file->file = $fileName;

        $this->fileRepository->save($file);
    }

    public function bulkCreate(StoreNoteRequest $request, $notes)
    {
        /* Add file */
        if($request->hasFile('file')){
            $noteId = $notes->id;

            foreach($request->file('file') as $file)
            {
                if(!isset($file)) {
                    break;
                }

                $this->create($file, $noteId);
            }
        }
    }
}
