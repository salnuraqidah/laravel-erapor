@extends('layouts.index')
@section('content')
@if (Auth::user()->role == 'admin')
@foreach ($data as $rs )
@php
$rs1 = App\Kelas::all();
$rs2 = App\Jurusan::all();
$ar_gender = ['Laki-Laki' => 'L', 'Perempuan' => 'P'];
@endphp

<span class="section">Edit Data Siswa</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('siswa.update',$rs->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">NISN <span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->nisn : old('nisn'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="nisn" value="{{ $val }}" class="form-control @error ('nisn') is-invalid @enderror">
          @error('nisn') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Depan <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            @php $val = ($errors->isEmpty()) ? $rs->nama_depan : old('nama_depan'); @endphp
          <input type="text" name="nama_depan" value="{{ $val }}" class="form-control @error ('nama_depan') is-invalid @enderror">
          @error('nama_depan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Belakang <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            @php $val = ($errors->isEmpty()) ? $rs->nama_belakang : old('nama_belakang'); @endphp
          <input type="text" name="nama_belakang" value="{{ $val }}" class="form-control @error ('nama_belakang') is-invalid @enderror">
          @error('nama_belakang') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Kelas <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <select class="select2_single form-control @error ('kelas') is-invalid @enderror" name="kelas" tabindex="-1">
            <option value="">-- Pilih Kelas --</option>
            @foreach($rs1 as $kls)
            @if($errors->isEmpty())
            @php  $sel = ( $kls['id'] == $rs->kelas_id) ? 'selected' : ''; @endphp
                <option value="{{ $kls['id']}}" {{ $sel }}>{{ $kls['nama']}}</option>
            @else
                <option value="{{ $kls['id'] }}">{{ $kls['nama'] }}</option>
            @endif  
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
            @if($errors->isEmpty())
            @php  $sel = ( $jur['id'] == $rs->jurusan_id) ? 'selected' : ''; @endphp
                <option value="{{ $jur['id']}}" {{ $sel }}>{{ $jur['nama']}}</option>
            @else
                <option value="{{ $jur['id'] }}">{{ $jur['nama'] }}</option>
            @endif  
            @endforeach
          </select>
          @error('jurusan') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Gender<span>*</span></label>
        <div class="col-md-6 col-sm-6 ">
          <div id="gender" class="btn-group" data-toggle="buttons">
            @foreach ($ar_gender as $label => $jk)
            @php
            $cek = ($jk ==  $rs->gander) ? 'checked' : '';
            $css = ($jk ==  'L') ? 'secondary' : 'primary'; 
            @endphp
            <label class="btn btn-{{ $css }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                <input type="radio" {{ $cek }}  class="flat @error ('gender') is-invalid @enderror" name="gender" 
                value="{{ $jk }}"/>&nbsp; {{ $label }}
            </label>
            @endforeach
          </div>
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Tempat Lahir <span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->tempat_lahir : old('tempat_lahir'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="tempat_lahir" value="{{ $val }}" class="form-control @error ('tempat_lahir') is-invalid @enderror">
          @error('tempat_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="item form-group">
        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Lahir</label>
        @php $val = ($errors->isEmpty()) ? $rs->tanggal_lahir : old('tanggal_lahir'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="date" name="tanggal_lahir" value="{{ $val }}" class="form-control @error ('tanggal_lahir') is-invalid @enderror">
          @error('tanggal_lahir') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">No Telp
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->kontak : old('kontak'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="kontak" value="{{ $val }}" class="form-control @error ('kontak') is-invalid @enderror">
          @error('kontak') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="control-label col-md-3 col-sm-3 label-align">Alamat <span class="required">*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->alamat : old('alamat'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <textarea  class="form-control @error ('alamat') is-invalid @enderror" rows="3" name="alamat" placeholder="Alamat Lengkap">{{ $val }}</textarea>
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
        <button type='submit' class="btn btn-warning" name="proses" value="ubah"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>
</div>
</div>
</div>
</form>
@endforeach
@else
@include('auth.terlarang')
@endif   
 @endsection