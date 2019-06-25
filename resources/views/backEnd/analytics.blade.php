<!DOCTYPE html>
<html lang="{{ trans('backLang.code') }}" dir="{{ trans('backLang.direction') }}">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimal-ui"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- for ios 7 style, multi-resolution icon of 152x152 -->
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-barstyle" content="black-translucent">
    <link rel="apple-touch-icon" href="https://models.studio20girls.com/backEnd/assets/images/logo.png">
    <meta name="apple-mobile-web-app-title" content="Flatkit">
    <!-- for Chrome on Android, multi-resolution icon of 196x196 -->
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="shortcut icon" sizes="196x196" href="https://models.studio20girls.com/backEnd/assets/images/logo.png">

    <!-- style -->
    <link rel="stylesheet" href="https://models.studio20girls.com/backEnd/assets/animate.css/animate.min.css" type="text/css"/>
    <link rel="stylesheet" href="https://models.studio20girls.com/backEnd/assets/glyphicons/glyphicons.css" type="text/css"/>
    <link rel="stylesheet" href="https://models.studio20girls.com/backEnd/assets/font-awesome/css/font-awesome.min.css"
          type="text/css"/>
    <link rel="stylesheet" href="https://models.studio20girls.com/backEnd/assets/material-design-icons/material-design-icons.css"
          type="text/css"/>

    <link rel="stylesheet" href="https://models.studio20girls.com/backEnd/assets/bootstrap/dist/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="https://models.studio20girls.com/backEnd/assets/styles/app.min.css">
    <link rel="stylesheet" href="https://models.studio20girls.com/backEnd/assets/styles/font.css" type="text/css"/>

    @if( trans('backLang.direction')=="rtl")
        <link rel="stylesheet" href="https://models.studio20girls.com/backEnd/assets/styles/rtl.css">
    @endif

    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">


    <link href="https://models.studio20girls.com/backEnd/libs/jquery/bootstrap-daterangepicker/daterangepicker-bs3.css" rel="stylesheet"
          type="text/css"/>

</head>
<body>

<div class="app" id="app">

    <!-- ############ LAYOUT START-->

    <!-- aside -->
{{--@include('backEnd.includes.menu')--}}
<!-- / aside -->
    <!-- content -->
    <div id="content" class="app-content box-shadow-z0" role="main">


        {{--@include('backEnd.includes.header')--}}
        {{--@include('backEnd.includes.footer')--}}
        <div ui-view class="app-body" id="view">
            @include('backEnd.menus.navmenu');
            <!-- ############ PAGE START-->
            {{--@include('backEnd.includes.errors')--}}
            <div class="padding">
                <div class="row m-b">
                    <div class="col-sm-6 m-b-sm">
                        <h3> {{ trans('backLang.visitorsAnalytics') }} [ {{ trans('backLang.'.$statText) }} ]</h3>
                    </div>
                    <div class="col-sm-6 text-sm-right">
                        <div class="btn-group m-l-xs m-t-1">
                            {{ Form::open(array('url' => 'https://models.studio20girls.com/analytics/'.$stat, 'method'=>'POST', 'id' => "form_ofchangedate")) }}
                            <div id="dashboard-report-range" class="btn btn-sm primary"
                                 data-placement="top" data-original-title="Change dashboard date range">
                                <i class="fa fa-calendar"></i>
                                <span>
								</span>
                                <i class="fa fa-angle-down"></i>
                            </div>
                            <input type="hidden" id="this_daterangepicker_start"
                                   name="this_daterangepicker_start"
                                   value="<?php echo date("d-m-Y", strtotime($daterangepicker_start)); ?>"/>
                            <input type="hidden" id="this_daterangepicker_end" name="this_daterangepicker_end"
                                   value="<?php echo date("d-m-Y", strtotime($daterangepicker_end)); ?>"/>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
                <div class="row m-b">
                    <div class="col-sm-2 col-md-2 col-lg-2">
                        <div class="box-color p-a-3 primary">
                            <div class="pull-right m-l">
            <span class="w-56 dker text-center rounded">
              <i class="text-lg material-icons">&#xe7fb;</i>
            </span>
                            </div>
                            <div class="clear">
                                <h3 class="m-a-0 text-lg"><a href>{{ $TotalVisitors }}</a></h3>
                                <small class="text-muted">{{ trans('backLang.visitors') }}</small>
                            </div>
                        </div>
                        <div class="box-color p-a-3 warn">
                            <div class="pull-right m-l">
            <span class="w-56 dker text-center rounded">
              <i class="text-lg material-icons">&#xe54b;</i>
            </span>
                            </div>
                            <div class="clear">
                                <h3 class="m-a-0 text-lg"><a href>{{ $TotalPages }}</a></h3>
                                <small class="text-muted">{{ trans('backLang.pageViews') }}</small>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-10 col-md-10">
                        <div class="box">
                            <div class="box-header">
                                <h3>{{ trans('backLang.diagram') }}</h3>
                                <small>{{ trans('backLang.barDiagram') }}</small>
                            </div>
                            <div class="box-body">
                                <div ui-jp="plot" ui-refresh="app.setting.color" ui-options="
              [
                {
                  data: [
                  <?php
                                $ii = 1;
                                ?>
                                @foreach($AnalyticsVisitors as $id)

                                @if($ii<=30)
                                    @if($ii!=1) , @endif
                                <?php $i2 = 0; ?>
                                @foreach($id as $key => $val)
                                <?php
                                if ($i2 == 1) { ?> [{{ $ii }}, {{$val}}] <?php } $i2++; ?>
                                @endforeach
                                @endif
                                <?php $ii++;?>
                                @endforeach
                                        ],
                                                                        bars: { show: true, barWidth: 0.50, lineWidth: 1, fillColor: { colors: [{ opacity: 0.8 }, { opacity: 1}] }, order:1 }
                                                                      }
                                    ],
                                    {
                                      colors: ['#0cc2aa','#fcc100'],
                                      series: { shadowSize: 3 },
                                      xaxis: { show: true, font: { color: '#ccc' }, position: 'bottom' },
                                      yaxis:{ show: true, font: { color: '#ccc' }},
                                      grid: { hoverable: true, clickable: true, borderWidth: 0, color: 'rgba(120,120,120,0.5)' },
                                      tooltip: true,
                                      tooltipOpts: { content: '%x.0 is %y.0',  defaultTheme: false, shifts: { x: 0, y: -40 } }
                                    }
" style="height:207px">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row">
                    <div class="box m-b-0">
                        <div class="table-responsive">
                            <table class="table table-striped  b-t">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">{{ trans('backLang.'.$statText) }}</th>
                                    <th class="text-center">{{ trans('backLang.visitors') }}</th>
                                    {{--<th class="text-center">{{ trans('backLang.pageViews') }}</th>--}}
                                </tr>
                                </thead>
                                <tbody>

                                @foreach ($AnalyticsVisitors as $k => $item)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td class="text-center">{{ $item->$stat}}</td>
                                        <td class="text-center">{{ $item->total }}</td>
                                    </tr>

                                @endforeach

                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
            <!-- ############ PAGE END-->

        </div>
    </div>
    <!-- / -->

    <!-- theme switcher -->
{{--@include('backEnd.includes.settings')--}}
<!-- / -->

    <!-- ############ LAYOUT END-->

</div>


<script type="text/javascript">
    var public_lang = "{{ trans('backLang.calendarLanguage') }}"; // this is a public var used in app.html.js to define path to js files
    var public_folder_path = "https://models.studio20girls.com"; // this is a public var used in app.html.js to define path to js files
</script>

<script src="https://models.studio20girls.com/backEnd/scripts/app.html.js"></script>


<script src="https://models.studio20girls.com/backEnd/libs/jquery/bootstrap-daterangepicker/moment.min.js"
        type="text/javascript"></script>
<script src="https://models.studio20girls.com/backEnd/libs/jquery/bootstrap-daterangepicker/daterangepicker.js"
        type="text/javascript"></script>
<script type="text/javascript">
    var Index = function () {
        return {
            initDashboardDaterange: function () {

                $('#dashboard-report-range').daterangepicker({
                        opens: ('{{ trans('backLang.left') }}'),
                        startDate: '<?php echo date("d-m-Y", strtotime($daterangepicker_start)); ?>',
                        endDate: '<?php echo date("d-m-Y", strtotime($daterangepicker_end)); ?>',
                        minDate: '<?php echo $min_visitor_date; ?>',
                        maxDate: '<?php echo $max_visitor_date; ?>',
                        showDropdowns: false,
                        showWeekNumbers: false,
                        timePicker: false,
                        timePickerIncrement: 1,
                        timePicker12Hour: true,
                        ranges: {
                            '{{ trans('backLang.today') }}': [moment(), moment()],
                            '{{ trans('backLang.yesterday') }}': [moment().subtract('days', 1), moment().subtract('days', 1)],
                            '{{ trans('backLang.last7Days') }}': [moment().subtract('days', 6), moment()],
                            '{{ trans('backLang.last30Days') }}': [moment().subtract('days', 29), moment()],
                            '{{ trans('backLang.thisMonth') }}': [moment().startOf('month'), moment().endOf('month')],
                            '{{ trans('backLang.lastMonth') }}': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                        },
                        buttonClasses: ['btn'],
                        applyClass: 'primary',
                        cancelClass: 'default',
                        format: 'DD-MM-YYYY',
                        separator: ' {{ trans('backLang.applyTo') }} ',
                        locale: {
                            applyLabel: '{{ trans('backLang.apply') }}',
                            fromLabel: '{{ trans('backLang.applyFrom') }}',
                            toLabel: '{{ trans('backLang.applyTo') }}',
                            customRangeLabel: '{{ trans('backLang.customRange') }}',
                            daysOfWeek: [{!! trans('backLang.weekDays') !!}],
                            monthNames: [{!! trans('backLang.monthsNames') !!}],
                            firstDay: 1
                        }
                    },
                    function (start, end) {
                        $('#dashboard-report-range span').html(start.format('MMMM D , YYYY') + ' - ' + end.format('MMMM D , YYYY'));
                        $("#this_daterangepicker_start").val(start.format('YYYY-MM-DD'));
                        $("#this_daterangepicker_end").val(end.format('YYYY-MM-DD'));
                        $("#form_ofchangedate").submit();
                    }
                );

                console.log("<?php echo $daterangepicker_start_text; ?>");
                console.log("<?php echo $daterangepicker_end_text; ?>");

                $('#dashboard-report-range span').html("<?php echo $daterangepicker_start_text; ?>" + ' - ' + "<?php echo $daterangepicker_end_text; ?>");
                $("#this_daterangepicker_start").val("<?php echo $daterangepicker_start; ?>");
                $("#this_daterangepicker_end").val("<?php echo $daterangepicker_end; ?>");
                $('#dashboard-report-range').show();
            }
        };

    }();
    jQuery(document).ready(function () {
        Index.initDashboardDaterange();
    });
</script>

</body>
</html>
