<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Note;

class NoteController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {        
        $userId = auth()->user()->id;
        
        $notes = Note::query()
        ->where('user_id', $userId)
        ->get();       
       
        return view('notes.index', ['notes'=>$notes]);
    }

    public function create()
    {
        return view('notes.create');
    }
}
