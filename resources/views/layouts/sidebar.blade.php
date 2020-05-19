<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">
                <div class="navbar nav_title" style="border: 0;">
                    <a href="{{ url('/') }}" class="site_title"><i class="fa fa-book"></i> <span>E-Rapor</span></a>
                </div>

                <div class="clearfix"></div>

                <!-- menu profile quick info -->
                <div class="profile clearfix">
                    <div class="profile_info">
                        <h2>Welcome, {{ Auth::user()->name }}</h2>
                        @php
                            $tgl= date('d F Y');
                        @endphp
                        <span>{{ $tgl }}</span>
                    </div>
                </div>
                <!-- /menu profile quick info -->

                <br />

<!-- sidebar menu -->
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>Aplikasi Penilaian Siswa</h3>
        <ul class="nav side-menu">
            @if (Auth::user()->role == 'admin')
            <li><a><i class="fa fa-cog"></i>Setting Aplikasi<span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('/sekolah') }}">Setting Sekolah</a></li>
                    <li><a href="{{ url('/semester') }}">Setting Semester</a></li>
                </ul>
            </li>
            
            <li><a><i class="fa fa-database"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('/kelas') }}">Kelas</a></li>
                    <li><a href="{{ url('/jurusan') }}">Jurusan</a></li>
                    <li><a href="{{ url('/walikelas') }}">Wali Kelas</a></li>
                </ul>
            </li>
           
            <li><a href="{{ url('/siswa') }}"><i class="fa fa-graduation-cap" ></i> Data Siswa</a></li>
            <li><a href="{{ url('/guru') }}"><i class="fa fa-user" ></i> Data Guru</a></li>
            @endif
            @if (Auth::user()->role != 'siswa')
            <li><a><i class="fa fa-clipboard"></i> Kompetensi <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('/matpel') }}">Mata Pelajaran</a></li>
                    <li><a href="{{ url('/predikat') }}">Sikap/Afektif</a></li>
                </ul>
            </li>
            <li><a><i class="fa fa-book"></i> Rapor Siswa <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ url('/nilai') }}">Nilai Siswa</a></li>
                </ul>
            </li>
            @endif
        </ul>
    </div>
</div>
<!-- /sidebar menu -->


<!-- /menu footer buttons -->
</div>
</div>