<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class SearchController extends Controller
{
   public function search (Request $request)
   {
    $keyword = '%' . $request->input('keyword') . '%';

    $books = Book::where('author_id','LIKE', "%$keyword%")->get();
    $books = Book::where('title','LIKE', "%$keyword%")->get();

    return view('books.result', compact('books'));
   }
}
