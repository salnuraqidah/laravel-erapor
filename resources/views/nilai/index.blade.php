@extends('layouts.index')
@section('content')
@if (Auth::user()->role != 'siswa')
@php
$rs1 = App\Siswa::all();
$rs2 = App\Nilai::all();
    $no = 1;
    $ar_judul = ['No','Nama','Kelas','Jurusan','Jumlah Mata Pelajaran','Total Nilai','Created at','Action'];        
@endphp
<div class="clearfix"></div>
@if (Session::has('success') or Session::has('success_edit'))
@php
    $css = (Session::has('success')) ? 'success' : 'warning';
    $pesan = (Session::has('success')) ? 'success' : 'success_edit';
@endphp

<div class="alert alert-{{ $css }}">
    {{ Session::get($pesan) }}
</div>
@endif
<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Penilaian Siswa</h2>
        
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
<a href="{{ route('nilai.create') }}" class="btn btn-info  btn-user">
  <i class="fa fa-plus"></i>&nbsp;Tambah Nilai
</a>
<br/><br/>

<table id="datatable" class="table table-striped table-bordered" style="width:100%">
    <thead>
      <tr>
        @foreach ($ar_judul as $judul)
        <th>{{ $judul }}</th>                    
        @endforeach
      </tr>
    </thead>
    <tbody>
        @foreach ($data_siswa as $siswa)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $siswa->nama_depan.' '.$siswa->nama_belakang }}</td>
        <td>{{  $siswa->kelas['nama']  }}</td>
        <td>{{  $siswa->jurusan['nama']  }}</td>
        <td>{{  $siswa->matpel->count()  }}</td>
        <td>{{  $siswa->test() }}</td>
        <td>{{  $siswa->test2()  }}</td>
        
        {{--  <!--td>{{  $siswa->test2()->last()}} </!--td--> --}}
        

        {{--  <!--td>{{  $siswa->matpel_baru->last()  }}</!--td--> --}}
        
        
        <td>
            <form method="POST" action="{{ route('nilai.destroy',$siswa->id) }}">
                @csrf
                <a class="btn btn-info" href="{{ route('nilai.show',$siswa->id) }}"><i class="fa fa-folder"></i>&nbsp;Detail Nilai</a>&nbsp;
                <a href="{{ url('pdfrapor',$siswa->id) }}" class="btn btn-dark"><i class="fa fa-print"></i>&nbsp;Unduh Rapor</a>
                </button>
              </form>
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