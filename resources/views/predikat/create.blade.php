@extends('layouts.index')
@section('content')

<span class="section">Input Data Predikat</span>
<form class="user" method="POST" action="{{ route('predikat.store')}}"
      enctype="multipart/form-data">
    @csrf
<div class="field item form-group">
    <label class="col-form-label col-md-3 col-sm-3  label-align">Predikat<span
        class="required">*</span></label>
        <div class="col-md-6 col-sm-6">
            <input class="form-control"name="nama"/>
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
 @endsection