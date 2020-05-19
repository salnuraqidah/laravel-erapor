@extends('layouts.index')
@section('content')
@if (Auth::user()->role == 'admin')
@php
    $ar_judul = ['Nama Sekolah','Kepala Sekolah','Kota','Alamat','Website','No Telp','Setting'];
@endphp

<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Identitas Sekolah</h2>
          <ul class="nav navbar-right panel_toolbox">
             <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
              </li>
          </ul>
                <div class="clearfix"></div>
      </div>
            <div class="x_content">
                <div class="row">
                  <div class="col-sm-12">
                    <div class="card-box table-responsive">

<table id="datatable" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        @foreach ($ar_judul as $judul)
        <th>{{ $judul }}</th>                    
        @endforeach
      </tr>
    </thead>
    <tbody>
        @foreach ($ar_sekolah as $sekolah)
      <tr>
        <td>{{ $sekolah->nama_sekolah }}</td>
        <td>{{ $sekolah->kepala_sekolah }}</td>
        <td>{{ $sekolah->kota }}</td>
        <td>{{ $sekolah->alamat }}</td>
        <td>{{ $sekolah->website }}</td>
        <td>{{ $sekolah->telp }}</td>
        <td>
            <a class="btn btn-secondary" href="{{ route('sekolah.edit',$sekolah->id) }}"><i class="fa fa-cog"></i></a>&nbsp;
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
@else
@include('auth.terlarang')
@endif  
@endsection