@extends('layouts.master')

@section('page-title') {{ trans('titles.purchase_coins') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Add Purchase</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Purchase_coins</li>
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



