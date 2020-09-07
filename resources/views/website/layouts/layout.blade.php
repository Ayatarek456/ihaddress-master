<!DOCTYPE html>
<html>
@include('website.partials.header')

<body class="">

<div class="container-fluid px-0 mapContainer">

    <div class="container-fluid px-0 mapContainer" id="app">

        @yield('content')

    </div>

    <!--/footer-->
    @include('website.partials.footer')

</div>
<!-- page -->



<div id="toTop"></div><!-- Back to top button -->


@include('website.partials.scripts')

@yield('popup')

</body>
</html>
