@extends('layouts.master')

@section('page-title') {{ trans('titles.Roles') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Add Roles</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Add Roles</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="col-md-12">
                    <form method="POST" action="{{ url('role/add') }}" class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label class="control-label required">Role Name<span class="required">*</span></label>
                            <input class="form-control" placeholder="Role Name" required name="role" type="text"
                                   id="role">
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