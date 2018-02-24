@extends('layouts.master')

@section('page-title') {{ trans('titles.subscriptions') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Add User</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Add User</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="col-md-12">
                    <form method="POST" action="{{ url('user/add') }}" class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group has-feedback {{ $errors->has('name') ? ' has-error' : '' }}">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}"
                                   placeholder="Name"
                                   required autofocus>

                            @if ($errors->has('name'))
                                <span class="help-block">
                        <strong>{{ $errors->first('name') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('email') ? ' has-error' : '' }}">
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}"
                                   placeholder="E-Mail Address" required>
                            @if ($errors->has('email'))
                                <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                            @if ($errors->has('password'))
                                <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong></span>
                            @endif
                        </div>

                        <div class="form-group has-feedback">
                            <input type="password" class="form-control" name="password_confirmation"
                                   placeholder="Confirm Password" required>
                        </div>

                        <div class="row">
                            <div class="col-xs-4">
                                <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
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