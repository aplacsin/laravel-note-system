<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\File;
use App\Http\Requests\StoreNoteRequest;
use App\Services\NoteService;

class NoteController extends Controller
{
    use AuthenticatesUsers;

    private NoteService $noteService;

    public function __construct(NoteService $noteService)
    {
        $this->noteService = $noteService;
    }

    public function index()
    {
        $userId = auth()->user()->id;
        $notes = $this->noteService->getNoteByUserId($userId);

        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        return view('notes.create');
    }

    public function store(StoreNoteRequest $request)
    {
        $userId = auth()->user()->id;
        $note = $request->all();
        $note['user_id'] = $userId;

        $this->noteService->create($request, $note);

        return redirect()->route('notes.index', app()->getLocale())
                        ->with('success', trans('alert.success_created_note'));
    }

    public function destroy($id)
    {
        $this->noteService->deleteById($id);

        return redirect()->back()
                         ->with('success', trans('alert.success_delete_note'));
    }

    public function destroyFile($id)
    {
        $fileName = File::findorfail($id)->file;
        File::where('id', $id)->delete();
        $path = public_path().'/files/'.$fileName;
        unlink($path);
    }

    public function show($id)
    {
        $notes = $this->noteService->getById($id);

        return view('notes.show', ['note' => $notes, app()->getLocale()]);
    }

    public function edit($id)
    {
        $notes = $this->noteService->getById($id);

        return view('notes.edit', ['note' => $notes, app()->getLocale()]);
    }

    public function update(StoreNoteRequest $request, $id)
    {
        $this->noteService->update($request, $id);

        return redirect()->route('notes.index', app()->getLocale())
                         ->with('success', trans('alert.success_update_note'));
    }
}
