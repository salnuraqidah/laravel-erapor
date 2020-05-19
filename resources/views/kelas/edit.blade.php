@extends('layouts.index')
@section('content')
@foreach ($data as $rs )
<span class="section">Edit Data Kelas</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('kelas.update',$rs->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Kelas<span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->nama : old('nama'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="nama" value="{{ $val }}" class="form-control @error ('nama') is-invalid @enderror">
          @error('nama') <div class="invalid-feedback">{{ $message }}</div> @enderror
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