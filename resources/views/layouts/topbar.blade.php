<!-- top navigation -->
<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
          <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
        <ul class=" navbar-right">
          <li class="nav-item dropdown open" style="padding-left: 15px;">    
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">
              @php
              $ar_siswa = \App\Siswa::all();
              $ar_guru = \App\Guru::all();
              $ar_member = \App\Member::all();    
            @endphp
              @if (Auth::user()->role == 'admin')
              @foreach ($ar_member as $member)
              @if ($member->id == Auth::user()->id)
              @php
                  $b = 'member';
                  $a = $member->foto;
              @endphp
              @endif
              @endforeach
              @elseif(Auth::user()->role == 'siswa')
              @foreach ($ar_siswa as $siswa)
              @if ($siswa->user_id == Auth::user()->id) 
              @php $a = $siswa->foto; $b = 'siswa'; @endphp 
              @endif   
              @endforeach
              @else
              @foreach ($ar_guru as $guru)
              @if ($guru->user_id == Auth::user()->id) 
              @php $a = $guru->foto; $b = 'guru'; @endphp 
              @endif
              @endforeach
              @endif
              <img src="{{ asset('images')}}/{{ $b }}/{{ $a }}"/>
              @if (empty(Auth::user()->name)) '' @else {{ Auth::user()->name }} @endif
            </a>
          
            
            <div class="dropdown-menu dropdown-usermenu pull-right" aria-labelledby="navbarDropdown">
              {{-- @foreach ($ar_siswa as $siswa) --}}
              {{--  @foreach ($ar_guru as $guru)  --}}
              @if (Auth::user()->role == 'admin')
              @php
                  $b = 'member';
                  $a = Auth::user()->id;
              @endphp
              @elseif(Auth::user()->role == 'siswa')
              @foreach ($ar_siswa as $siswa)
              @if ($siswa->user_id == Auth::user()->id) 
              @php $a = $siswa->id; $b = 'siswa'; @endphp 
              @endif
              @endforeach
              @else
              @foreach ($ar_guru as $guru)
              @if ($guru->user_id == Auth::user()->id) 
              @php $a = $guru->id; $b = 'guru'; @endphp 
              @endif
              @endforeach   
              @endif
              {{--  @endforeach --}}
              {{--  @endforeach --}}
              <a class="dropdown-item"  href="/{{ $b }}/{{ $a }}"> Profile</a>
              @if (Auth::user()->role == 'admin')
              <a class="dropdown-item"  href="{{ url('/member') }}">Kelola User</a>
              @endif
              <a class="dropdown-item" href="{{ route('logout') }}" data-toggle="modal"
              onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
              <i class="fa fa-sign-out"></i> {{ __('Logout') }}
              </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
          @csrf
        </form>
            </div>
          </li>
            </ul>
          </li>
        </ul>
      </nav>
    </div>
  </div>
  <!-- /top navigation -->