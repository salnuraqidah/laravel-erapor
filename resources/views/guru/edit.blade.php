@extends('layouts.index')
@section('content')
@foreach ($data as $rs )
<span class="section">Edit Data Guru</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('guru.update',$rs->id)}}" enctype="multipart/form-data">
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
        <label class="col-form-label col-md-3 col-sm-3 label-align">Pendidikan <span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->pendidikan : old('pendidikan'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="pendidikan" value="{{ $val }}" class="form-control @error ('pendidikan') is-invalid @enderror">
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
        <button type='submit' class="btn btn-warning" name="proses" value="ubah"><i class="fa fa-pencil-square-o"></i>&nbsp;Edit</button>
</div>
</div>
</div>
</form>
@endforeach
@endsection