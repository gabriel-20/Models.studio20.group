@extends('new.layout')

@section('headerInclude')

    @include('new.head')

@endsection

@section('content')
    <!--**********************************
        Content body start
    ***********************************-->

    <div class="content-body">
        <div class="container-fluid">
            <div class="row page-titles">
                <div class="col p-md-0">
                    <h4>Twitter Stats</h4>
                </div>
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="">Twitter Stats</a>
                        </li>
                    </ol>
                </div>
            </div>


            <div class="container">
                <ul class="nav nav-tabs">

                    <li class="active"><a data-toggle="tab"  href="#alltweets" style="color: #7f63f4;"><b>Tweets</b></a></li>

                    <li><a data-toggle="tab" href="#promo" style="color: #fe60ad;"><b>Promo</b></a></li>


                </ul>

                <div class="tab-content">

                    <div class="tab-pane" id="alltweets">

                        <table id="myTable" class="display">
                            <thead>
                            <tr>
                                <th>Twitter Account</th>
                                <th>Tweet ID</th>
                                <th>Tweet Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tweets as $tweet)
                                <tr onclick="tweetpage('{{ $tweet->twitter_account }}','{{ $tweet->tweet_id }}');">
                                    <td>{{ $tweet->twitter_account }}</td>
                                    <td>{{ $tweet->tweet_id }}</td>
                                    <td>{{ $tweet->tweet_date }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>


                    </div>


                    <div class="tab-pane" id="promo">

                        <table id="myTablePromo" class="display">
                            <thead>
                            <tr>
                                <th>Twitter Account</th>
                                <th>Tweet ID</th>
                                <th>Tweet Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($tweetsPromo as $tweet)
                                <tr onclick="tweetpage('{{ $tweet->twitter_account }}','{{ $tweet->tweet_id }}');">
                                    <td>{{ $tweet->twitter_account }}</td>
                                    <td>{{ $tweet->tweet_id }}</td>
                                    <td>{{ $tweet->tweet_date }}</td>
                                </tr>
                            @endforeach
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
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js" defer></script>


<script type="text/javascript">

    jQuery(document).ready(function(){
        $('.nav-tabs a:first').tab('show');

        $('#myTable').DataTable({
            "order": [[ 2, "desc" ]]
        });

        $('#myTablePromo').DataTable({
            "order": [[ 2, "desc" ]]
        });
    });

    function tweetpage(name, id){
        window.open("https://twitter.com/"+name+"/status/"+id);
    }

</script>

@endpush



