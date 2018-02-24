@extends('layouts.master')

@section('page-title') {{ trans('titles.sweepstakes') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Add Sweepstake</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Sweepstake</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="box box-info">
                <div class="col-md-12">
                    {!! form($form) !!}
                </div>
            </div>
        </div>
    </div>
@stop