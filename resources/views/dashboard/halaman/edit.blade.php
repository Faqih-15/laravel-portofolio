@extends('dashboard.layout')

@section('content')
    <div class="pb-3"><a href="{{ route('halaman.index') }}" class="btn btn-secondary">
        < Back</a>
    </div>
    <form action="{{ route('halaman.update', $data->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="judul" class="form-label">Title <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-control-sm" name="judul"
                id="judul" aria-describedby="helpId" placeholder="Title" value="{{ $data->judul }}">
        </div>
        <div class="mb-3">
            <label for="isi" class="form-label">Description</label>
            <textarea class="form-control summernote" rows="5" name="isi">{{ $data->isi }}</textarea>
        </div>
        <button class="btn btn-primary" name="simpan" type="submit">UPDATE</button>

@endsection
