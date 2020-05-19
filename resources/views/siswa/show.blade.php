@extends('layouts.index')
@section('content')
@foreach ($ar_siswa as $siswa)
{{--  --}}

@php
$mem = App\Member::all();
$jk = ($siswa->gander == 'P' ? 'Perempuan' : 'Laki-Laki');
    $ar_judul = ['Nama Lengkap'=> $siswa->nama_depan.' '.$siswa->nama_belakang,'NISN' => $siswa->nisn,
    'Kelas'=> $siswa->kelas,
    'Jurusan'=> $siswa->jurusan,
    'Jenis Kelamin'=> $jk,
    'Tempat Lahir'=> $siswa->tempat_lahir,'Tanggal Lahir' => $siswa->tanggal_lahir,'No Hp'=> $siswa->kontak,
    'Alamat'=> $siswa->alamat];
    $no=1;
@endphp
<div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>My Profile</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-3 col-sm-3  profile_left">
                      <div class="profile_img">
                        <div id="crop-avatar">
                          <!-- Current avatar -->
                          @if (!empty($siswa->foto))
                          <img src="{{ asset('images/siswa')}}/{{ $siswa->foto }}" class="img-responsive avatar-view" width="200px" alt="Avatar"/>
                          @else
                          <img class="img-responsive avatar-view" src="{{ asset('images/no_photo.png') }}" width="200px" alt="Avatar" title="Change the avatar">  
                          @endif
                        </div>
                      </div>
                      <br>
                      <h4>{{ $siswa->nama_depan}} {{ $siswa->nama_belakang}}</h4>
                      @foreach ($mem as $member)
                      @if ($siswa->user_id == $member->id)
                        @php
                            $email = $member->email;
                        @endphp  
                      @endif
                      @endforeach 
                      <ul class="list-unstyled user_data">
                        <li><i class="fa fa-envelope user-profile-icon"></i> {{ $email }}
                        </li>
                        
                      </ul>

                      {{--  <!--a class="btn btn-warning" href="{{ route('siswa.edit',$siswa->id) }}"><i class="fa fa-edit m-right-xs"></i>Edit Profile</!--a--> --}}
                      <br />
                      <a href="{{ url('pdfrapor',$siswa->id) }}" class="btn btn-dark"><i class="fa fa-print"></i>&nbsp;Unduh Rapor</a>

                    </div>
                    <div class="col-md-9 col-sm-9 ">
                      <table class="data table table-striped no-margin">
                        <tbody>
                          @foreach ($ar_judul as $judul => $field)
                          <tr>  
                            <td>{{ $no++ }}</td>
                            <td>{{ $judul }}</td>
                            <td>{{ $field }}</td>
                            @endforeach
                          </tr>
                          
                        </tbody>
                      </table>

                    
                     
                    </div>
                  </div>
                </div>
              </div>
            </div>
      
@endforeach
@endsection