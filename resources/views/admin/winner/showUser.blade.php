@extends('layouts.master')

@section('page-title') {{ trans('titles.winner') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Participate Sweeptake User List</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Sweeptake User</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <label>Select Offer Name</label>
                    <input type="text" name="id" id="id" value="{{ @$tag->win_product }}" >
                    <label>Till Date</label>
                    <input type="text" name="till_at" id="till_at" value="{{ @$tag->till_at }}" >
                    <div class="box-body">
                        <table id="sweepstakes" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>S.No</th>
                                <th>User Name</th>
                                <th>User Email</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php $srNo = 0?>
                             @foreach($data as $data)
                                   <tr>
                                       <td>{{ ++$srNo }}</td>
                                       <td>{{ @$data->name }}</td>
                                       <td>{{ @$data->email }}</td>

                                   </tr>
                             @endforeach
                            </tbody>
                        </table>
                    </div>
                    <a href="/participate/sweeptake/user" class="btn btn-default">Back</a>
                    <?php
                    $today = date('Y-m-d');
                    $till_at =@$tag->till_at;
                    if ($today <= $till_at) {
                        $var=1;
                    }else{
                        $var=0;
                    }
                    ?>

                  @if($var==0)

                        <a href="/winner/list" class="btn btn-default">Winner</a>

                    @endif
                </div>
            </div>
        </div>
        </div>
        @stop
        @section('scripts')
            <script>
                $("#sweepstakes").DataTable({
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
                        'aTargets': [0, 3]
                    }]
                });
                $(".del-sweep").on('click', function () {
                    var id = $(this).data('id');
                    swal({
                            title: "Are you sure?",
                            text: "You will not be able to recover!",
                            type: "warning",
                            showCancelButton: true,
                            confirmButtonClass: "btn-danger",
                            confirmButtonText: "Yes",
                            cancelButtonText: "No",
                            closeOnConfirm: false,
                            closeOnCancel: false
                        },
                        function (isConfirm) {
                            if (isConfirm) {
                                $.get('{{ url('sweepstakes/del') }}', {id: id}, function (response) {
                                    if (response = 'ok') {
                                        location.reload();
                                    } else {
                                        swal("Error", "Record doesn't exist :)", "error")
                                    }
                                });
                            } else {
                                swal("Cancelled", "Deletion canceled! :)", "error");
                            }
                        });
                });
            </script>
@stop