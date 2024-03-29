@extends('templates.default')

@php

$title = "Data Penerbit";
$preTitle = "Semua Data";
@endphp

@push('page-action')
    <a href="{{route('publisher.create')}}" class="btn btn-primary">Tambah Data</a>
@endpush

@section('content')

    <div class="card">
                  <div class="table-responsive">
                    <table class="table table-vcenter card-table">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Address</th>
                          
                          <th class="w-1"></th>
                        </tr>
                      </thead>
                      <tbody>
                       @foreach ($publishers as $publisher)
                       <tr>
                        <td>{{$publisher->name}}</td>
                        <td>{{$publisher->address}}</td>
                        
                        <td>
                          <a href="{{route('publisher.edit', $publisher->id)}}" class="btn btn-warning btn-sm">Edit</a>
                         <form action="{{route('publisher.destroy', $publisher->id)}}" method="post">
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