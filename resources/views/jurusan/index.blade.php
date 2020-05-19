@extends('layouts.index')
@section('content')
@if (Auth::user()->role == 'admin')
@php
    $no = 1;
    $ar_judul = ['No', 'Kode','Jurusan','Action'];
@endphp
<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Jurusan</h2>
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
<a href="{{ route('jurusan.create') }}" class="btn btn-info  btn-user">
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
        @foreach ($ar_jurusan as $jurusan)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $jurusan->kode }}</td>
        <td>{{ $jurusan->nama }}</td>
        <td>
          <form method="POST" action="{{ route('jurusan.destroy',$jurusan->id) }}">
            @csrf
            @method('DELETE')
            <a class="btn btn-warning" href="{{ route('jurusan.edit',$jurusan->id) }}"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
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
@else
  @include('auth.terlarang')
  @endif
@endsection