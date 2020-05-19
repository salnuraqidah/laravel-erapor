@extends('layouts.index')
@section('content')
@php
    $no = 1;
    $ar_judul = ['No','Kode', 'Mata Pelajaran','KKM','Guru','Action'];
@endphp
<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Mata Pelajaran</h2>
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
<a href="{{ route('matpel.create') }}" class="btn btn-info  btn-user">
  <i class="fa fa-plus"></i>&nbsp;Tambah Data
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
        @foreach ($ar_matpel as $matpel)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $matpel->kode }}</td>
        <td>{{ $matpel->nama }}</td>
        <td>{{ $matpel->kkm }}</td>
        <td>{{ $matpel->nama_depan.' '.$matpel->nama_belakang }}</td>
        <td>
            <form method="POST" action="{{ route('matpel.destroy',$matpel->id) }}">
                @csrf
                @method('DELETE')
                <a class="btn btn-warning" href="{{ route('matpel.edit',$matpel->id) }}"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
                <button type="submit" class="btn btn-danger" onclick="return confirm('Anda yakin ingin menghapus data ini?')" >
                <i class="fa fa-remove"></i>
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

@endsection