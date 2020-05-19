@extends('layouts.index')
@section('content')
@if (Auth::user()->role != 'siswa')
@php
$rs1 = App\Siswa::all();
$rs2 = App\Matpel::all();
$rs3 = App\Predikat::all();
@endphp
<span class="section">Edit Nilai</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
@foreach ($data as $rs )
<form class="user" method="POST" action="{{ route('nilai.update',$rs->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Siswa <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <select disabled class="select2_single form-control @error ('siswa') is-invalid @enderror" name="siswa" tabindex="-1">
            <option value="">-- Pilih Siswa --</option>
            @foreach($rs1 as $siswa)
            
            @php
                $sel = ( $siswa['id'] == $rs->siswa_id) ? 'selected' : ''
            @endphp
                <option value="{{ $siswa['id']}}" {{ $sel }}>{{ $siswa['nama_depan'].' '.$siswa['nama_belakang']}}</option>
            @endforeach
          </select>
          @error('siswa') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Mata Pelajaran <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <select disabled class="select2_single form-control @error ('matpel') is-invalid @enderror" name="matpel" tabindex="-1">
            <option value="">-- Pilih Mata Pelajaran --</option>
            @foreach($rs2 as $matpel)
            @php
                $sel = ( $matpel['id'] == $rs->matpel_id) ? 'selected' : ''
            @endphp
                <option value="{{ $matpel['id']}}" {{ $sel }}>{{ $matpel['nama']}}</option>
            @endforeach
          </select>
          @error('matpel') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Nilai <span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->nilai : old('nilai'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="nilai" value="{{ $val }}" class="form-control @error ('nilai') is-invalid @enderror">
          @error('nilai') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
     

      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Sikap/Afektif <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <select class="select2_single form-control @error ('predikat') is-invalid @enderror" name="predikat" tabindex="-1">
            <option value="">-- Pilih Predikat --</option>
            @foreach($rs3 as $predikat)
            @if($errors->isEmpty())
            @php
                $sel = ( $predikat['id'] == $rs->predikat_id) ? 'selected' : ''
            @endphp
                <option value="{{ $predikat['id']}}" {{ $sel }}>{{ $predikat['nama']}}</option>
            @else
                <option value="{{ $predikat['id']}}">{{ $predikat['nama']}}</option>
            @endif
           @endforeach
          </select>
          @error('predikat') <div class="invalid-feedback">{{ $message }}</div> @enderror
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