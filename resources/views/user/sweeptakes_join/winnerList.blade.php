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
            @foreach($userSweeptakeOffers as $userSweeptake)
            <?php
                $url = 'javascript:void(0)';
                $status = 'Pending';
                $bg_color = 'bg-aqua-active';
                if(count($userSweeptake->sweeptakeOffers->winners) > 0):
                    $url = url("winner/users-list/".strtolower(str_replace(' ', '_', $userSweeptake->sweeptakeOffers->win_product))."/".$userSweeptake->sweeptakeOffers->id);
                    $bg_color = 'bg-olive';
                    $status = 'Announced';
                endif;
            ?>
            <div class="col-md-4">
                <a href="{{$url}}" class="winner-list-box status-{{strtolower($status)}}">
                    <div class="box box-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header widget-user-header-sm {{$bg_color}}">
                            <h3 class="widget-user-username">{{$userSweeptake->sweeptakeOffers->win_product}}</h3>
                            <span class="winner-status-label winner-status-{{strtolower($status)}}">{{$status}}</span>
                        </div>
                        <div class="box-footer box-footer-sm">
                            <div class="row">
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$userSweeptake->sweeptakeOffers->sweeptakes_entry}}</h5>
                                        <span class="description-text description-text-winner">Entries</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 border-right">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$userSweeptake->sweeptakeOffers->no_of_winner}}</h5>
                                        <span class="description-text description-text-winner">Winners</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4">
                                    <div class="description-block">
                                        <h5 class="description-header">{{$userSweeptake->sweeptakeOffers->limit_of_participate}}</h5>
                                        <span class="description-text description-text-winner">Particiate</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
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

