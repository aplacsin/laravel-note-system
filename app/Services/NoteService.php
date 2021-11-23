<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Note;
use App\Repositories\NoteRepositoryInterface;
use App\Http\Requests\StoreNoteRequest;

class NoteService
{
    private NoteRepositoryInterface $noteRepository;
    private ImageService $imageService;
    private FileService $fileService;

    public function __construct(NoteRepositoryInterface $noteRepository, ImageService $imageService, FileService $fileService)
    {
        $this->noteRepository = $noteRepository;
        $this->imageService = $imageService;
        $this->fileService = $fileService;
    }

    public function getNoteByUserId(int $userId): Collection
    {
        return $this->noteRepository->findNotesByUserId($userId);
    }

    public function create(StoreNoteRequest $request, $note)
    {
        $notes = Note::create($note);

        $this->imageService->bulkCreate($request, $notes);
        $this->fileService->bulkCreate($request, $notes);
    }

    public function deleteById(int $id)
    {
        $this->noteRepository->removeById($id);
    }

    public function getById(int $id): ?Note
    {
       return $this->noteRepository->findById($id);
    }

    public function update(StoreNoteRequest $request, int $id)
    {
        $notes = $this->noteRepository->findById($id);
        $notes->fill($request->all());
        $notes->save();

        $this->imageService->bulkCreate($request, $notes);
        $this->fileService->bulkCreate($request, $notes);
    }
}
