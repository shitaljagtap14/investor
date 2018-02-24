@extends('layouts.master')

@section('page-title') {{ trans('titles.Sweeptakesjoin') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Add Sweeptakes Product</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Sweeptakes Product</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="col-md-12">
                    <form method="POST" action="{{ url('sweeptakesjoin/add') }}" class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="control-label required">Win Product<span class="required">*</span></label>
                            <input class="form-control" placeholder="Win Product" required name="win_product" type="text"
                                   id="win_product">
                        </div>

                        <div class="form-group">
                            <label class="control-label required">Sweeptakes Point<span class="required">*</span></label>
                            <input class="form-control" placeholder="Sweeptakes Entry" required name="sweeptakes_entry" type="text"
                                   id="sweeptakes_entry">
                        </div>

                        <div class="form-group">
                            <label class="control-label required">No Of Winner<span class="required">*</span></label>
                            <input class="form-control" placeholder="No Of Winner" required name="no_of_winner" type="text"
                                   id="no_of_winner">
                        </div>

                        <div class="form-group">
                            <label class="control-label required">Limit Of Participate<span class="required">*</span></label>
                            <input class="form-control" placeholder="Limit Of Participate" required name="limit_of_participate" type="text"
                                   id="limit_of_participate">
                        </div>

                        <div class="form-group">
                            <label class="control-label required">Start Date<span class="required">*</span></label>
                            <input class="form-control" placeholder="Till Date" required name="till_at" type="date"
                                   id="till_at">
                        </div>

                        <div class="form-group">
                            <label class="control-label required">Till Date<span class="required">*</span></label>
                            <input class="form-control" placeholder="Till Date" required name="till_at" type="date"
                                   id="till_at">
                        </div>

                        <div class="form-options form-group">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <button class="btn btn-default" type="reset">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')
    <script>
        $(document).on('change', "#package", function () {
            var packageObj = $("#package");
            if (packageObj.val() === 'other') {
                $("#custom-pkg").removeClass('hidden');
            } else {
                $("#custom-pkg").addClass('hidden');
            }
        });
        $(document).on('change', "#bonus_point", function () {
            var bonusObj = $("#bonus_point");
            var extraObj = $("#extra_point");
            var rewardObj = $("#reward_point");

            if (bonusObj.val() != '' && extraObj.val() != '') {
                rewardObj.val(+bonusObj.val() + +extraObj.val());
            }
        });
        $(document).on('change', "#extra_point", function () {
            var bonusObj = $("#bonus_point");
            var extraObj = $("#extra_point");
            var rewardObj = $("#reward_point");

            if (bonusObj.val() != '' && extraObj.val() != '') {
                rewardObj.val(+bonusObj.val() + +extraObj.val());
            }
        });
    </script>
@stop