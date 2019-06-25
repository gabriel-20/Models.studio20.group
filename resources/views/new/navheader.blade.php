<!--**********************************
        Nav header start
    ***********************************-->
<div class="nav-header" style="background: #ad1457!important;">
    <div class="brand-logo">
        <a href="#" style="text-align: center;">
            <b><img src="{{ URL::asset('/images/logo100.png') }}" alt="" style="width: 70px;">
            </b>
        </a>
    </div>
    <div class="nav-control">
        <div class="hamburger"><span class="line"></span>  <span class="line"></span>  <span class="line"></span>
        </div>
    </div>
</div>
<script>

    function getData(modelName, id){

        //console.log('ss');

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        jQuery.ajax({
            url: "/proxy/" + modelName,
            method: 'post',
            data: {modelname: modelName},
            success: function (html) {
                if (html == 0){
                    return 0;
                } else {
                    $("#"+id).attr('src',html);
                    return html;
                }
            }
        });
    }

</script>
<!--**********************************
        Nav header end
    ***********************************-->