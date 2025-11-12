@extends('dashboard.layout')

@section('content')
    <p class="card-title">Education</p>
    <div class="pb-3"><a href="{{ route('education.create') }}" class="btn btn-primary">+ Add New Education</a></div>
    <div class="table-responsive">
        <table class="table table-stripped">
            <thead>
                <tr>
                    <th class="col-1">No</th>
                    <th>University</th>
                    <th>Faculty</th>
                    <th>Major</th>
                    <th>GPA</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th class="col-2">Action</th>
                </tr>
            </thead>
            <tbody>                  {{-- tulis tbody>tr>td*3 terus enter maka otomatis jadi lengkap --}}
                <?php $i = 1; ?>
                @foreach ($data as $item)     {{-- $data dari halamanController.php baris ke-17 --}}
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $item->judul }}</td>
                    <td>{{ $item->info1 }}</td>
                    <td>{{ $item->info2 }}</td>
                    <td>{{ $item->info3 }}</td>
                    <td>{{ $item->tgl_mulai_indo }}</td>
                    <td>{{ $item->tgl_akhir_indo }}</td>
                    <td>
                        <div class="dropdown">        <!-- pembungkus dropdown -->   {{-- bikin titik 3 --}}
                            <button class="btn btn-link text-dark p-0 m-0 shadow-none" type="button" data-bs-toggle="dropdown" aria-expanded="false">  <!-- (button) tombol pemicu dropdown -->
                                <i class="bi bi-three-dots-vertical"></i>
                            </button>
                            <ul class="dropdown-menu">          <!-- isi menu dropdown (edit, hapus) -->
                                <li>
                                    <a href="{{ route('education.edit', $item->id) }}" class="dropdown-item">
                                        <i class="bi bi-pencil-square me-2"></i>Edit
                                    </a>
                                </li>
                                <li>
                                <form onsubmit="return confirm('Are you sure you want to delete {{ $item->judul }} ?')" action="{{ route('education.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="dropdown-item text-danger">
                                <i class="bi bi-trash me-2"></i>Delete
                                </button></form>
                                </li>
                            </ul>
                        </div>      {{-- end bikin titik 3 --}}
                    </td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection

