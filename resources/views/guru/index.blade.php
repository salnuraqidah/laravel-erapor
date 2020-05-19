@extends('layouts.index')
@section('content')
@if (Auth::user()->role == 'admin')

@php
    $no = 1;
    $ar_judul = ['No','NIP', 'Nama','Pendidikan','Foto','Action'];
@endphp
<div class="clearfix"></div>

<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Guru</h2>
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
<a href="{{ route('guru.create') }}" class="btn btn-info  btn-user">
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
        @foreach ($ar_guru as $guru)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $guru->nip }}</td>
        <td>{{ $guru->nama_depan.' '.$guru->nama_belakang }}</td>
        <td>{{ $guru->pendidikan }}</td>
        @if (!empty($guru->foto))
            <td><img src="{{ asset('images/guru')}}/{{ $guru->foto }}" width="70px"/></td>
        @else
            <td><img src="{{ asset('images')}}/no_photo.png" width="70px"/></td>
        @endif
              
        <td>
            <form method="POST" action="{{ route('guru.destroy',$guru->id) }}">
                @csrf
                @method('DELETE')
                <a class="btn btn-info" href="{{ route('guru.show',$guru->id) }}"><i class="fa fa-folder"></i></a>&nbsp;
                <a class="btn btn-warning" href="{{ route('guru.edit',$guru->id) }}"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
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