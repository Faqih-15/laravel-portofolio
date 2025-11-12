<?php

use App\Models\metadata;

function get_meta_value($meta_key)
{
    $data = metadata::where('meta_key', $meta_key)->first();
    if ($data) {
        return $data->meta_value;
    }
}

function set_about_nama($nama)
{
    //nama = ahmad abdillah
    $arr = explode(" ", $nama);                             //idx 1 = ahmad, idx 2 = abdillah
    $kataakhir = end($arr);                                 //ambil kata terakhir
    $kataakhir2 = "<span class='text-primary'>$kataakhir</span>";
    array_pop($arr);                                        //hapus kata terakhir dari array
    $namaAwal = implode(" ", $arr);                         //gabungkan kembali kata awal
    return $namaAwal . " " . $kataakhir2;                   //return <span class='text-primary'>abdillah</span>
}

function set_list_award($isi)
{
    $isi = str_replace("<ul>", "<ul class='fa-ul mb-0'>", $isi);
    $isi = str_replace("<li>", '<li><span class="fa-li"><i class="fas fa-chevron-right"></i></span>', $isi);
    return $isi;
}
function set_list_workflow($isi)
{
    $isi = str_replace("<ul>", "<ul class='fa-ul mb-0'>", $isi);
    $isi = str_replace("<li>", '<li><span class="fa-li"><i class="fas fa-check"></i></span>', $isi);
    return $isi;
}

