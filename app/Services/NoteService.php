<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Note;
use App\Repositories\NoteRepositoryInterface;
use App\Models\File;
use Illuminate\Support\Str;
use App\Http\Requests\StoreNoteRequest;
use App\Services\ImageService;

class NoteService
{
    private NoteRepositoryInterface $noteRepository;
    private \App\Services\ImageService $imageService;

    public function __construct(NoteRepositoryInterface $noteRepository, ImageService $imageService)
    {
        $this->noteRepository = $noteRepository;
        $this->imageService = $imageService;
    }

    public function getNoteByUserId(int $userId): Collection
    {
        return $this->noteRepository->findNotesByUserId($userId);
    }

    public function create(StoreNoteRequest $request, $note)
    {
        $notes = Note::create($note);

        $this->imageService->bulkCreate($request, $notes);

        /* Add file */
        if($request->hasFile('file')){
            $noteId = $notes->id;
            $filename =[];
            $i = 0;

            foreach($request->file('file') as $file)
            {
                if(!isset($file))
                {
                    break;
                }

            $name = $file->getClientOriginalName();
            $filename[$i] = 'file-'.Str::random(10).'_'.$name;
            $file->move(public_path().'/files/', $filename[$i]);

            File::create([
                'note_id' => $noteId,
                'file' => $filename[$i]
            ]);
            }
        }
    }

    public function deleteById($id)
    {
        $this->noteRepository->removeById($id);
    }

    public function getById($id): ?Note
    {
       return $this->noteRepository->findById($id);
    }

    public function update(StoreNoteRequest $request, $id)
    {
        $notes = $this->noteRepository->findById($id);
        $notes->fill($request->all());
        $notes->save();

        $this->imageService->bulkCreate($request, $notes);

        /* Add file */
        if($request->hasFile('file')){
            $noteId = $notes->id;
            $filename =[];
            $i = 0;

            foreach($request->file('file') as $file)
            {
                if(!isset($file))
                {
                    continue;
                }

            $name = $file->getClientOriginalName();
            $filename[$i] = 'file-'.Str::random(10).'_'.$name;
            $file->move(public_path().'/files/', $filename[$i]);

            File::create([
                'note_id' => $noteId,
                'file' => $filename[$i]
            ]);
            }
        }
    }
}
