<?php

namespace App\Http\Controllers;

use App\Models\Author;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index ()
    {
        return view('books.index', [
            'books' => Book::latest()->get(),
        ]);
    }
    
    public function create() 
    {
        return view('books.create', [
            'names' => Author::get(),
        ]);
    }

    public function store(Request $request)
    {
        // dd($request->title);
        // $this->validate($request, [
            // 'names' => ['required'], 
            //'title' => ['required', 'min:3'],
            //'cover' => ['image'],
            //'year' => ['required', 'min:4', 'numeric'],
        // ]);

        // dd('ashshs');
        $cover = null;
        if($request->hasFile('cover')){
            $cover = $request->file('cover')->store('covers');  
        }


        $book = new Book();

        
        $book->author_id = $request->author_id;
        $book->title = $request->title;
        $book->cover = $cover;
        $book->year = $request->year;

        $book->save();

        session()->flash('success', 'Data Berhasil Ditambahkan');
        return redirect()->route('book.index');
        }

        public function edit($id)
        {
            $book = Book::find($id);
            return view('books.edit', [
                "book" => $book,
            ]);   
        }
        public function update(Request $request, $id)
    {

        $this->validate($request, [
            'name' => ['required', 'min:3'], 
        ], [

            'name.required' => 'Nama Harus Diisi',
        ]);

        $book = Book::find($id);

        $cover = null;
        if($request->hasFile('photo')){
            if (Storage::exists($book->photo)) {
                Storage::delete($book->photo);
            }
            $photo = $request->file('photo')->store('photos');  
        }

        $book->author_id = $request->author_id;
        $book->title = $request->title;
        $book->cover = $cover;
        $book->year = $request->year;



        $book->save();

        session()->flash('info', 'Data Berhasil Diedit');
        return redirect()->route('book.index');
    }

    public function destroy($id)

    { 
        
        $book = Book::find($id);

        $book->delete();

        session()->flash('danger', 'Data Berhasil Dihapus');

        
        return redirect()->route('book.index');
    }
}
