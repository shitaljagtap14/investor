@extends('layouts.master')

@section('page-title') {{ trans('titles.Success') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>Success</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Success</li>
        </ol>
    </section>
@stop

@section('content')

    <div>
        <h2>Dear Member</h2>
        <span>Your payment was successful, thank you for purchase.</span><br/>
     {{--   <span>Item Number :
            <strong>{{ $payments->sweepstakes_id }}</strong>
    </span><br/>
        <span>TXN ID :
        <strong>{{ $paymentst->txn_id }}</strong>
    </span><br/>
        <span>Amount Paid :
        <strong>${{ $payments->payment_gross }}</strong>
    </span><br/>--}}
      {{--  <span>Payment Status :
     {{ $paymentData }}
    </span><br/>--}}
    </div>



@stop


