@include('layouts.header')
@include('layouts.topbar')
@stack('styles')

@yield('content')
@include('policy')
@include('layouts.footer')
@stack('scripts')
</body>
</html>
