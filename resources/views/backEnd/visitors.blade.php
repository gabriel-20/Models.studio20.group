<!DOCTYPE html>
<html lang="{{ trans('backLang.code') }}" dir="{{ trans('backLang.direction') }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="{{ URL::to('backEnd/assets/images/logo.png') }}">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="{{ URL::to('backEnd/assets/images/logo.png') }}">

    <!-- style -->
    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/animate.css/animate.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/glyphicons/glyphicons.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/font-awesome/css/font-awesome.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/material-design-icons/material-design-icons.css') }}"
          type="text/css"/>

    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/styles/app.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/styles/font.css') }}" type="text/css"/>

    @if( trans('backLang.direction')=="rtl")
        <link rel="stylesheet" href="{{ URL::to('backEnd/assets/styles/rtl.css') }}">
    @endif

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">


    <link href="{{ URL::to("backEnd/libs/jquery/bootstrap-daterangepicker/daterangepicker-bs3.css") }}" rel="stylesheet"
          type="text/css"/>
    <link rel="stylesheet" type="text/css" href="{{ URL::to("backEnd/assets/styles/flags.css") }}"/>


</head>
<body>

<div class="app" id="app">

    <div id="content" class="app-content box-shadow-z0" role="main">

        <div ui-view class="app-body" id="view">

            @include('backEnd.menus.navmenu');

    <div class="padding">
        <div class="box">
            <div class="box-header dker">
                <h3>{{ trans('backLang.visitorsAnalyticsVisitorsHistory') }}</h3>
                {{--<small>
                    <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                    <a href="">{{ trans('backLang.visitorsAnalytics') }}</a>
                </small>--}}
            </div>


            <div class="table-responsive">
                <table class="table table-striped  b-t">
                    <thead>
                    <tr>
                        <th class="text-center">{{ trans('backLang.topicDate') }}</th>
                        <th class="text-center">{{ trans('backLang.ip') }}</th>
                        <th>{{ trans('backLang.visitorsAnalyticsByCity') }}</th>
                        <th>{{ trans('backLang.visitorsAnalyticsByCountry') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $ii = 1;
                    ?>
                    @foreach($AnalyticsVisitors as $Analytic)
                        <tr>
                            <td class="text-center" >
                                <small>{{$Analytic->date}} &nbsp; {{date('h:i A', strtotime($Analytic->time)) }}</small>
                            </td>
                            <td class="text-center dker text-info"><a href="{{route("visitorsIP",$Analytic->ip)}}">{{$Analytic->ip}}</a></td>
                            <td>{{$Analytic->city}}</td>
                            <?php
                            $flag = "";
                            $country_code = strtolower($Analytic->country_code);
                            if ($country_code != "unknown") {
                                $flag = "<div class='flag flag-$country_code' style='display: inline-block'></div> ";
                            }
                                    ?>
                            <td>{!! $flag !!} &nbsp;{{$Analytic->country}}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
                <br>
                <div class="text-center">
                    {!! $AnalyticsVisitors->links() !!}
                </div>
                <br>
            </div>
        </div>
    </div>

        </div>
    </div>
</div>
</body>
</html>
