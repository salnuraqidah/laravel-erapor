@extends('layouts.index')
@section('content')
@php
    $no = 1;
    $ar_judul = ['No','NIP', 'Nama Wali Kelas','Kelas','Jurusan','Foto','Action'];
@endphp

<div class="clearfix"></div>
<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Data Wali Kelas</h2>
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
<a href="{{ route('walikelas.create') }}" class="btn btn-info  btn-user">
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
        @foreach ($ar_walas as $wali_kelas)
      <tr>
        <td>{{ $no++ }}</td>
        <td>{{ $wali_kelas->nip }}</td>
        <td>{{ $wali_kelas->nama }}</td>
        <td>{{ $wali_kelas->kls }}</td>
        <td>{{ $wali_kelas->jur }}</td>
        @if (!empty($wali_kelas->foto))
            <td><img src="{{ asset('images/walikelas')}}/{{ $wali_kelas->foto }}" width="70px"/></td>
        @else
            <td><img src="{{ asset('images')}}/no_photo.png" width="70px"/></td>
        @endif
        <td>
            <form method="POST" action="{{ route('walikelas.destroy',$wali_kelas->id) }}">
                @csrf
                @method('DELETE')
                <a class="btn btn-info" href="{{ route('walikelas.show',$wali_kelas->id) }}"><i class="fa fa-folder"></i></a>&nbsp;
                <a class="btn btn-warning" href="{{ route('walikelas.edit',$wali_kelas->id) }}"><i class="fa fa-pencil-square-o"></i></a>&nbsp;
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