<?php

namespace App\Services;

use Illuminate\Support\Collection;
use App\Models\Note;
use App\Repositories\NoteRepositoryInterface;
use App\Models\Image;
use App\Models\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreNoteRequest;

class NoteService
{
    private $noteRepository;

    public function __construct(NoteRepositoryInterface $noteRepository)
    {
        $this->noteRepository = $noteRepository;
    }

    public function getNoteByUserId(int $userId): Collection
    {
        return $this->noteRepository->findNotesByUserId($userId);
    }

    public function create(StoreNoteRequest $request, $note) 
    {
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
    }

    public function deleteById($id)
    {
        $this->noteRepository->removeById($id);
    }

    public function getById($id)
    {
       return $this->noteRepository->findById($id);
    }

    public function update(StoreNoteRequest $request, $id)
    {
        $notes = $this->noteRepository->findById($id);
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
    }
}