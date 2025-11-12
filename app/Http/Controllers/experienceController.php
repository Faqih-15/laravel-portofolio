<?php

namespace App\Http\Controllers;

use App\Models\riwayat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class experienceController extends Controller
{
    protected $_tipe;   // mendeklarasikan properti agar _tipe bisa digunakan di seluruh method class.
    function __construct()
    {
        $this->_tipe = 'experience';
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = riwayat::where('tipe', $this->_tipe)->orderBy('tgl_akhir', 'desc')->get();
        return view('dashboard.experience.index')->with('data', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.experience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Session::flash('judul', $request->judul);
        Session::flash('info1', $request->info1);
        Session::flash('tgl_mulai', $request->tgl_mulai);
        Session::flash('tgl_akhir', $request->tgl_akhir);
        Session::flash('isi', $request->isi);

        $request->validate(
        [
            'judul' => 'required',
            'info1' => 'required',
            'tgl_mulai' => 'required|date',
            'isi' => 'required',
        ],[
            'judul.required' => 'The Position is required.',
            'info1.required' => 'The Company Name is required.',
            'tgl_mulai.required' => 'The Start Date is required.',
            'isi.required' => 'The Description is required.',
        ]);

        $data = [
            'judul' => $request->judul,
            'info1' => $request->info1,
            'tipe' => $this->_tipe,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'isi' => $request->isi,
        ];
        riwayat::create($data);

        return redirect()->route('experience.index')->with('success', 'Experience record added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = riwayat::where('id', $id)->where('tipe', $this->_tipe)->first();
        return view('dashboard.experience.edit')->with('data', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

    // Validasi input
    $request->validate([
        'judul' => 'required',
        'info1' => 'required',
        'tgl_mulai' => 'required|date',
        'isi' => 'required',
    ], [
        'judul.required' => 'The Position is required.',
        'info1.required' => 'The Company Name is required.',
        'tgl_mulai.required' => 'The Start Date is required.',
        'isi.required' => 'The Description is required.',
    ]);

    // Update data ke database
    $data = [
        'judul' => $request->judul,
        'info1' => $request->info1,
        'tgl_mulai' => $request->tgl_mulai,
        'tgl_akhir' => $request->tgl_akhir,
        'isi' => $request->isi,
    ];

    riwayat::where('id', $id)->where('tipe', $this->_tipe)->update($data);

    // Redirect kembali ke halaman daftar experience
    return redirect()->route('experience.index')->with('success', 'Experience record updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        riwayat::where('id', $id)->where('tipe', $this->_tipe)->delete();
        return redirect()->route('experience.index')->with('success', 'Experience record deleted successfully.');
    }
}
