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
        $notes = Note::all();
       
        return view('notes.index', ['notes'=>$notes]);
    }
}
