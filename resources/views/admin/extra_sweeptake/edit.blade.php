@extends('layouts.master')

@section('page-title') {{ trans('titles.Extra Sweeptake') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Edit Extra Sweeptake</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Edit Extra Sweeptake</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="col-md-12">
                    <form method="POST" action="{{ url("extrasweeptake/edit?id={$extrasweepdata->id}") }}" class="form-horizontal">
                        {!! csrf_field() !!}

                        <div class="form-group">
                            <label class="control-label required">Amount<span class="required">*</span></label>
                            <input class="form-control" placeholder="Reward Point" required name="amount"
                                   type="text" id="amount" value="{{ $extrasweepdata->amount }}">
                        </div>

                        <div class="form-group">
                            <label class="control-label required">Sweeptake Point<span class="required">*</span></label>
                            <input class="form-control" placeholder="Reward Point" required name="entry_point"
                                   type="text" id="entry_point" value="{{ $extrasweepdata->entry_point }}">
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