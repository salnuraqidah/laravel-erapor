@extends('layouts.index')
@section('content')
@php
    $ar_matpel = App\Matpel::all();
    $ar_siswa = App\Siswa::all();
    $ar_guru = App\Guru::all();
    $ar_semester = App\Semester::all();
    $ar_sekolah = App\Sekolah::all();
    

    $jml_guru=0;
    $jml_siswa=0;
    $jml_matapelajaran=0;
@endphp
@foreach ($ar_guru as $g)
  @php
      $jml_guru++;
  @endphp 
@endforeach
@foreach ($ar_siswa as $s)
  @php
      $jml_siswa++;
  @endphp 
@endforeach
@foreach ($ar_matpel as $m)
  @php
      $jml_matapelajaran++;
  @endphp 
@endforeach

@foreach ($ar_semester as $semester)
<center><h3>Selamat Datang di Semester {{ $semester->semester }}</h3> 
  <h3>{{ $semester->tahun_ajaran }}</h3> </center>
@endforeach


<center>
<div class="row" style="display: inline;" >
    <div class="tile_count">
      <div class="col-md-4 col-sm-4   tile_stats_count">
        <i class="fa fa-user"></i> Total Guru
        <div class="count"><center>{{ $jml_guru }}</center></div>
        
      </div>
      <div class="col-md-4 col-sm-4  tile_stats_count">
        <i class="fa fa-graduation-cap"></i> Total Siswa
        <div class="count green"><center>{{ $jml_siswa }}</center></div>
        
      </div>
      <div class="col-md-4 col-sm-4  tile_stats_count">
        <span class="count_top"><i class="fa fa-book"></i> Total Mata Pelajaran</span>
        <div class="count red"><center>{{ $jml_matapelajaran }}</center></div>
        
      </div>
      
    </div>
  </div>
    <!-- /top tiles -->
  </center>
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item">
        <img src="{{ asset('images')}}/side1.png"  class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item  active">
        <img src="{{ asset('images')}}/side2.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>

@endsection