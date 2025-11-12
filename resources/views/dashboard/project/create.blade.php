@extends('dashboard.layout')

@section('content')
<h4>Add New Project</h4>
<div class="pb-3"><a href="{{ route('project.index') }}" class="btn btn-secondary">
    < Back</a>
</div>
<form action="{{ route('project.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Title <span class="text-danger">*</span></label>
        <input type="text" name="judul" class="form-control" placeholder="Title" required>
    </div>
    <div class="mb-3">
        <label>Technology</label>
        <input type="text" name="informasi" class="form-control" placeholder="Technology">
    </div>
    <div class="mb-3">
        <label class="form-label">Images (Can select more than one)</label>
        <div class="dropzone" id="project-dropzone">
            <div class="dz-message" data-dz-message>
                <span><i class="fas fa-cloud-upload-alt fa-3x"></i></span>
                <span class="d-block">Drag files here or click to upload</span>
            </div>
        </div>
    </div>
    {{--  --}}
    <div class="mb-3">
        <label>Description</label>
        <textarea name="isi" class="form-control summernote" rows="4"></textarea>
    </div>
    <div class="mb-3">
        <label>Project Link</label>
        <input type="url" name="link" class="form-control" placeholder="https://example.com">
    </div>
    <button id="my-save-button" type="submit" class="btn btn-primary">Save</button>
</form>
@endsection

@push('child-scripts')
<script>
    // Matikan autoDiscover Dropzone agar kita bisa inisialisasi manual
    Dropzone.autoDiscover = false;

    // Ambil form utama
    var mainForm = document.querySelector('form[action="{{ route('project.store') }}"]');

    var projectDropzone = new Dropzone("#project-dropzone", {
        url: "{{ route('project.image.upload') }}", // Rute untuk upload
        paramName: "file", // Nama field file
        maxFilesize: 5, // MB
        acceptedFiles: ".jpeg,.jpg,.png,.gif",
        addRemoveLinks: true, // Tampilkan link "Remove file"
        autoProcessQueue: true, // Langsung upload saat file di-drop
        headers: {
            'X-CSRF-TOKEN': "{{ csrf_token() }}" // Token CSRF
        },
        init: function() {
            var myDropzone = this;

            // Saat upload sukses
            this.on("success", function(file, response) {
                // Buat input hidden baru dan tambahkan ke form utama
                var input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'gambar[]'; // Kirim sebagai array
                input.value = response.filename; // Nama file dari controller
                input.setAttribute('data-dz-filename', file.name); // Simpan nama asli
                mainForm.appendChild(input);
            });

            // Saat file dihapus (klik "Remove file")
            this.on("removedfile", function(file) {
                // Ambil nama file di server
                var serverFilename = null;
                var inputs = mainForm.querySelectorAll('input[type="hidden"][name="gambar[]"]');
                inputs.forEach(function(input) {
                    if (input.getAttribute('data-dz-filename') === file.name) {
                        serverFilename = input.value;
                        // Hapus input hidden dari form
                        input.remove();
                    }
                });

                // Kirim request ke server untuk hapus file fisik
                if (serverFilename) {
                    // fetch('{{ route('project.image.revert') }}', {      // panggil revertImage() untuk menghapus file dari 'temp_uploads'
                    fetch('/dashboard/project/revert-image', {             // agar tidak ada file sampah (orphan file) jika user batal upload.
                        // method: 'DELETE',
                        method: 'POST', // <-- GANTI JADI POST
                        headers: {
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

                    // Terjemahkan pesan spesifik ke Bahasa Inggris
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
