@extends('layouts.master')
@section('content')
    <div class="row">
        <!-- left column -->
        <!-- edit form column -->
        <div class="col-md-9 personal-info">
            <h3>Personal info</h3>

            <form class="form-horizontal" role="form" action="{{ url('user/edit') }}" method="POST">
                {!!  csrf_field() !!}
                <div class="form-group">
                    <label class="col-lg-3 control-label">Username:</label>
                    <div class="col-lg-8">
                        <input class="form-control" type="text" name="name" value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">First name:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" name="firstname" value="{{$user->first_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Last name:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" name="lastname" value="{{$user->last_name}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">Email:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="text" name="email" value="{{$user->email}}">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label"> Old Password:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="password" name="old_password" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-lg-3 control-label">New Password:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="password" name="new_password" value="">
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-lg-3 control-label">Conform Password:</label>
                        <div class="col-lg-8">
                            <input class="form-control" type="password" name="confirm_password" value="">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="col-md-3 control-label"></label>
                        <div class="col-md-8">
                            <input type="submit" class="btn btn-primary" value="Save Changes">
                            <span></span>
                            <input type="reset" class="btn btn-default" value="Cancel">
                        </div>
                    </div>
                </div>
            </form>
        </div>
@stop
