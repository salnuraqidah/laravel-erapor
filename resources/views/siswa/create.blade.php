@extends('layouts.index')
@section('content')
@if (Auth::user()->role == 'admin')
@php
$rs1 = App\Kelas::all();
$rs2 = App\Jurusan::all();
$ar_gander = ['Laki-Laki' => 'L', 'Perempuan' => 'P'];
@endphp

<span class="section">Input Data Siswa</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('siswa.store')}}" enctype="multipart/form-data">
    @csrf

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">NISN <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="nisn" value="{{ old('nisn') }}" class="form-control @error ('nisn') is-invalid @enderror">
          @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
      
      {{--  
      <!--div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Email <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="email" name="email" value="{{ old('nama') }}" class="form-control @error ('nama') is-invalid @enderror">
          @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </!--div--> --}}
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
        <label class="col-form-label col-md-3 col-sm-3 label-align">Gander<span>*</span></label>
        <div class="col-md-6 col-sm-6 ">
          <div id="gander" class="btn-group" data-toggle="buttons">
            @foreach ($ar_gander as $label => $jk)
            @php
            $cek = (old('gander') ==  $jk) ? 'checked' : '';
            $css = ($jk ==  'L') ? 'secondary' : 'primary'; 
            @endphp
            <label class="btn btn-{{ $css }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                <input type="radio" {{ $cek }}  class="flat @error ('gander') is-invalid @enderror" name="gander" value="{{ $jk }}"/>&nbsp; {{ $label }}
            </label>
            @endforeach
          </div>
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Tempat Lahir <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="tempat_lahir" value="{{ old('tempat_lahir') }}" class="form-control @error ('tempat_lahir') is-invalid @enderror">
          @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="item form-group">
        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Lahir</label>
        <div class="col-md-6 col-sm-6 ">
          <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}" class="form-control @error ('tanggal_lahir') is-invalid @enderror">
          @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">No Telp
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="kontak" value="{{ old('kontak') }}" class="form-control @error ('kontak') is-invalid @enderror">
          @error('kontak') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 label-align">Alamat <span class="required">*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <textarea  class="form-control @error ('alamat') is-invalid @enderror" rows="3" name="alamat" placeholder="Alamat Lengkap">{{old('alamat')}}</textarea>
          @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
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