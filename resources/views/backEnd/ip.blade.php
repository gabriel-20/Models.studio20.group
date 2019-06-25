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

    <?php
    $visitor_loc_0 = "";
    $visitor_loc_1 = "";
    ?>
    <div class="padding p-b-0">
        <div class="box">
            @if($ip_code!="")
                <div class="box-header dker">
                    <div class="row">
                        <div class="col-lg-9">
                            <h3>{{ trans('backLang.visitorsAnalyticsIPInquiry') }}</h3>
                            {{--<small>
                                <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                                <a href="">{{ trans('backLang.visitorsAnalytics') }}</a>
                            </small>--}}
                        </div>
                        <div class="col-lg-3">
                            <div class="btn-group pull-right">
                                {{Form::open(['route'=>['visitorsSearch'],'method'=>'POST'])}}
                                <div class="input-group input-group-sm">
                                    {!! Form::text('ip',$ip_code, array('placeholder' => trans('backLang.ip')."...",'class' => 'form-control','id'=>'name','required'=>'')) !!}
                                    <span class="input-group-btn">
                <button class="btn btn-default b-a no-shadow" type="submit"><i class="fa fa-search"></i></button>
              </span>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="box-header dker">
                    <div class="row">
                        <div class="text-center">
                            <br>
                            <h3>{{ trans('backLang.visitorsAnalyticsIPInquiry') }}</h3>
                            {{--<small>
                                <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                                <a href="">{{ trans('backLang.visitorsAnalytics') }}</a>
                            </small>--}}
                            <div class="btn-group p-a w-lg">
                                {{Form::open(['route'=>['visitorsSearch'],'method'=>'POST'])}}
                                <div class="input-group input-group-sm">
                                    {!! Form::text('ip',$ip_code, array('placeholder' => trans('backLang.ip')."...",'class' => 'form-control','id'=>'name','required'=>'')) !!}
                                    <span class="input-group-btn">
                <button class="btn btn-default b-a no-shadow" type="submit"><i class="fa fa-search"></i></button>
              </span>
                                </div>
                                {{Form::close()}}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            @if($ip_code!="")
                <div class="box-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="table-responsive">
                                <table class="table  table-striped b-t">
                                    <tbody>
                                    <?php
                                    $lmt = 0;
                                    ?>
                                    @foreach($AnalyticsVisitors as $AnalyticsVisitor)
                                        @if($lmt==0)
                                            <?php
                                            $visitor_loc_0 = $AnalyticsVisitor->location_cor1;
                                            $visitor_loc_1 = $AnalyticsVisitor->location_cor2;

                                            $flag = "";
                                            $country_code = strtolower($AnalyticsVisitor->country_code);
                                            if ($country_code != "unknown") {
                                                $flag = "<div class='flag flag-$country_code' style='display: inline-block'></div> ";
                                            }

                                            ?>
                                            <tr>
                                                <td class="dker">{{ trans('backLang.visitorsAnalyticsByCountry') }}:
                                                </td>
                                                <td>{!! $flag !!} &nbsp;{{ $AnalyticsVisitor->country }}</td>
                                            </tr>

                                            <tr>
                                                <td class="dker">{{ trans('backLang.visitorsAnalyticsByCity') }} :</td>
                                                <td>{{ $AnalyticsVisitor->city }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ trans('backLang.visitorsAnalyticsByRegion') }}:
                                                </td>
                                                <td>{{ $AnalyticsVisitor->region }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ trans('backLang.visitorsAnalyticsByAddress') }}:
                                                </td>
                                                <td>{{ $AnalyticsVisitor->full_address }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ trans('backLang.visitorsAnalyticsByHostName') }}:
                                                </td>
                                                <td>{{ $AnalyticsVisitor->hostname }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ trans('backLang.visitorsAnalyticsByOrganization') }}
                                                    :
                                                </td>
                                                <td>{{ $AnalyticsVisitor->org }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ trans('backLang.visitorsAnalyticsLastVisit') }}:
                                                </td>
                                                <td>{{ $AnalyticsVisitor->date }}
                                                    &nbsp; {{date('h:i A', strtotime($AnalyticsVisitor->time)) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ trans('backLang.visitorsAnalyticsByOperatingSystem') }}
                                                    :
                                                </td>
                                                <td>{{ $AnalyticsVisitor->os }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ trans('backLang.visitorsAnalyticsByBrowser') }}:
                                                </td>
                                                <td>{{ $AnalyticsVisitor->browser }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ trans('backLang.visitorsAnalyticsByScreenResolution') }}
                                                    :
                                                </td>
                                                <td>{{ $AnalyticsVisitor->resolution }}</td>
                                            </tr>
                                            <tr>
                                                <td class="dker">{{ trans('backLang.visitorsAnalyticsByReachWay') }}:
                                                </td>
                                                <td>{{ $AnalyticsVisitor->referrer }}</td>
                                            </tr>
                                        @endif
                                        <?php
                                        $lmt++
                                        ?>
                                    @endforeach
                                    </tbody>
                                </table>
                                <br>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div id="ipmap" style="height: 495px;"></div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
    @if($ip_code!="")
        <div class="padding">
            <h5>{{ trans('backLang.activitiesHistory') }}</h5>
            <div class="box">
                <div class="table-responsive">
                    <table class="table table-striped  b-t">
                        <thead>
                        <tr>
                            <th class="text-center">{{ trans('backLang.topicDate') }}</th>
                            <th>{{ trans('backLang.activity') }}</th>
                            <th>source</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $ii = 1;
                        ?>
                        <?php

                        foreach($AnalyticsVisitors as $AnalyticsVisitor){
                        foreach($AnalyticsVisitor->vPages as $page){
                            //dd($page);
                        if ($ii > 100) {
                            break 2;
                        }
                        ?>
                        <tr>
                            <td class="text-center dker">
                                <small>{{$page->date}}
                                    &nbsp; {{date('h:i A', strtotime($page->time)) }}</small>
                            </td>
                            <td class="text-info"><a href="{{$page->query}}" target="_blank">{{$page->title}}</a></td>
                            <td>{{$page->query}}</td>
                        </tr>

                        <?php
                        $ii++;

                        }
                        }
                        ?>
                        </tbody>
                    </table>
                    <br>
                </div>
            </div>
        </div>
    @endif

        </div>
    </div>
</div>


    <?php
    if ($visitor_loc_0 != "unknown" && $visitor_loc_1 != "unknown") {
    ?>
    <script type="text/javascript"
            src="http://maps.google.com/maps/api/js?key=AIzaSyAgzruFTTvea0LEmw_jAqknqskKDuJK7dM&language={{App::getLocale()}}"></script>
    <script type="text/javascript">
        function initialize() {
            var latlng = new google.maps.LatLng(<?php echo $visitor_loc_0; ?>, <?php echo $visitor_loc_1; ?>);
            var myOptions = {
                zoom: 9,
                center: latlng,
                mapTypeId: google.maps.MapTypeId.ROADMAP
            };

            var map = new google.maps.Map(document.getElementById("ipmap"), myOptions);

            var marker = new google.maps.Marker({
                position: latlng,
                map: map,
                title: '<?php echo $ip_code; ?>'
            });
        }
        google.maps.event.addDomListener(window, 'load', initialize);
    </script>
    <?php
    }
    ?>

</body>
</html>