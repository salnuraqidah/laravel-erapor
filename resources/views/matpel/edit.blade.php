@extends('layouts.index')
@section('content')
@foreach ($data as $rs )
@php
$rs1 = App\Guru::all();
@endphp
<span class="section">Edit Data Mata Pelajaran</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('matpel.update',$rs->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Kode <span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->kode : old('kode'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="kode" value="{{ $val }}" class="form-control @error ('kode') is-invalid @enderror">
          @error('kode') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Mata Pelajaran <span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->nama : old('nama'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="nama" value="{{ $val }}" class="form-control @error ('nama') is-invalid @enderror">
          @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      
     
     
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">KKM <span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->kkm : old('kkm'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="kkm" value="{{ $val }}" class="form-control @error ('kkm') is-invalid @enderror">
          @error('kkm') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>

      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Guru <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <select class="select2_single form-control @error ('guru') is-invalid @enderror" name="guru" tabindex="-1">
            <option value="">-- Pilih Guru --</option>
            @foreach($rs1 as $guru)
            @if($errors->isEmpty())
            @php
                $sel = ( $guru['id'] == $rs->guru_id) ? 'selected' : ''
            @endphp
                <option value="{{ $guru['id']}}" {{ $sel }}>{{ $guru['nama_depan'].' '.$guru['nama_belakang']}}</option>
            @else
                <option value="{{ $guru['id']}}">{{ $guru['nama_depan'].' '.$guru['nama_belakang']}}</option>
            @endif
            @endforeach
          </select>
          @error('guru') <div class="invalid-feedback">{{ $message }}</div> @enderror
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