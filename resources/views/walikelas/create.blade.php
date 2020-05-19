@extends('layouts.index')
@section('content')
@php
$rs1 = App\Kelas::all();
$rs2 = App\Jurusan::all();
$ar_gender = ['Laki-Laki' => 'L', 'Perempuan' => 'P'];
@endphp

<span class="section">Input Data Wali Kelas</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('walikelas.store')}}" enctype="multipart/form-data">
    @csrf

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">NIP <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="nip" value="{{ old('nip') }}" class="form-control @error ('nip') is-invalid @enderror">
          @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Lengkap <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="nama" value="{{ old('nama') }}" class="form-control @error ('nama') is-invalid @enderror">
          @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Kelas <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <select class="select2_single form-control @error ('kelas') is-invalid @enderror" name="kelas" tabindex="-1">
            <option value="">-- Pilih Kelas --</option>
            @foreach($rs1 as $kls)
            @php
                $sel = ( old('kelas') == $kls['id']) ? 'selected' : ''
            @endphp
                <option value="{{ $kls['id']}}" {{ $sel }}>{{ $kls['nama']}}</option>
            @endforeach
          </select>
          @error('kelas') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Jurusan <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <select class="select2_single form-control @error ('jurusan') is-invalid @enderror" name="jurusan" tabindex="-1">
            <option value="">-- Pilih Jurusan --</option>
            @foreach($rs2 as $jur)
            @php
                $sel = ( old('jurusan') == $jur['id']) ? 'selected' : ''
            @endphp
                <option value="{{ $jur['id']}}" {{ $sel }}>{{ $jur['nama']}}</option>
            @endforeach
          </select>
          @error('jurusan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Pendidikan <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="pendidikan" value="{{ old('pendidikan') }}" class="form-control @error ('pendidikan') is-invalid @enderror">
          @error('pendidikan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label  class="col-form-label col-md-3 col-sm-3 label-align">Foto</label>
        <div class="col-md-6 col-sm-6 ">
          <input type="file"  class="form-control @error ('foto') is-invalid @enderror"  name="foto">
          @error('foto') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>

      

<div class="ln_solid">
    <div class="form-group">
      <div class="col-md-6 offset-md-3">
  <button type='submit' class="btn btn-primary" name="proses" value="simpan">Simpan</button>
</div>
</div>
</div>
</form>
 @endsection