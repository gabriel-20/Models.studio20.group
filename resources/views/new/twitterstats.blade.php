@extends('new.layout')

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
                    <tr>
                        <td>{{ $tweet->twitter_account }}</td>
                        <td>{{ $tweet->tweet_id }}</td>
                        <td>{{ $tweet->tweet_date }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

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
        $('#myTable').DataTable();
    });

</script>

@endpush



