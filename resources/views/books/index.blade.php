@extends('templates.default')

@php

$title = "Data Penerbit";
$preTitle = "Semua Data";
@endphp

@push('page-search')
<form action="{{ route('book.search') }}" method="GET">
    <input type="text" name="keyword" placeholder="Cari buku...">
    <button type="submit">Cari</button>
</form>
@endpush

@push('page-action')
    <a href="{{route('book.create')}}" class="btn btn-primary">Tambah Data</a>
@endpush

@section('content')

    <div class="card">
                  <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th>Nama Penulis</th>
                          <th>Judul Buku</th>
                          <th>Cover Books</th>
                          <th>Tahun Terbit</th>
                          
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach ($books as $book)
                       <tr>
                        <td>{{$book->author->name}}</td>
                        <td>{{$book->title}}</td>
                        <td>
                            <img src="{{asset('storage/' . $book->cover)}}" height="150px" alt="">
                        </td>
                        <td>{{$book->year}}</td>
                        
                        <td>
                          <a href="#" class="btn btn-primary btn-sm">Show Details</a>
                          <a href="{{route('book.edit', $book->id)}}" class="btn btn-warning btn-sm">Edit</a>
                         <form action="{{route('book.destroy', $book->id)}}" method="post">
                            @csrf
                            @method('DELETE')

                            <input type="submit" value="Hapus" class="btn btn-danger btn-sm">
                        </form>
                        </td>
                      </tr>
                       @endforeach
                        
                      </tbody>
                    </table>
                  </div>
                </div>
@endsection