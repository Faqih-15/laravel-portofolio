<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectImage; // Tambahkan ini jika perlu menghapus gambar lama
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; // Untuk menghapus file fisik

class ProjectController extends Controller
{
    public function index()
    {
        $data = Project::latest()->get();
        return view('dashboard.project.index', compact('data'));
    }

    public function create()
    {
        return view('dashboard.project.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'informasi' => 'nullable',
            'isi' => 'nullable',
            'link' => 'nullable|url',
            // Validasi 'gambar' sekarang adalah array of strings (nama file), bukan file
            'gambar' => 'nullable|array',
            'gambar.*' => 'string', // harus string (nama file)
        ]);

        $data = $request->except('gambar');

        // 1. Simpan project utama
        $project = Project::create($data);

        // 2. Simpan gambar dari nama file yang dikirim
        if ($request->has('gambar')) {
            foreach ($request->input('gambar') as $filename) {
                // Cek jika filenya benar ada (untuk keamanan)
                // if (File::exists(public_path('foto_project/' . $filename))) {
                //     $project->images()->create(['gambar' => $filename]);
                // }
                if (File::exists(public_path('temp_uploads/' . $filename))) {

                // PINDAHKAN FILE dari temp ke folder asli
                File::move(public_path('temp_uploads/' . $filename), public_path('foto_project/' . $filename));

                // Baru simpan ke database
                $project->images()->create(['gambar' => $filename]);
                }
            }
        }
        return redirect()->route('project.index')->with('success', 'Project added successfully.');
    }

    public function edit($id)
    {
        $project = Project::findOrFail($id);
        return view('dashboard.project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'judul' => 'required',
            'informasi' => 'nullable',
            'isi' => 'nullable',
            'link' => 'nullable|url',
            'gambar' => 'nullable|array',
            'gambar.*' => 'string',
        ]);

        $project = Project::findOrFail($id);
        $data = $request->except('gambar');

        // Update data teks
        $project->update($data);

        // Tambahkan gambar baru (jika ada)
        if ($request->has('gambar')) {
            foreach ($request->input('gambar') as $filename) {
                // if (File::exists(public_path('foto_project/' . $filename))) {
                //     $project->images()->create(['gambar' => $filename]);
                // }
                if (File::exists(public_path('temp_uploads/' . $filename))) {

                // PINDAHKAN FILE dari temp ke folder asli
                File::move(public_path('temp_uploads/' . $filename), public_path('foto_project/' . $filename));

                // Baru simpan ke database
                $project->images()->create(['gambar' => $filename]);
                }
            }
        }
        return redirect()->route('project.index')->with('success', 'Project updated successfully.');
    }

    public function destroy($id)
    {
        $project = Project::findOrFail($id);

        // OPSI TAMBAHAN: Hapus semua file fisik gambar terkait sebelum hapus data
        foreach($project->images as $image) {
            if (File::exists(public_path('foto_project/' . $image->gambar))) {
                File::delete(public_path('foto_project/' . $image->gambar));
            }
        }

        $project->delete(); // Ini akan otomatis menghapus data di tabel project_images juga karena 'onDelete cascade' di migration

        return redirect()->route('project.index')->with('success', 'Project deleted successfully.');
    }

    // KODE BARU (BENAR KARENA MENGIRIM JSON)
    public function destroyImage($id)
    {
        try {
            $image = ProjectImage::findOrFail($id);

            // 1. Hapus file fisik
            if (File::exists(public_path('foto_project/' . $image->gambar))) {
                File::delete(public_path('foto_project/' . $image->gambar));
            }

            // 2. Hapus data dari database
            $image->delete();

            // 3. Kirim jawaban JSON bahwa semua sukses
            return response()->json(['success' => true]);

        } catch (\Exception $e) {
            // Jika gagal (misal ID tidak ketemu), kirim jawaban error
            return response()->json(['success' => false, 'message' => $e->getMessage()], 404);
        }
    }

    // Tambahkan method ini (bisa di mana saja di dalam class)
    public function uploadImage(Request $request)
    {
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
        ]);

        $file = $request->file('file');
        // Buat nama file unik
        $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

        // Pindahkan file ke folder public
        // $file->move(public_path('foto_project'), $filename);
        // UBAH INI: 'foto_project' -> 'temp_uploads'
        $file->move(public_path('temp_uploads'), $filename);

        // Kirim nama file kembali ke Dropzone
        return response()->json(['filename' => $filename]);
    }

    // Tambahkan method ini untuk mengirim file sementara ke temp_upload sebelum ke foto_project
    public function revertImage(Request $request)
    {
        $filename = $request->input('filename');

        if ($filename) {
            // $path = public_path('foto_project/' . $filename);
            // UBAH INI: 'foto_project' -> 'temp_uploads'
            $path = public_path('temp_uploads/' . $filename);
            if (File::exists($path)) {
                File::delete($path);
                return response()->json(['success' => true]);
            }
        }
        return response()->json(['success' => false], 404);
    }
}
