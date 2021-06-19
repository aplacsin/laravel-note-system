<?php

namespace App\Http\Controllers;

use App;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use App\Models\Note;
use App\Models\User;
use App\Models\Image;
use App\Models\File;
use App\Http\Requests\StoreNoteRequest;

class NoteController extends Controller
{
    use AuthenticatesUsers;

    public function index()
    {       
        if (Auth::check()) {  
            $userId = auth()->user()->id;        
            $notes = Note::query()
            ->where('user_id', $userId)
            ->orderBy('created_at', 'DESC')
            ->get();       
            return view('notes.index', compact('notes'));
        }
        else 
        {
            return redirect()->route('login', app()->getLocale());
        }
    }

    public function create()
    {
        if (Auth::check()) {  
            return view('notes.create');
        }
        else
        {
            return redirect()->route('login', app()->getLocale());
        }
    }

    public function store(StoreNoteRequest $request) 
    { 
        $userId = auth()->user()->id;
        $note = $request->all();
        $note['user_id'] = $userId;
        $notes = Note::create($note);                     


        /* Add image */
        if($request->hasFile('image')){
            $noteId = $notes->id;        
            $imagename =[];
            $i = 0; 

            foreach($request->file('image') as $image)
            {
                if(!isset($image))
                {
                    break;
                }

            $name = $image->getClientOriginalName();
            $imagename[$i] = 'image-'.Str::random(10).'_'.$name;
            $image->move(public_path().'/images/', $imagename[$i]);                
               
            Image::create([
                'note_id' => $noteId,
                'image' => $imagename[$i]
            ]);           
            }                       
        }

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

        // Redirect to index
       return redirect()->route('notes.index', app()->getLocale())
                        ->with('success', trans('alert.success_created_note'));
    }

    public function destroy($id)
    {        
        $note = Note::findOrfail($id)->delete();       
        return redirect()->back()
                         ->with('success', trans('alert.success_delete_note'));
    }

    public function destroyImage($id)
    {        
        $imageName = Image::findorfail($id)->image;
        Image::where('id', $id)->delete();
        $path = public_path().'/images/'.$imageName;
        unlink($path);
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
        if (Auth::check()) {  
            $notes = Note::findorfail($id);
            return view('notes.show', ['note' => $notes, app()->getLocale()]);
        }
        else
        {
            return redirect()->route('login', app()->getLocale());
        }
    }

    public function edit($id)
    {   
        if (Auth::check()) {   
            $notes = Note::findOrfail($id);
            return view('notes.edit', ['note' => $notes, app()->getLocale()]);
        }
        else
        {
            return redirect()->route('login', app()->getLocale());
        }
    }

    public function update(StoreNoteRequest $request, $id)
    {
        $notes = Note::findOrfail($id);
        $notes->fill($request->all());
        $notes->save();

        /* Add images */
        if($request->hasFile('image')){
            $noteId = $notes->id;        
            $imagename =[];
            $i = 0; 

            foreach($request->file('image') as $image)
            {
                if(!isset($image))
                {
                    continue;
                }

            $name = $image->getClientOriginalName();
            $imagename[$i] = 'image-'.Str::random(10).'_'.$name;
            $image->move(public_path().'/images/', $imagename[$i]);             
               
            Image::insert([
                'note_id' => $noteId,
                'image' => $imagename[$i]
            ]);           
            }                       
        }

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

        // Redirect to index
        return redirect()->route('notes.index', app()->getLocale())
                         ->with('success', trans('alert.success_update_note'));
    }
}