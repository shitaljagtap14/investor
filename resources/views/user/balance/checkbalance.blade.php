@extends('layouts.master')

@section('page-title') {{ trans('titles.winner') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Balance</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Balance</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <div class="dropdown">
                        <div class="col-sm-3"><a href="">
                                <div class="well">
                                    <h4>Subcription</h4></div>
                            </a></div>
                        <div class="col-sm-3"><a href="/sweeptakes/user/balance">
                                <div class="well">
                                    <h4>Sweeptake</h4></div>
                            </a></div>
                        <div class="col-sm-3"><a href="">
                                <div class="well">
                                    <h4>Purchase</h4></div>
                            </a></div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>


@stop




@section('scripts')
    <script>
        function selectusercount(){
            var e= document.getElementById('id').value;
            document.getElementById('hi').value=e;

        }
    </script>

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
