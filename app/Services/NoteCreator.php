<?php

namespace App\Services;

use App\Models\Note;
use App\Repositories\NoteRepository;

class NoteCreator
{
    private NoteRepository $noteRepository;

    public function __construct(NoteRepository $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function create(array $data): Note
    {
        $note = new Note();
        $note->user_id = $data['user_id'];
        $note->title = $data['title'];
        $note->content = $data['content'];

        return $this->noteRepository->save($note);
    }
}
