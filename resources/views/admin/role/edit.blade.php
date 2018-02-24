@extends('layouts.master')

@section('page-title') {{ trans('titles.Roles') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Edit Roles</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Edit Roles</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="col-md-12">
                    <form method="POST" action="{{ url("role/edit?id={$roledata->id}") }}" class="form-horizontal">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="control-label required">Role<span class="required">*</span></label>
                            <input class="form-control" placeholder="Reward Point" required name="role"
                                   type="text" id="role" value="{{ $roledata->role }}">
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
    </script>
@stop