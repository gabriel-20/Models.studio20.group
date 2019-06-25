@extends('new.layout')

@section('headerInclude')

    @include('new.head')

@endsection

@section('content')
    <!--**********************************
        Content body start
    ***********************************-->
<style>
     .ribbon-style-6 {
        width:30%!important;
    }
    .ribbon.ribbon-style-6 p{
        font-size: 1.1rem;
        margin-bottom: 0.5rem;
    }
     .ribbon.ribbon-style-6{
         height: 3.0rem!important;
     }

</style>
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
                                <h2 class="display-3  text-primary" id="totalModels">{{--{{$totalModels}}--}}</h2>
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
                                <h2 class="display-3  text-info" id="totalFree">{{--{{$totalFree}}--}}</h2>
                                <p class="h2">Online in Free</p>
                            </div>
                        </div>
                        <div class="card-footer py-4 px-xl-5">
                            <h6 class="text-muted">Studio 20<span class="pull-right">{{--{{ $p_free }}--}}</span></h6>
                            <div class="progress mb-3">
                                <div id="progresFree" class="progress-bar bg-info " style="width: 0; height:6px;" role="progressbar"><span class="sr-only">{{--{{ $p_free }}--}} Complete</span>
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
                                <h2 class="display-3  text-warning" id="totalPrivate">{{--{{$totalPrivate}}--}}</h2>
                                <p class="h2">Earning $$$</p>
                            </div>
                        </div>
                        <div class="card-footer py-4 px-xl-5">
                            <h6 class="text-muted">Studio 20<span class="pull-right">{{--{{ $p_private }}--}}</span></h6>
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
                                <h2 class="display-3  text-danger" id="totalOnline">{{--{{$totalEverRecorded}}--}}</h2>
                                <p class="h2">Total Online Models</p>
                            </div>
                        </div>
                        <div class="card-footer py-4 px-xl-5">
                            <h6 class="text-muted">Studio 20<span class="pull-right">{{--{{ $p_online }}--}}</span></h6>
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

                            <div class="col-sm-4 col-md-4 col-xl" style="">
                                <div class="form-check mr-4 mb-4">
                                    <input id="checkbox19" class="form-check-input filled-in styled-checkbox" onclick="toggle('.offline', this)" type="checkbox">
                                    <label for="checkbox19" class="form-check-label check-red">Offline</label>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </div>

            {{--filter-end--}}

            <div class="row" id="mainrow">




            </div>
        </div>
    </div>

    <div class="modal hide" id="addBookDialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <h4 class="text-primary" id="modelName"></h4>
                    <div id="spinner"><img  style="width:50px" src="{{ asset('images/spinner2.gif') }}"/>Getting data..</div>
                    <div id="main" style="padding-bottom: 15px;"></div>
                    <div class="">

                        <table class="table table-hover" id="myTable1">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Hours</th>
                                <th>Revenue</th>
                            </tr>
                            </thead>
                            <tbody id="myTable">

                            </tbody>

                        </table>
                        <h4 class="text-primary" id="modelName2"></h4>
                        <div id="spinner2"><img  style="width:50px" src="{{ asset('images/spinner2.gif') }}"/>Getting data..</div>
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Hours</th>
                                <th>Revenue</th>
                            </tr>
                            </thead>
                            <tbody id="myTable2">

                            </tbody>

                        </table>

                    </div>
                </div>


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

        //if ($('#addBookDialog').hasClass('in');

        let allmodels = @json($resultModels);
        let array = JSON.parse(allmodels);

        let allmodellszise = '{{ $sizeallmodelsapprovedother }}';
        //console.log(array);

        $('#totalModels').text(allmodellszise);
        $('#progresTotal').css('width','100%');

        newdata(array);

        setInterval(function() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: "/testapi",
                method: 'post',
                success: function (html) {
                    //console.log(html);
                    console.log('fof');

                    //let array = JSON.parse(html.resultModels);
                    let array = html;

                    $('#totalModels').text(html.length);
                    $('#progresTotal').css('width','100%');
                    //console.log(array);

                    $("#mainrow").empty();
                    newdata(array);

                }
            });

        }, 30000);

    } );

    function newdata(array){
        let chprivat = $("#checkbox21").is(':checked');
        let chfree = $("#checkbox25").is(':checked');
        let choffline = $("#checkbox19").is(':checked');

        let freechat = 0;
        let privatechat = 0;



        array.forEach(function(element) {
            //console.log(element.modelname);
            let status = (element.status);

            if((status === 'private_chat') || (status === 'free_chat') || (status === 'offline')){

                let avgTotal = element.avgTotal;
                let avgDays = element.avgDays;
                let avg = Math.round(avgTotal / avgDays);
                avg = avg || 0;


                //console.log(avgTotal);
                //console.log(avgDays);

                let modLang = element.data_language;
                let modWill = element.data_willingnesses;
                let modCateg = element.data_category;
                let modstream = element.data_streamQuality;
                let modSex = element.data_sex;
                let modAge = element.data_age;
                let modBan = element.data_bannedCountries;
                let modelHits = element.hits;
                modelHits = modelHits || 0;
                let StudioName = element.StudioName;

                let modelTweets = element.tweets;
                if (!modelTweets) modelTweets = 0;
                let rating = element.data_modelRating;
                if (!rating) rating = 0;
                let charge = element.data_chargeAmount;
                if (!charge) charge = 0;

                let modelName = (element.modelname);
                if ( (modelName == '') || (modelName == null) ) modelName = (element.sync_Modelname);
                let src = (element.data_profilePictureUrl);

                let statusBtnClass = 'btn-danger';
                let statusText = 'Offline';

                if(status === 'free_chat') {
                    statusBtnClass = 'btn-success';
                    statusText = 'Free Chat';
                    freechat++;
                }
                if(status === 'private_chat') {
                    statusBtnClass = 'btn-primary';
                    statusText = 'Private Chat';
                    privatechat++;
                }



                let maincard = $('<div />', {"class": 'col-sm-6 col-xl-3 '+status});
                let card = $('<div />', {"class": 'card',text: ""});
                let cardbody = $('<div />', {"class": 'card-body',text: ""});
                let textcenter = $('<div />', {"class": 'text-center',text: ""});
                let div = $('<div />', {"id":modelName,"style": 'display: none',text: "64"});
                let newimg = $('<img />', {"id":'new'+modelName, "style": 'height:30px; position: absolute'});

                let img_old = $('<img />', {"id":'avatar'+modelName,"style": 'height: 100px!important;margin-top:10px!important',
                    "src": src,
                    "class": "rounded-circle",
                    "data-toggle":"tooltip",
                    "data-html":"true",
                    "title":"<div id='object_container'"+modelName+" style='width:300px;height:200px'>" +
                    "<script src='//awempt.com/embed/lf?c=object_container&site=jasmin&cobrandId=&psid=14noiembrie&pstool=202_1&psprogram=revs&campaign_id=&category=&forcedPerformers[]="+modelName+"&preferredPerformers[]="+modelName+"&vp[showChat]=false&vp[chatAutoHide]=false&vp[showCallToAction]=false&vp[showPerformerName]=true&vp[showPerformerStatus]=true&filters=&subAffId={SUBAFFID}'></"+""+"script>" +
                    "</div>"});

                let img = $('<img />', {"id":'avatar'+modelName,"style": 'height: 100px!important;margin-top:10px!important',
                    "src": src,"class": "rounded-circle"});

                let aimg = $('<a />', {"class": 'btn btn-sm open-AddBookDialog',
                    "href":'#addBookDialog',
                    "data-toggle":"modal",
                    "data-id":modelName,
                    "data-lang":modLang,
                    "data-will":modWill,
                    "data-categ":modCateg,
                    "data-stream":modstream,
                    "data-sex":modSex,
                    "data-age":modAge,
                    "data-ban":modBan
                });

                let h4 = $('<h4 />', {"class": 'mt-4 modelImage',text: modelName});

                /*let a = $('<a />', {"class": 'btn btn-sm '+statusBtnClass,
                 "href":'#'+modelName ,
                 text: statusText                }).click(function(){
                 window.open('https://www.livejasmin.com/en/member/chat-html5/'+modelName, '_blank');
                 });*/

                let a = $('<a />', {"class": 'btn btn-sm '+statusBtnClass,
                    "href":'#'+modelName ,
                    text: statusText
                });

                let ribon = $('<div />', {"class": 'ribbon ribbon-style-6'});
                let ribon2 = $('<div />', {"class": 'ribbon ribbon-style-6',"style":"margin-top: 155px!important;background-color:#00a2ff!important"});
                let ribon3 = $('<div />', {"class": 'ribbon ribbon-style-6',"style":"margin-top: 190px!important;background-color:#00a2ff!important"});
                let ribon4 = $('<div />', {"class": 'ribbon ribbon-style-6',"style":"margin-top: 225px!important;background-color:#00a2ff!important"});
                let textribon = $('<p />', {text: rating+" "});
                let textribon2 = $('<p />', {text: modelTweets + " RT"});
                let textribon3 = $('<p />', {"id":'visits'+modelName, text: modelHits+" VISITS"});
                let textribon4 = $('<p />', {text: avg + " $ avg (" + avgDays + ")"});
                let icon = $('<i />', {"class": "fa fa-star","style":'color: #ffc107!important'});
                let icon2 = $('<i />', {"class": "fa fa-share-alt","style":"padding-left: 5px;"});
                let icon3 = $('<i />', {"class": "fas fa-users","style":"padding-left: 5px;"});
                let h4ribon = $('<h4 />', {"class": 'text-danger  mt-4',text: '$'});
                let h5studio = $('<h5 />', {"class": 'text',text: StudioName});
                let span = $('<span />', {"class": 'text-danger  mt-4',text: charge});

                aimg.append(img);
                h4ribon.append(span);
                textcenter.append(newimg);
                textcenter.append(aimg);
                textcenter.append(h4);
                textcenter.append(h5studio);
                textcenter.append(h4ribon);
                textcenter.append(div);
                textcenter.append(a);
                //textcenter.append(btnn);
                textribon.append(icon);
                textribon2.append(icon2);
                textribon3.append(icon3);
                ribon.append(textribon);
                ribon2.append(textribon2);
                ribon3.append(textribon3);
                ribon4.append(textribon4);
                cardbody.append(ribon);
                cardbody.append(ribon2);
                cardbody.append(ribon3);
                cardbody.append(ribon4);
                cardbody.append(textcenter);
                card.append(cardbody);
                maincard.append(card);

                $("#mainrow").append(maincard);

            }
        });

        let totalonline = privatechat + freechat;
        $('#totalPrivate').text(privatechat);
        $('#totalFree').text(freechat);
        $('#totalOnline').text(totalonline);

        let total = '{{ $sizeallmodelsapprovedother }}';

        let ptotalonline = Math.round(totalonline*100/total)+'%';
        let ptotalfree = Math.round(freechat*100/totalonline)+'%';
        let ptotalprivate = Math.round(privatechat*100/totalonline)+'%';

        $("#progresFree").css('width',ptotalfree);
        $("#progresPrivate").css('width',ptotalprivate);
        $("#progresOnline").css('width',ptotalonline);

        if (!chprivat) $('.private_chat').css({display:'none'});
        if (!chfree) $('.free_chat').css({display:'none'});
        if (!choffline) $('.offline').css({display:'none'});

    }

    $(document).on("click", ".open-AddBookDialog", function () {
        $("#myTable").empty();
        $("#myTable2").empty();
        $( "#spinner" ).show();
        $( "#spinner2" ).show();
        let modelName = $(this).data('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "/api/last10days/"+modelName,
            method: 'post',
            success: function (html) {
                console.log(html);
                $( "#spinner" ).hide();
                let tbl = $('#myTable');

                for (let [key, value] of Object.entries(html)) {

                    let row = $('<tr></tr>').appendTo(tbl);
                    $('<td></td>').text(key).appendTo(row);
                    $('<td></td>').text(value[0]).appendTo(row);
                    $('<td></td>').text(value[1]).appendTo(row);

                }

                //tbl.appendTo($("#myTable"));
                getPeriod(modelName);
            }
        });


        let modelname = $(this).data('id') + ' - Last 10 days.';
        $(".modal-body #modelName").text( modelname );

        let modelname2 = $(this).data('id') + ' - Last 5 periods.';
        $(".modal-body #modelName2").text( modelname2 );
    });

    function getPeriod(model){


        $("#myTable2").empty();
        $( "#spinner2" ).show();
        //let modelName = $(this).data('id');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "/api/last5periods/"+model,
            method: 'post',
            success: function (html) {
                //console.log(html);
                $( "#spinner2" ).hide();
                let tbl = $('#myTable2');
                //console.log(html);

                    //console.log(element);
                    for (let [key, value] of Object.entries(html)) {

                        let row = $('<tr></tr>').appendTo(tbl);
                        $('<td></td>').text(key).appendTo(row);
                        $('<td></td>').text(value[0]).appendTo(row);
                        $('<td></td>').text(value[1]).appendTo(row);

                    }



            }
        });



    }

    function toggle(className, obj) {
        let $input = $(obj);
        if ($input.prop('checked')) $(className).show();
        else $(className).hide();
    }

</script>

@endpush



