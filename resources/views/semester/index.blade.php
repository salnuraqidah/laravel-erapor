@extends('layouts.index')
@section('content')
@if (Auth::user()->role == 'admin')
@php
    $no = 1;
    $ar_judul = ['Semester','Tahun Ajaran','Action'];
@endphp

<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Setting Semester</h2>
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
        @foreach ($ar_semester as $semester)
      <tr>
        <td>{{ $semester->semester }}</td>
        <td>{{ $semester->tahun_ajaran }}</td>
        <td>
            <a class="btn btn-secondary" href="{{ route('semester.edit',$semester->id) }}"><i class="fa fa-cog"></i></a>
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