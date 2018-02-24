@extends('layouts.master')

@section('page-title') 'Winners list' @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>{{$sweeptakeName}} Sweepstake Winner List</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Winner list</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">

                </div>
                <div class="box-body">
                    <table id="userdata" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Email Id</th>
                            <th>Winner Rank</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $srNo = 0?>
                        @foreach($users as $user)
                            <tr>
                                <td>{{ ++$srNo }}</td>

                                <td>{{ $user->user->name }}</td>
                                <td>{{ $user->user->email }}</td>
                                <td>{{ $user->winner_no }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $("#subscriptions").DataTable({
            'paging': true,
            'searching': true,
            'ordering': true,
            'info': true,
            'autoWidth': true,
            "aLengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
            "bProcessing": true,
            "bSort": true,
            "aaSorting": [[1, 'asc']],
            "aoColumnDefs": [{
                'bSortable': false,
                'aTargets': [0, 9]
            }]
        });
    </script>
@stop