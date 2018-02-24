@extends('layouts.master')

@section('page-title') {{ trans('titles.Sweeptakebalance') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Sweeptake Balance</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Sweeptake Balance</li>
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
                    <table id="subscriptions" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>S.No</th>
                            <th>User Name</th>
                            <th>Sweeptake Point</th>

                        </tr>
                        </thead>
                        <tbody>
                        <?php $srNo = 0;$rNO=0?>
                        @foreach($sweeptake_balance as $sweeptake_balance)
                            <tr>
                                <td>{{ ++$srNo }}</td>
                                <td>{{ @$user->name }}</td>
                                <td>{{ $sweeptake_balance->sweeptake_point }}</td>

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <a href="/winner/list" class="btn btn-default">Back</a>
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
        $(".del-sub").on('click', function () {
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
                        $.get('{{ url('subscription/del') }}', {id: id}, function (response) {
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