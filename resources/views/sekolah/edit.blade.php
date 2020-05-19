@extends('layouts.index')
@section('content')
@if (Auth::user()->role == 'admin')
@foreach ($data as $rs )
<span class="section">Setting Identitas Sekolah</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('sekolah.update',$rs->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Nama Sekolah <span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->nama_sekolah : old('nama_sekolah'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="nama_sekolah" value="{{ $val }}" class="form-control @error ('nama_sekolah') is-invalid @enderror">
          @error('nama_sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Kepala Sekolah <span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->kepala_sekolah : old('kepala_sekolah'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="kepala_sekolah" value="{{ $val }}" class="form-control @error ('kepala_sekolah') is-invalid @enderror">
          @error('kepala_sekolah') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Kota<span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->kota : old('kota'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="kota" value="{{ $val }}" class="form-control @error ('kota') is-invalid @enderror">
          @error('kota') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Kota<span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->alamat : old('Alamat'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="alamat" value="{{ $val }}" class="form-control @error ('alamat') is-invalid @enderror">
          @error('alamat') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Website<span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->website : old('website'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="website" value="{{ $val }}" class="form-control @error ('website') is-invalid @enderror">
          @error('website') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">No Telp<span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->telp : old('telp'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="telp" value="{{ $val }}" class="form-control @error ('telp') is-invalid @enderror">
          @error('telp') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
    </div>

<div class="ln_solid">
    <div class="form-group">
      <div class="col-md-6 offset-md-3">
  <button type='submit' class="btn btn-primary" name="setting" value="setting"><i class="fa fa-cog"></i>&nbsp;Setiing</button>
</div>
</div>
</div>
</form>
@endforeach
@else
@include('auth.terlarang')
@endif 
@endsection