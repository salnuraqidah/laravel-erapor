@extends('layouts.index')
@section('content')
@if (Auth::user()->role == 'admin')
<span class="section">Input Data Admin</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('member.store')}}" enctype="multipart/form-data">
    @csrf

    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Nama <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="name" value="{{ old('name') }}" class="form-control @error ('name') is-invalid @enderror">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Email <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="email" name="email" value="{{ old('nama') }}" class="form-control @error ('nama') is-invalid @enderror">
          @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      
     
     
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Password <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
          <input type="password" name="password" value="{{ old('password') }}" class="form-control @error ('password') is-invalid @enderror">
          @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
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