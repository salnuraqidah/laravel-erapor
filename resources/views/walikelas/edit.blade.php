@extends('layouts.index')
@section('content')
@foreach ($data as $rs )
@php
$rs1 = App\Kelas::all();
$rs2 = App\Jurusan::all();
@endphp

<span class="section">Edit Data Wali Kelas</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('walikelas.update',$rs->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">NIP <span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->nip : old('nip'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="nip" value="{{ $val }}" class="form-control @error ('nip') is-invalid @enderror">
          @error('nip') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Lengkap <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            @php $val = ($errors->isEmpty()) ? $rs->nama : old('nama'); @endphp
          <input type="text" name="nama" value="{{ $val }}" class="form-control @error ('nama') is-invalid @enderror">
          @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Pendidikan <span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->pendidikan : old('pendidikan'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="pendidikan" value="{{ $val }}" class="form-control @error ('pendidikan') is-invalid @enderror">
          @error('pendidikan') <div class="invalid-feedback">{{ $message }}</div> @enderror
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
 @endsection