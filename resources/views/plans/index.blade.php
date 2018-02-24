@extends('layouts.master')

@section('page-title') {{ trans('titles.plan') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>plan</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">plan</li>
        </ol>
    </section>
@stop
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Choose your plan</div>

                    <div class="panel-body">
                        <ul class="list-group">
                            @foreach ($plan as $plan)
                                <li class="list-group-item clearfix">
                                    <div class="pull-left">
                                        <h4>{{ $plan->name }}</h4>
                                        <h4>${{ number_format($plan->cost, 2) }} monthly</h4>
                                        @if ($plan->description)
                                            <p>{{ $plan->description }}</p>
                                        @endif
                                    </div>

                                    <a href="{{ url('/plan', $plan->slug) }}" class="btn btn-default pull-right">Choose Plan</a>

                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection