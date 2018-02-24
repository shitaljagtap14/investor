@extends('layouts.master')

@section('page-title') {{ trans('titles.subscriptions') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Sweepstakes List</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Sweepstakes</li>
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
                    <table id="sweepstakes" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Entry Level</th>
                            <th>Entry Point</th>
                            <th>Package</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $srNo = 0?>
                        @foreach($sweepstakes as $sweepstake)
                            <tr>
                                <td>{{ ++$srNo }}</td>
                                <td>{{ @$sweepstake->subscription->status_level }}</td>
                                <td>{{ @$sweepstake->entry_point }}</td>
                                <td>{{ @$sweepstake->subscription->package }}</td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-info dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                            Actions <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a href="{{ url("sweepstakes/edit?id={$sweepstake->id}") }}">
                                                    <i class="fa fa-pencil-square"></i> Edit
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="del-sweep"
                                                   data-id="{{$sweepstake->id}}">
                                                    <i class="fa fa-trash"></i> Delete
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </td>
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