<?php

namespace App\Http\Controllers;

use App;
use App\DTO\NoteDTO;
use App\Http\Requests\StoreNoteRequest;
use App\Services\NoteService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class NoteController extends Controller
{
    private NoteService $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function index()
    {
        $userId = Auth::id();
        $notes = $this->noteService->getNoteByUserId($userId);

        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(StoreNoteRequest $request): RedirectResponse
    {
        $noteDTO = NoteDTO::make(
            $request->input('title'),
            $request->input('content'),
            Auth::id(),
            $request->file('image'),
            $request->file('file')
        );

        $this->noteService->create($noteDTO);

        return redirect()->route('notes.index', app()->getLocale())
            ->with('success', trans('alert.success_created_note'));
    }

    public function destroy(int $id): RedirectResponse
    {
        $this->noteService->deleteById($id);

        return redirect()->back()
                         ->with('success', trans('alert.success_delete_note'));
    }

    public function show(int $id)
    {
        $notes = $this->noteService->getById($id);

        return view('notes.show', ['note' => $notes, app()->getLocale()]);
    }

    public function edit(int $id)
    {
        $notes = $this->noteService->getById($id);

        return view('notes.edit', ['note' => $notes, app()->getLocale()]);
    }

    public function update(StoreNoteRequest $request, int $id): RedirectResponse
    {
        $noteDTO = NoteDTO::make(
            $request->input('title'),
            $request->input('content'),
            Auth::id(),
            $request->file('image'),
            $request->file('file')
        );

        $this->noteService->update($noteDTO, $id);

        return redirect()->route('notes.index', app()->getLocale())
                         ->with('success', trans('alert.success_update_note'));
    }
}
