@extends('dashboard.layout')

@section('content')
<h4>Edit Project</h4>
<div class="pb-3"><a href="{{ route('project.index') }}" class="btn btn-secondary">
    < Back</a>
</div>
<form action="{{ route('project.update', $project->id) }}" method="POST">
    @csrf @method('PUT')
    <div class="mb-3">
        <label>Title <span class="text-danger">*</span></label>
        <input type="text" name="judul" placeholder="Title" value="{{ $project->judul }}" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Technology</label>
        <input type="text" name="informasi" placeholder="Technology" value="{{ $project->informasi }}" class="form-control">
    </div>
    <div class="mb-3">
        <label class="form-label">Images (Can select more than one)</label>
        <div class="row g-2 mb-3">
            @foreach($project->images as $image)
                <div class="col-md-3 col-sm-4 col-6" id="image-{{ $image->id }}">
                    <div class="position-relative">
                        <img src="{{ asset('foto_project/' . $image->gambar) }}" class="img-fluid rounded" style="height: 120px; width: 100%; object-fit: cover;">
                        <button type="button"
                            class="btn btn-danger btn-sm"
                            style="position: absolute; top: 5px; right: 5px;"
                            onclick="deleteImage({{ $image->id }})">
                            X
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="dropzone" id="project-dropzone">
            <div class="dz-message" data-dz-message>
                <span><i class="fas fa-cloud-upload-alt fa-3x"></i></span>
                <span class="d-block">Drag files here or click to upload</span>
            </div>
        </div>
    </div>
    <div class="mb-3">
        <label>Description</label>
        <textarea name="isi" class="form-control summernote" rows="4">{{ $project->isi }}</textarea>
    </div>
    <div class="mb-3">
        <label>Project Link</label>
        <input type="url" name="link" placeholder="https://example.com" value="{{ $project->link }}" class="form-control">
    </div>
    <button id="my-update-button" type="submit" class="btn btn-primary">Update</button>
</form>
@endsection

@push('child-scripts')
<script>
    // FUNGSI BARU UNTUK HAPUS GAMBAR LAMA
    function deleteImage(imageId) {
        if (!confirm('Are you sure you want to delete this image?')) {
            return; // Batal jika user klik 'Cancel'
        }

        fetch('/dashboard/project/image/' + imageId, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Hapus elemen gambar dari halaman
                document.getElementById('image-' + imageId).remove();
            } else {
                alert('Failed to delete image');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred');
        });
    }
    Dropzone.autoDiscover = false;

    // PERBEDAANNYA DI SINI:
    var mainForm = document.querySelector('form[action="{{ route('project.update', $project->id) }}"]');

    var projectDropzone = new Dropzone("#project-dropzone", {
        url: "{{ route('project.image.upload') }}",
        paramName: "file",
        maxFilesize: 5, // MB
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true,
        autoProcessQueue: true,
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}"
        },
        init: function() {
            var myDropzone = this;

            this.on("success", function(file, response) {
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'gambar[]';
                input.value = response.filename;
                input.setAttribute('data-dz-filename', file.name);
                mainForm.appendChild(input);
            });

            this.on("removedfile", function(file) {
                var serverFilename = null;
                var inputs = mainForm.querySelectorAll('input[type="hidden"][name="gambar[]"]');
                inputs.forEach(function(input) {
                    if (input.getAttribute('data-dz-filename') === file.name) {
                        serverFilename = input.value;
                        input.remove();
                    }
                });

                if (serverFilename) {
                    // fetch('{{ route('project.image.revert') }}', {        // panggil revertImage() untuk menghapus file dari 'temp_uploads'
                    fetch('/dashboard/project/revert-image', {               // agar tidak ada file sampah (orphan file) jika user batal upload.
                        method: 'POST', // <-- GANTI JADI POST                  //Dengan memanggil URL-nya langsung, kita mem-bypass sistem penamaan rute Laravel. |Menggunakan JavaScript (fetch).
                        // method: 'DELETE',  //diganti jadi POST karna 'php artisan serve' tidak bisa mengenali DELETE maka digunakanlah POST karna itu 'bahasa' yg pasti dikenali oleh semua server
                        headers: {               \
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ filename: serverFilename })
                    });
                }
            });

            this.on("error", function(file, response) {
                var message = ""; // Siapkan pesan
                // Cek apakah ini error validasi Laravel (yang berupa JSON)
                if (typeof response === 'object' && response.errors && response.errors.file) {
                    // Ambil pesan error pertama (misal: "The file must not be greater than 2048 kilobytes.")
                    message = response.errors.file[0];
                    // Terjemahkan pesan spesifik ke Bahasa Indonesia
                    if (message.includes("greater than")) {
                        message = "File is too large (Max 2MB)";
                    }
                } else if (typeof response === 'string') {
                    // Jika error-nya hanya teks biasa
                    message = response;
                } else {
                    message = "Upload failed, unknown error.";
                }

                // Ambil elemen teks error di gambar dan ganti tulisannya
                var node = file.previewElement.querySelector(".dz-error-message");
                if (node) {
                    node.textContent = message;
                }
            });
        }
    });
</script>
@endpush
