@extends('layouts.index')
@section('content')
@if (Auth::user()->role == 'admin')
@foreach ($data as $rs )
@php
$ar_role = [
    'Administrator' => 'admin',
    'Guru' => 'guru',
    'Siswa' => 'siswa',
];
$ar_status = [
    'Active' => 'active',
    'Inactive' => 'inactive',
    'Banned' => 'banned',
];
@endphp
<span class="section">Edit Member</span>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form class="user" method="POST" action="{{ route('member.update',$rs->id)}}" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Nama <span>*</span>
        </label>
        @php $val = ($errors->isEmpty()) ? $rs->name : old('name'); @endphp
        <div class="col-md-6 col-sm-6 ">
          <input type="text" name="name" value="{{ $val }}" class="form-control @error ('name') is-invalid @enderror">
          @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Email <span>*</span>
        </label>
        <div class="col-md-6 col-sm-6 ">
            @php $val = ($errors->isEmpty()) ? $rs->email : old('email'); @endphp
          <input type="text" name="email" value="{{ $val }}" class="form-control @error ('email') is-invalid @enderror">
          @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Role<span>*</span></label>
        <div class="col-md-6 col-sm-6 ">
          <div id="gender" class="btn-group" data-toggle="buttons">
            @foreach ($ar_role as $label => $role)
            @php
            $cek = ($role ==  $rs->role) ? 'checked' : '';
            //$css = ($role ==  '') ? 'secondary' : 'primary'; 
            @endphp
            <label class="btn btn-secondary" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                <input type="radio" {{ $cek }}  class="flat @error ('role') is-invalid @enderror" name="role" 
                value="{{ $role }}"/>&nbsp; {{ $label }}
            </label>
            @endforeach
          </div>
        </div>
      </div>
      <div class="item form-group">
        <label class="col-form-label col-md-3 col-sm-3 label-align">Status<span>*</span></label>
        <div class="col-md-6 col-sm-6 ">
          <div id="gender" class="btn-group" data-toggle="buttons">
            @foreach ($ar_status as $label => $status)
            @php
            $cek = ($status ==  $rs->status) ? 'checked' : '';
            //$css = ($role ==  '') ? 'secondary' : 'primary'; 
            @endphp
            @if ($label == 'Active')
            @php
            $css ='primary'; 
            @endphp              
            @elseif ($label == 'Inactive')
            @php
            $css ='warning'; 
            @endphp
            @else
            @php
            $css ='danger'; 
            @endphp
            @endif
            <label class="btn btn-{{ $css }}" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                <input type="radio" {{ $cek }}  class="flat @error ('status') is-invalid @enderror" name="status" 
                value="{{ $status }}"/>&nbsp; {{ $label }}
            </label>
            @endforeach
          </div>
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
  <button type='submit' class="btn btn-warning" name="proses" value="edit">Edit</button>
</div>
</div>
</div>
</form>
@endforeach
@else
  @include('auth.terlarang')
  @endif  
 @endsection