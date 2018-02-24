@extends('layouts.master')

@section('page-title') {{ trans('titles.Extra Sweeptake') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Add Extra Sweeptake</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Add Extra Sweeptake</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="col-md-12">
                    <form method="POST" action="{{ url('extrasweeptake/add') }}" class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="control-label required">Amount<span class="required">*</span></label>
                            <input class="form-control" placeholder="Amount" required name="amount" type="text"
                                   id="amount">
                        </div>

                        <div class="form-group">
                            <label class="control-label required">Sweetake Point<span class="required">*</span></label>
                            <input class="form-control" placeholder="Sweetake Point" required name="entry_point" type="text"
                                   id="entry_point">
                        </div>
                        <div class="row">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Submit</button>
                            </div>
                        </div>
                    </form>
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