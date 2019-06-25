<!DOCTYPE html>
<html lang="{{ trans('backLang.code') }}" dir="{{ trans('backLang.direction') }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="{{ URL::to('backEnd/assets/images/logo.png') }}">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">

    <!-- style -->
    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/animate.css/animate.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/glyphicons/glyphicons.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/font-awesome/css/font-awesome.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/material-design-icons/material-design-icons.css') }}"
          type="text/css"/>

    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/bootstrap/dist/css/bootstrap.min.css') }}" type="text/css"/>
    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/styles/app.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('backEnd/assets/styles/font.css') }}" type="text/css"/>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js" defer></script>

    <link rel="stylesheet" type="text/css" href="{{ URL::to("backEnd/assets/styles/flags.css") }}"/>


</head>
<body>

<style>
    .total {
        font-size: 24px;
        font-weight: bold;
    }
    #pH1{
        font-size: 18px;
        font-weight: bold;
    }
    #pH2{
        font-size: 18px;
    }
    .colorRed{
        color: red;
    }
    .colorGreen{
        color: green;
    }
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 23px;
    }

    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 4px;
        bottom: 4px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
    }

    input:checked + .slider {
        background-color: #2196F3;
    }

    input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
    }

    input:checked + .slider:before {
        -webkit-transform: translateX(26px);
        -ms-transform: translateX(26px);
        transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
        border-radius: 34px;
    }

    .slider.round:before {
        border-radius: 50%;
    }
    #verifLabel{
        font-size: 22px;
        margin-top: 5%;
    }
</style>

<div class="app" id="app">

    <div id="content" class="app-content box-shadow-z0" role="main">

        <div ui-view class="app-body" id="view">

            @include('backEnd.menus.navmenu');

            <div class="padding">
                <div class="box">
                    <div class="box-header dker">
                        <h3>Visitors {{ $date }}</h3>
                        {{--<small>
                            <a href="{{ route('adminHome') }}">{{ trans('backLang.home') }}</a> /
                            <a href="">{{ trans('backLang.visitorsAnalytics') }}</a>
                        </small>--}}
                    </div>


                    <div>

                        <table id="visitors">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Count</th>
                                <th>Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($AnalyticsVisitors as $Analytic)
                                <tr>
                                    <td>{{ $loop->index + 1}} </td>
                                    <td>{{ $Analytic->total }} </td>
                                    <td>{{Carbon\Carbon::parse($Analytic->time)->format('d/m/Y') }} </td>
                                </tr>
                            @endforeach

                            </tbody>
                        </table>


                    </div>
                </div>
            </div>

        </div>
    </div>



</div>
</body>
</html>

<script>

    $(document).ready(function() {

        $(function(){
            $("#visitors").DataTable({
                order: [[ 4, "desc" ]],
                aLengthMenu: [
                    [25, 50, 100, 200, -1],
                    [25, 50, 100, 200, "All"]
                ],
                iDisplayLength: -1
            });
        })

        $('.btnVerif').change(function(e){

            let val = $(this).attr("value");
            //alert(val);

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "ajaxban",
                method: 'post',
                data: {ip: val},
                success: function (html) {

                    console.log(html);

                    /*if (html === '1'){
                     console.log('true');
                     $('#pH2').text('Period is Verified').removeClass('colorRed').addClass('colorGreen');
                     } else {
                     console.log('false');
                     $('#pH2').text('Period Not Verified').removeClass('colorGreen').addClass('colorRed');
                     }*/


                }
            });

        });

    });

</script>