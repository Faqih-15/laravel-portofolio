@extends('dashboard.layout')

@section('content')

    <form action="{{ route('pengaturanHalaman.update') }}" method="POST">
        @csrf
        <div class="form-group row">
            <label class="col-sm-2">About</label>
            <div class="col-sm-6">
                <select class="form-control form-control-sm" name="_halaman_about">
                    <option value="">-Select-</option>
                    @foreach ($dataHalaman as $item)
                        <option value="{{ $item->id }}" {{ get_meta_value('_halaman_about') == $item->id ? 'selected' : '' }}>{{ $item->judul }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2">Interests</label>
            <div class="col-sm-6">
                <select class="form-control form-control-sm" name="_halaman_interest">
                    <option value="">-Select-</option>
                    @foreach ($dataHalaman as $item)
                        <option value="{{ $item->id }}" {{ get_meta_value('_halaman_interest') == $item->id ? 'selected' : '' }}>{{ $item->judul }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-sm-2">Certificates</label>
            <div class="col-sm-6">
                <select class="form-control form-control-sm" name="_halaman_award">
                    <option value="">-Select-</option>
                    @foreach ($dataHalaman as $item)
                        <option value="{{ $item->id }}" {{ get_meta_value('_halaman_award') == $item->id ? 'selected' : '' }}>{{ $item->judul }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <button class="btn btn-primary" name="simpan" type="submit">SAVE</button>
@endsection

