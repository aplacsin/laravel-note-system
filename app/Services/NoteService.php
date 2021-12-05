<?php

namespace App\Services;

use App\DTO\NoteDTO;
use App\Repositories\NoteRepository;
use Facade\FlareClient\Http\Exceptions\NotFound;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Models\Note;

class NoteService
{
    private NoteRepository $noteRepository;
    private ImageService $imageService;
    private FileService $fileService;
    private NoteCreator $noteCreator;

    public function __construct(NoteRepository $noteRepository, ImageService $imageService, FileService $fileService, NoteCreator $noteCreator)
    {
        $this->noteRepository = $noteRepository;
        $this->imageService = $imageService;
        $this->fileService = $fileService;
        $this->noteCreator = $noteCreator;
    }

    public function getNoteByUserId(int $userId): LengthAwarePaginator
    {
        return $this->noteRepository->findByUserId($userId);
    }

    public function create(NoteDTO $noteDTO): void
    {
        $note = $this->noteCreator->create($noteDTO);

        $this->imageService->bulkCreate($noteDTO->getImage(), $note->id);
        $this->fileService->bulkCreate($noteDTO->getFile(), $note->id);
    }

    public function deleteById(int $id): void
    {
        $this->noteRepository->removeById($id);
    }

    /**
     * @throws NotFound
     */
    public function getById(int $id): ?Note
    {
       return $this->noteRepository->findById($id);
    }

    /**
     * @throws NotFound
     */
    public function update(NoteDTO $noteDTO, int $id): void
    {
        $note = $this->noteRepository->findById($id);
        $note->title = $noteDTO->getTitle();
        $note->content = $noteDTO->getContent();

        $this->noteRepository->save($note);
        $this->imageService->bulkCreate($noteDTO->getImage(), $note->id);
        $this->fileService->bulkCreate($noteDTO->getFile(), $note->id);
    }
}
