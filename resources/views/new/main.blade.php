@extends('new.layout')

@section('content')
    <!--**********************************
        Content body start
    ***********************************-->

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col p-md-0">
                    <h4>Dashboard</h4>
                </div>
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="">Dashboard</a>
                        </li>
                    </ol>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 col-xl-3 no-card-border">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pull-left">All Models</h5>


                            <div class="clearfix"></div>
                            <div class="mt-4 text-center">
                                <h2 class="display-3  text-primary" id="totalModels">{{$totalModels}}</h2>
                                <p class="h2">Registered Models</p>
                            </div>
                        </div>
                        <div class="card-footer py-4 px-xl-5">
                            <h6 class="text-muted">Studio 20<span class="pull-right">100%</span></h6>
                            <div class="progress mb-3">
                                <div id="progresTotal" class="progress-bar bg-primary " style="width: 0; height:6px;" role="progressbar"><span class="sr-only">100% Complete</span>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 no-card-border">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pull-left">FreeChat Now</h5>

                            <div class="clearfix"></div>
                            <div class="mt-4 text-center">
                                <h2 class="display-3  text-info" id="totalFree">{{$totalFree}}</h2>
                                <p class="h2">Online in Free</p>
                            </div>
                        </div>
                        <div class="card-footer py-4 px-xl-5">
                            <h6 class="text-muted">Studio 20<span class="pull-right">{{ $p_free }}</span></h6>
                            <div class="progress mb-3">
                                <div id="progresFree" class="progress-bar bg-info " style="width: 0; height:6px;" role="progressbar"><span class="sr-only">{{ $p_free }} Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 no-card-border">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pull-left">PrivateChat Now</h5>

                            <div class="clearfix"></div>
                            <div class="mt-4 text-center">
                                <h2 class="display-3  text-warning" id="totalPrivate">{{$totalPrivate}}</h2>
                                <p class="h2">Earning $$$</p>
                            </div>
                        </div>
                        <div class="card-footer py-4 px-xl-5">
                            <h6 class="text-muted">Studio 20<span class="pull-right">{{ $p_private }}</span></h6>
                            <div class="progress mb-3">
                                <div id="progresPrivate" class="progress-bar bg-warning" style="width: 0; height:6px;" role="progressbar"><span class="sr-only">60% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-xl-3 no-card-border">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="pull-left">Online Now</h5>

                            <div class="clearfix"></div>
                            <div class="mt-4 text-center">
                                <h2 class="display-3  text-danger" id="totalOnline">{{$totalEverRecorded}}</h2>
                                <p class="h2">Total Online Models</p>
                            </div>
                        </div>
                        <div class="card-footer py-4 px-xl-5">
                            <h6 class="text-muted">Studio 20<span class="pull-right">{{ $p_online }}</span></h6>
                            <div class="progress mb-3">
                                <div id="progresOnline" class="progress-bar bg-danger" style="width: 0; height:6px;" role="progressbar"><span class="sr-only">60% Complete</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{--filter--}}

            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">

                        <div class="row mb-4">

                            <div class="col-sm-4 col-md-4 col-xl" style="">
                                <div class="form-check mr-4 mb-4">
                                    <input id="checkbox21" class="form-check-input filled-in styled-checkbox" onclick="toggle('.private_chat', this)" checked="" type="checkbox">
                                    <label for="checkbox21" class="form-check-label check-d-purple">Private Chat</label>
                                </div>
                            </div>

                            <div class="col-sm-4 col-md-4 col-xl" style="">
                                <div class="form-check mr-4 mb-4">
                                    <input id="checkbox25" class="form-check-input filled-in styled-checkbox" onclick="toggle('.free_chat', this)" checked="" type="checkbox">
                                    <label for="checkbox25" class="form-check-label check-green">Free Chat</label>
                                </div>
                            </div>

                            {{--<div class="col-sm-4 col-md-4 col-xl" style="">
                                <div class="form-check mr-4 mb-4">
                                    <input id="checkbox19" class="form-check-input filled-in styled-checkbox" onclick="toggle('.offline', this)" type="checkbox">
                                    <label for="checkbox19" class="form-check-label check-red">Offline</label>
                                </div>
                            </div>--}}

                        </div>

                    </div>

                </div>
            </div>

            {{--filter-end--}}

            <div class="row" id="mainrow">




            </div>
        </div>
    </div>
    <!--**********************************
        Content body end
    ***********************************-->
@stop

@push('custom-scripts')

<script>

    $(document).ready(function() {

        elem1 = document.getElementById("progresTotal");
        elem1.style.width = '100%';

        elem2 = document.getElementById("progresFree");
        elem2.style.width = '{{ $p_free }}';

        elem3 = document.getElementById("progresPrivate");
        elem3.style.width = '{{ $p_private }}';

        elem4 = document.getElementById("progresOnline");
        elem4.style.width = '{{ $p_online }}';

        var ss = @json($jslastModelStatus);
        var array = JSON.parse(ss);
        generateModels(array);

        /*setInterval(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "/ajaxcron",
                method: 'post',
                success: function (html) {

                    //console.log(html);
                    $('#totalModels').val(html.totalModels);

                    $('#progresFree').css('width',html.p_free);
                    $('#totalFree').text(html.totalFree);

                    $('#progresPrivate').css('width',html.p_private);
                    $('#totalPrivate').text(html.totalPrivate);

                    $('#progresOnline').css('width',html.p_online);
                    $('#totalOnline').text(html.totalEverRecorded);

                    $("#mainrow").empty();

                    var array = JSON.parse(html.jslastModelStatus);

                    generateModels(array);

                }
            });

        }, 300000);*/

    } );

    function generateModels(array){

        var chprivat = $("#checkbox21").is(':checked');
        var chfree = $("#checkbox25").is(':checked');
       // var choffline = $("#checkbox19").is(':checked');

        array.forEach(function(elem) {
            var name = elem.name;

            //if  ( (name === 'private_chat')   ||  (name === 'free_chat')   ||  (name === 'offline')  ) {
            if  ( (name === 'private_chat')   ||  (name === 'free_chat')    ) {

                var last_change = elem.last_change;
                var diff = elem.diff;
                var Modelname = elem.Modelname;
                var id = elem.id;
                var full_name = elem.full_name;
                var path = elem.path;
                var first_login = elem.first_login;

                var newImg = '';
                var avatar = '/images/logo100.png';
                var modelnamehtml = '<h4 class="mt-4 modelImage">'+Modelname+'</h4>';
                var lastchangehtml = '<p>Updated: <strong>'+last_change+'</strong></p>';
                var relocatebtn = '';
                if (name === 'private_chat')  relocatebtn = '<a href="javascript:relocate_home(\''+Modelname+'\')" class="btn btn-sm btn-primary">Private Chat</a>';
                if (name === 'free_chat')  relocatebtn = '<a href="javascript:relocate_home(\''+Modelname+'\')" class="btn btn-sm btn-success">Free Chat</a>';
                if (name === 'offline')  relocatebtn = '<a href="javascript:relocate_home(\''+Modelname+'\')" class="btn btn-sm btn-danger">Offline</a>';

                if (first_login === 1) {
                    newImg = '<img src="{{ URL::asset('/images/promotion-icon.png') }}" alt="" style="height:30px; position: absolute">';
                }

                if ((path === '') || (path === null)) {
                    avatar = '/images/logo100.png';
                } else {
                    avatar = path;
                }

                avatar = '<img id='+ id + ' src='+avatar+' class="rounded-circle" alt="" style="height: 100px!important;">';

                var elemhtml = '<div class="col-sm-6 col-xl-3 '+name+'"><div class="card"><div class="card-body"><div class="text-center"><div style="display: none;">'+diff+'</div>';
                elemhtml = elemhtml + newImg + avatar +modelnamehtml +lastchangehtml+relocatebtn+'</div></div></div></div>';

                var script = '<script>var id =  '+id+';var img = '+path+';if (img === null){ getData("'+Modelname+'", '+id+');}</' + 'script>';

                elemhtml = elemhtml + script;

                $("#mainrow").append(elemhtml);

            }

        });

        if (!chprivat) $('.private_chat').css({display:'none'});
        if (!chfree) $('.free_chat').css({display:'none'});
        //if (!choffline) $('.offline').css({display:'none'});

    }

    function toggle(className, obj) {
        var $input = $(obj);
        if ($input.prop('checked')) $(className).show();
        else $(className).hide();
    }

    function relocate_home(nickname)
    {
        window.open("https://www.livejasmin.com/en/member/chat-html5/" + nickname, '_blank');
    }

</script>

@endpush



