@extends('layouts.index')
@section('content')
@if (Auth::user()->role == 'admin')
@foreach ($data as $rs )
<span class="section">Setting Semester</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('semester.update',$rs->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Semester<span>*</span></label>
        <div class="col-md-6 col-sm-6 ">
          <div id="gender" class="btn-group" data-toggle="buttons">
            @php
                $ar_semester = ['Genap','Ganjil'];
            @endphp
            @foreach ($ar_semester as  $semester)
            @php
            $cek = ($semester ==  $rs->semester) ? 'checked' : '';
            $css = ($semester ==  'Ganjil') ? 'warning' : 'info'; 
            @endphp
            <label class="btn btn-{{ $css }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                <input type="radio" {{ $cek }}  class="flat @error ('semester') is-invalid @enderror" name="semester" 
                value="{{ $semester }}"/>&nbsp; {{ $semester }}
            </label>
            @endforeach
          </div>
        </div>
      </div>
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Tahun Pelajaran<span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->tahun_ajaran : old('tahun_ajaran'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="tahun_ajaran" value="{{ $val }}" class="form-control @error ('tahun_ajaran') is-invalid @enderror">
          @error('tahun_ajaran') <div class="invalid-feedback">{{ $message }}</div> @enderror
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