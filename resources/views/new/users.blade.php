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
                    <h4>Users</h4>
                </div>
                <div class="col p-md-0">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="/home">Home</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <a href="">Users</a>
                        </li>
                    </ol>
                </div>
            </div>

            <table id="myTable" class="display">
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Register Date</th>
                </tr>
                </thead>
                <tbody>
                @foreach($result as $res)
                    <tr>
                        <td>{{ $res->id }}</td>
                        <td>{{ $res->name }}</td>
                        <td>{{ $res->email }}</td>
                        <td>{{ $res->superadmin }}</td>
                        <td>{{ $res->created_at }}</td>
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

        $('#myTable').dataTable( {
            "aaSorting": [[3,'desc']]
        } );

    });

</script>

@endpush



