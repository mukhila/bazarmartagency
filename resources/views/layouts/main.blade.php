@include('layouts.header')
@include('layouts.topbar')
@stack('styles')

@yield('content')
@include('layouts.footer')
@stack('scripts')
</body>
</html>
