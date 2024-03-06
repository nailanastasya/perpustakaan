<?php

namespace App\Http\Controllers;

use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AuthorController extends Controller
{
    public function index ()
    {
        return view('authors.index', [
            'authors' => Author::latest()->get(),
        ]);
    }
    
    public function create() 
    {
        return view('authors.create');
    }

    public function store(Request $request)
    {
        
        $this->validate($request, [
            'name' => ['required', 'min:3'], 
            'photo' => ['image'],
        ], [

            'name.required' => 'Nama Harus Diisi',
        ]);


        $photo = null;
        if($request->hasFile('photo')){
            $photo = $request->file('photo')->store('photos');  
        }
        $author = new Author();

        $author->name = $request->name;
        $author->photo = $photo;

        $author->save();

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect()->route('author.index');
        }

        public function edit($id)
        {
            $author = Author::find($id);
            return view('authors.edit', [
                "author" => $author,
            ]);   
        }
        public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => ['required', 'min:3'], 
        ], [

            'name.required' => 'Nama Harus Diisi',
        ]);

        $author = Author::find($id);

        $photo = null;
        if($request->hasFile('photo')){
            if (Storage::exists($author->photo)) {
                Storage::delete($author->photo);
            }
            $photo = $request->file('photo')->store('photos');  
        }

        $author->name = $request->name;
        $author->photo = $photo;


        $author->save();

        session()->flash('info', 'Data Berhasil Diedit');
        return redirect()->route('author.index');
    }

    public function destroy($id)

    {
        $author = Author::find($id);

        $author->delete();

        session()->flash('danger', 'Data Berhasil Dihapus');
        return redirect()->route('author.index');
    }

   
}
