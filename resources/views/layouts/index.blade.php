@include('layouts.kodeatas')
@include('layouts.sidebar')
@include('layouts.topbar')

<div class="right_col" role="main">
@yield('content')
</div> <!-- End of Main Content -->

@include('layouts.footer')
@include('layouts.kodebawah')