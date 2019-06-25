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

    {{--<div class="modal hide" id="addBookDialog">
        <div class="modal-header">
            <button class="close" data-dismiss="modal">×</button>
            <h3>Modal header</h3>
        </div>
        <div class="modal-body">
            <p>some content</p>
            <input type="text" name="bookId" id="bookId" value=""/>
        </div>
    </div>--}}

    <div class="modal hide" id="addBookDialog">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div id="main" style="padding-bottom: 15px;"></div>
                    <div class="">
                        <table style="margin:auto;padding-left:5px;padding-right:5px">
                            <tr></tr>
                            <tr><td  width="30%"><h4 class="text-primary">Model information</h4></td></tr>
                            <tr><td  width="30%"><h4 class="text-muted">Category</h4></td><td width="10%" id="mod-categ" style="color: #000;"></td><td  width="60%"><h4 class="text-muted">Willingnesses</h4></td> </tr>
                            <tr><td  width="30%"><h4 class="text-muted">StreamingQuality</h4></td><td  style="color: #000;" width="10%" id="mod-stream"></td> <td  style="color: #000;"  width="60%" id="mod-will"></td></tr>
                            <tr><td  width="30%"><h4 class="text-muted">Sex</h4></td>  <td id="mod-sex" style="color: #000;" width="10%"></td>  </tr>
                            <tr><td  width="30%"><h4 class="text-muted">Age</h4></td>    <td id="mod-age" style="color: #000;" width="10%"></td><td  width="60%"><h4 class="text-muted">Spoked Languages</h4></td> </tr>
                            <tr><td  width="30%"><h4 class="text-muted">Banned Country</h4></td> <td width="10%" style="color: #000;" id="mod-banned"></td> <td  width="60%"><p id="mod-lang"  style="color: #000;"></p> </td></tr>
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
         url: "/ajaxcron3",
         method: 'post',
         success: function (html) {
             //console.log(html);

             let array = JSON.parse(html.resultModels);

             $('#totalModels').text(html.$sizeallmodelsapprovedother);
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
            let status = (element.status);

            if((status === 'private_chat') || (status === 'free_chat') || (status === 'offline')){


                let modLang = element.details.languages;
                let modWill = element.details.willingnesses;
                let modCateg = element.category;
                let modstream = element.details.streamQuality;
                let modSex = element.persons[0].sex;
                let modAge = element.persons[0].age;
                let modBan = element.bannedCountries;

                let rating = element.details.modelRating;
                if (!rating) rating = 0;
                let charge = element.details.chargeAmount;
                if (!charge) charge = 0;

                let modelName = (element.performerId);
                let src = (element.profilePictureUrl.size320x180);

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

                let aimg = $('<a />', {"class": 'btn btn-sm open-AddBookDialog1',
                    "href":'#addBookDialog1',
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
                let ribon2 = $('<div />', {"class": 'ribbon ribbon-style-6',"style":"margin-top: 170px!important;background-color:#00a2ff!important"});
                let ribon3 = $('<div />', {"class": 'ribbon ribbon-style-6',"style":"margin-top: 210px!important;background-color:#00a2ff!important"});
                let textribon = $('<p />', {text: rating+" "});
                let textribon2 = $('<p />', {text: "0 RT"});
                let textribon3 = $('<p />', {"id":'visits'+modelName, text: "0 VISITS"});
                let icon = $('<i />', {"class": "fa fa-star","style":'color: #ffc107!important'});
                let icon2 = $('<i />', {"class": "fa fa-share-alt","style":"padding-left: 5px;"});
                let icon3 = $('<i />', {"class": "fas fa-users","style":"padding-left: 5px;"});
                let h4ribon = $('<h4 />', {"class": 'text-danger  mt-4',text: '$'});
                let span = $('<span />', {"class": 'text-danger  mt-4',text: charge});

                aimg.append(img);
                h4ribon.append(span);
                textcenter.append(newimg);
                textcenter.append(aimg);
                textcenter.append(h4);
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
                cardbody.append(ribon);
                cardbody.append(ribon2);
                cardbody.append(ribon3);
                cardbody.append(textcenter);
                card.append(cardbody);
                maincard.append(card);

                $("#mainrow").append(maincard);

                //getVisits(modelName);
                //$('[data-toggle="tooltip"]').tooltip();



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

    /*$(document).on("click", ".open-AddBookDialog", function () {

        let modLang = $(this).data('lang');
        let modWill = $(this).data('will');
        let modCateg = $(this).data('categ');
        let modstream = $(this).data('stream');
        let modSex = $(this).data('sex');
        let modAge = $(this).data('age');
        let modBan = $(this).data('ban');

        let modelName = $(this).data('id');
        let obj = $(".modal-body #main");

        $('#mod-lang').text(modLang);
        $('#mod-will').text(modWill);
        $('#mod-categ').text(modCateg);
        $('#mod-stream').text(modstream);
        $('#mod-sex').text(modSex);
        $('#mod-age').text(modAge);
        $('#mod-banned').text(modBan);


        let div = $('<div />', {"id": 'object_container',"style":'width:750px;height:300px'});

        let url = '//awempt.com/embed/lf?c=object_container&site=jasmin&cobrandId=&psid=14noiembrie&pstool=202_1&psprogram=revs&campaign_id=&category=&forcedPerformers[]='+modelName+'&preferredPerformers[]='+modelName+'&vp[showChat]=false&vp[chatAutoHide]=false&vp[showCallToAction]=false&vp[showPerformerName]=true&vp[showPerformerStatus]=true&filters=&subAffId={SUBAFFID}';
        let script=document.createElement('script');
        script.type='text/javascript';
        script.src=url;

        div.append(script);

        obj.empty();
        obj.append(div);

        //console.log(modelName);
        //console.log(url);




    });*/

    function toggle(className, obj) {
        let $input = $(obj);
        if ($input.prop('checked')) $(className).show();
        else $(className).hide();
    }


    function getVisits(modelname){

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "/getModelVisit/"+modelname,
            method: 'post',
            success: function (html) {
                console.log(html);

                $('#visits'+modelname).text(html+' VISITS');

            }
        });

    }


</script>

@endpush



