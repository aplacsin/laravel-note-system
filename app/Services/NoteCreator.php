<?php

namespace App\Services;

use App\DTO\NoteDTO;
use App\Models\Note;
use App\Repositories\NoteRepository;

class NoteCreator
{
    private NoteRepository $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function create(NoteDTO $dto): Note
    {
        $note = new Note();
        $note->user_id = $dto->getUserId();
        $note->title = $dto->getTitle();
        $note->content = $dto->getContent();

        return $this->noteRepository->save($note);
    }
}
