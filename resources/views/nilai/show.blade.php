@extends('layouts.index')
@section('content')
@if (Auth::user()->role != 'siswa')
@php
    $no = 1;
    $ar_judul = ['No','Mata Pelajaran','Nilai','Sikap/Afektif','Action'];
@endphp

<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>{{ $siswa->nama_depan.' '.$siswa->nama_belakang }}</h2>
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
        @foreach ($ar_nilai as $data)    
                    <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $data->matpel }}</td>
                    <td>{{ $data->nilai }}</td>
                    <td>{{ $data->predikat }}</td>
        <td>
            <form method="POST" action="{{ route('nilai.destroy',$data->id) }}">
                @csrf
                @method('DELETE')
                <a class="btn btn-warning" href="{{ route('nilai.edit',$data->id) }}"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')" >
                <i class="fa fa-remove"></i>
                </button>
              </form>
        </td>
      </tr>
      @endforeach
    </tbody>
        @php
        $nilai = collect($ar_nilai)->sum('nilai');        
        @endphp   
        <tfoot>
            <tr>
            <th colspan="2">Total Nilai</th>
            <th colspan="3">{{ $nilai }}</th>
            </tr>
        </tfoot>
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
