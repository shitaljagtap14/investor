@extends('layouts.master')

@section('page-title') {{ trans('titles.subscriptions') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Edit Subscription</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Edit Subscription</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="col-md-12">
                    <form method="POST" action="{{ url("subscription/edit?id={$subscription->id}") }}"
                          class="form-horizontal">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="package" class="control-label">Package Name <span
                                        class="required">*</span></label>
                            <select class="form-control" id="package" name="package">
                                <option value="" selected="selected">=== Select Package ===</option>
                                @foreach($packages as $key => $package)
                                    <option value="{{ $key }}"
                                            @if($subscription->package == $key) selected @endif>{{ $package }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group hidden" id="custom-pkg">
                            <label for="custom-pkg" class="control-label">Custom Package<span class="required">*</span></label>
                            <input class="form-control" placeholder="Custom Package" name="custom_package"
                                   type="text" id="custom_package">
                        </div>
                        <div class="form-group">
                            <label for="subscription_amt" class="control-label required">Subscription Amount<span
                                        class="required">*</span></label>
                            <input class="form-control" placeholder="Subscription Amount" required
                                   name="subscription_amt"
                                   type="text" id="subscription_amt" value="{{ $subscription->amount }}">
                        </div>
                        <div class="form-group">
                            <label for="bonus_point" class="control-label required">Bonus Point<span
                                        class="required">*</span></label>
                            <input class="form-control" placeholder="Bonus Point" required name="bonus_point"
                                   type="text" id="bonus_point" value="{{ $subscription->bonus_point }}">
                        </div>
                        <div class="form-group">
                            <label for="extra_point" class="control-label required">Extra Point<span
                                        class="required">*</span></label>
                            <input class="form-control" placeholder="Extra Point" required name="extra_point"
                                   type="text" id="extra_point" value="{{ $subscription->extra_point }}">
                        </div>
                        <div class="form-group">
                            <label for="reward_point" class="control-label required">Reward Point<span class="required">*</span></label>
                            <input class="form-control" placeholder="Reward Point" required name="reward_point"
                                   type="text" id="reward_point" value="{{ $subscription->reward_point }}">
                        </div>
                        <div class="form-group">
                            <label for="active_status" class="control-label required">Select Option<span
                                        class="required">*</span></label>
                            <select class="form-control" required="required" id="active_status" name="active_status">
                                <option value="" selected="selected">=== Select Option ===</option>
                                @foreach($options as $key => $option)
                                    <option value="{{ $key }}"
                                            @if($subscription->status == $key) selected @endif>{{ $option }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="status_level" class="control-label required">Status Level<span class="required">*</span></label>
                            <input class="form-control" placeholder="Status Level" required name="status_level"
                                   type="text" id="status_level" value="{{ $subscription->status_level }}">
                        </div>
                        <div class="form-group">
                            <label for="interest" class="control-label required">Interest<span class="required">*</span></label>
                            <input class="form-control" placeholder="Interest" required name="interest"
                                   type="text" id="interest" value="{{ $subscription->interest }}">
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