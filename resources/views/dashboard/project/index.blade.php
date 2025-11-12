@extends('dashboard.layout')

@section('content')
<p class="card-title">Projects</p>
<a href="{{ route('project.create') }}" class="btn btn-primary mb-3">+ Add New Project</a>

<div class="table-responsive">
<table class="table">
    <thead>
        <tr>
            <th class="col-1">No</th>
            <th>Title</th>
            <th>Technology</th>
            <th>Images</th>
            <th>Link</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $item->judul }}</td>
            <td>{{ $item->informasi }}</td>
            <td>
                @if($item->images->count() > 0)
                    <div class="d-flex align-items-center"> {{-- Pembungkus flexbox untuk deret gambar --}}
                        @foreach($item->images->take(3) as $image) {{-- Ambil maksimal 3 gambar --}}
                            <img src="{{ asset('foto_project/' . $image->gambar) }}"
                                alt="{{ $item->judul }}"
                                class="img-thumbnail rounded-circle me-1" {{-- Tambah me-1 untuk margin kanan --}}
                                style="width: 40px; height: 40px; object-fit: cover;"> {{-- Ukuran lebih kecil --}}
                        @endforeach
                        @if ($item->images->count() > 3)
                            <span class="ms-1 text-muted">+{{ $item->images->count() - 3 }}</span> {{-- Tampilkan sisa jika lebih dari 3 --}}
                        @endif
                    </div>
                @else
                    <small>No images</small>
                @endif
            </td>
            <td>
                @if($item->link)
                    <a href="{{ $item->link }}" target="_blank">View</a>
                @endif
            </td>
            {{--  --}}
            <td>
                <div class="dropdown">
                    <button class="btn btn-link text-dark p-0 m-0 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-three-dots-vertical"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="{{ route('project.edit', $item->id) }}" class="dropdown-item">
                                <i class="bi bi-pencil-square me-2"></i>Edit
                            </a>
                        </li>
                        <li>
                            <form onsubmit="return confirm('Are you sure you want to delete {{ $item->judul }} ?')"
                                action="{{ route('project.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-trash me-2"></i>Delete
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
</div>
@endsection
