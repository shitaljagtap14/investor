@extends('layouts.master')

@section('page-title') {{ trans('Transactions') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Transaction</li>
        </ol>
    </section>
@stop

@section('content')
    <center><h3><B>Package Transaction</B></h3></center>
@stop