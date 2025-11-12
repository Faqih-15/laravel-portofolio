<?php

namespace App\Http\Controllers;

use App\Models\metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class profileController extends Controller
{
    function index()
    {
        return view('dashboard.profile.index');
    }

function update(Request $request)
{
    $request->validate([
        '_foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        '_email' => 'required|email',
    ],[
        '_foto.mimes' => 'The photo must be a file of type: JPEG, PNG, JPG, or GIF.',
        '_foto.max' => 'The photo size cannot be larger than 2MB.',
        '_email.required' => 'The Email field is required.',
        '_email.email' => 'The email format is invalid.',
    ]);

    if($request->hasFile('_foto')){
        $foto_file = $request->file('_foto');
        $foto_ekstensi = $foto_file->extension();
        $foto_baru = date('ymdhis').".".$foto_ekstensi;
        $foto_file->move(public_path('foto'), $foto_baru);
        // kalau ada update foto
        $foto_lama = get_meta_value('_foto');
        if ($foto_lama) {                                            // ditambah if karena jika $foto_lama kosong (karena user belum pernah upload foto),
            File::delete(public_path('foto') . '/' . $foto_lama);    // perintah File::delete akan mencoba menghapus folder public/foto/, yang bisa menyebabkan error.
        }

        metadata::updateOrCreate(
            ['meta_key' => '_foto'],
            ['meta_value' => $foto_baru]
        );
    }
    metadata::updateOrCreate(
        ['meta_key' => '_email'],
        ['meta_value' => $request->_email]
    );
    metadata::updateOrCreate(
        ['meta_key' => '_kota'],
        ['meta_value' => $request->_kota]
    );
    metadata::updateOrCreate(
        ['meta_key' => '_provinsi'],
        ['meta_value' => $request->_provinsi]
    );
    metadata::updateOrCreate(
        ['meta_key' => '_nohp'],
        ['meta_value' => $request->_nohp]
    );


    metadata::updateOrCreate(
        ['meta_key' => '_instagram'],
        ['meta_value' => $request->_instagram]
    );
    metadata::updateOrCreate(
        ['meta_key' => '_facebook'],
        ['meta_value' => $request->_facebook]
    );
    metadata::updateOrCreate(
        ['meta_key' => '_linkedin'],
        ['meta_value' => $request->_linkedin]
    );
    metadata::updateOrCreate(
        ['meta_key' => '_github'],
        ['meta_value' => $request->_github]
    );
    metadata::updateOrCreate(
        ['meta_key' => '_whatsapp'],
        ['meta_value' => $request->_whatsapp]
    );

    return redirect()->route('profile.index')->with('success', 'Profile updated successfully.');
    }
}

