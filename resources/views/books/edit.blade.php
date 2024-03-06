@extends('templates.default')



@section('content')
    
<div class="card">
    <div class="card-body">
        <form action="{{route('book.store')}}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Nama Author</label>
                <select name="author_id" id="" class="form-control">
                    @foreach ($names as $name)
                        
                    <option value="{{$name->id}}">{{$name->name}}</option>

                    @endforeach
                </select>
                @error('name')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Judul Buku</label>
                <input type="text" name="title" class="form-control @error('title')
                    is-invalid
                @enderror"  placeholder="Masukkan Judul Buku">
                @error('title')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Cover</label>
                <input type="file" name="cover" class="form-control "  placeholder="Masukkan Foto Anda">
                @error('cover')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
              </div>

              <div class="mb-3">
                <label class="form-label">Tahun Terbit</label>
                <input type="text" name="year" class="form-control @error('year')
                is-invalid
            @enderror"  placeholder="Masukkan Nama Lengkap">
                @error('year')
                    <span class="invalid-feedback">
                        {{ $message }}
                    </span>
                @enderror
              </div>

             
        <div class="mb-3">
            <input type="submit" value="Simpan" class="btn btn-primary">
        </div>

        </form>
    </div>
</div>
@endsection