<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Models\Note;
use App\Models\User;
use App\Models\Image;
use App\Http\Requests\StoreNoteRequest;

class NoteController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {         
        $userId = auth()->user()->id;
        
        $notes = Note::query()
        ->where('user_id', $userId)
        ->orderBy('created_at', 'DESC')
        ->get();
       
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
        $notes = Note::create($note);        

        $noteId = $notes->id;        
        $imagename =[];
        $i = 0;              

        if($request->hasFile('image')){
            foreach($request->file('image') as $image)
            {
                if(!isset($image))
                {
                    break;
                }

            $name=$image->getClientOriginalName();
            $imagename[$i] = 'image-'.Str::random(10).'.jpg';                
            $image->move(public_path().'/images/', $imagename[$i]);                
               
            Image::create([
                'note_id' => $noteId,
                'image' => $imagename[$i]
            ]);           
            }                       
        }

        // Redirect to index
       return redirect()->route('notes.index', app()->getLocale())
                        ->with('success', trans('alert.success_created_note'));
    }

    public function destroy($id)
    {
        Note::findOrfail($id)->delete();           

        return redirect()->back()
                         ->with('success', trans('alert.success_delete_note'));
    }

    public function show($id)
    {
        $notes = Note::findorfail($id);

        return view('notes.show', ['note' => $notes, app()->getLocale()]);
    }

    public function edit($id)
    {    
        $notes = Note::findOrfail($id);

        return view('notes.edit', ['note' => $notes, app()->getLocale()]);
    }

    public function update(StoreNoteRequest $request, $id)
    {
        $notes = Note::findOrfail($id);
        $notes->fill($request->all());
        $notes->save();

        // Redirect to index
        return redirect()->route('notes.index', app()->getLocale())
                         ->with('success', trans('alert.success_update_note'));
    }

}
