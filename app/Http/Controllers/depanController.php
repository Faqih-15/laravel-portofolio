<?php

namespace App\Http\Controllers;

use App\Models\halaman;
use App\Models\riwayat;
use App\Models\Project;
use Illuminate\Http\Request;

class depanController extends Controller
{
    public function index()
    {
        $about_id = get_meta_value('_halaman_about');
        $about_data = halaman::where('id', $about_id)->first();

        // Ambil semua data project dari database
        $project_data = Project::latest()->get();   // Ambil semua data project, urutkan dari yang terbaru

        $interest_id = get_meta_value('_halaman_interest');
        $interest_data = halaman::where('id', $interest_id)->first();

        $award_id = get_meta_value('_halaman_award');
        $award_data = halaman::where('id', $award_id)->first();

        $experience_data = riwayat::where('tipe', 'experience')->get();
        $education_data = riwayat::where('tipe', 'education')->get();

        return view('depan.index')->with([
            'about' => $about_data,
            'interest' => $interest_data,
            'award' => $award_data,
            'experience' => $experience_data,
            'education' => $education_data,
            'project' => $project_data, // Kirim data project ke view
        ]);
    }
}
