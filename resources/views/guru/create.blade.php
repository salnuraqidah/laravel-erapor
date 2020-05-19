@extends('layouts.index')
@section('content')
@if (Auth::user()->role == 'admin')
<span class="section">Input Data Guru</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('guru.store')}}" enctype="multipart/form-data">
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
        <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Depan <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="nama_depan" value="{{ old('nama_depan') }}" class="form-control @error ('nama_depan') is-invalid @enderror">
          @error('nama_depan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Belakang <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="nama_belakang" value="{{ old('nama_belakang') }}" class="form-control @error ('nama_belakang') is-invalid @enderror">
          @error('nama_belakang') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
@else
@include('auth.terlarang')
@endif
 @endsection