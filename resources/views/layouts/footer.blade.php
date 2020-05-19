        <!-- footer content -->
        @php
             $ar_sekolah = App\Sekolah::all();
        @endphp
        <footer>
            <div class="pull-right">
              @foreach ($ar_sekolah as $sekolah)
              {{ $sekolah->nama_sekolah }} - {{ $sekolah->alamat }}, {{ $sekolah->kota }} @endforeach
            </div>
            <div class="clearfix"></div>
          </footer>
          <!-- /footer content -->
        </div>
      </div>