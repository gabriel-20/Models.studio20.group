<!doctype html>
<html>
<head>
    <head>



        @yield('headerInclude')

    </head>

</head>

<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<!--**********************************
    Main wrapper start
***********************************-->
<div id="main-wrapper">


    @include('new.navheader')

    @include('new.header')

    @include('new.sidebar')


    @yield('content')

    @include('new.footer')

    @include('new.sidebarright')

</div>
<!--**********************************
    Main wrapper end
***********************************-->
<!--**********************************
    Scripts
***********************************-->
@stack('custom-scripts')

<script src="{{ URL::asset('/gleek/assets/plugins/common/common.min.js') }}"></script>
<script src="{{ URL::asset('/gleek/main/js/custom.min.js') }}"></script>
<script src="{{ URL::asset('/gleek/main/js/settings.js') }}"></script>
<script src="{{ URL::asset('/gleek/main/js/gleek.js') }}"></script>
<script src="{{ URL::asset('/gleek/main/js/styleSwitcher.js') }}"></script>

<!-- Chartjs chart -->
{{--<script src="{{ URL::asset('/gleek/assets/plugins/chart.js/Chart.bundle.min.js') }}"></script>--}}
<script src="{{ URL::asset('/gleek/assets/plugins/d3v3/index.js') }}"></script>
<script src="{{ URL::asset('/gleek/assets/plugins/topojson/topojson.min.js') }}"></script>
{{--<script src="{{ URL::asset('/gleek/assets/plugins/datamaps/datamaps.world.min.js') }}"></script>--}}

{{--<script src="{{ URL::asset('/gleek/main/js/plugins-init/datamap-world-init.js') }}"></script>--}}

{{--<script src="{{ URL::asset('/gleek/assets/plugins/datamaps/datamaps.usa.min.js') }}"></script>--}}

{{--<script src="{{ URL::asset('/gleek/main/js/dashboard/dashboard-1.js') }}"></script>--}}

{{--<script src="{{ URL::asset('/gleek/main/js/plugins-init/datamap-usa-init.js') }}"></script>--}}
</body>
</html>