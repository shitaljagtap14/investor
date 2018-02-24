@extends('layouts.master')

@section('page-title') {{ trans('titles.sweepstake') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Sweeptakes</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="packageContainer">
        <div class="package">
            <div class="packageLeftBar">
                <ul>
                    <li>Package Name</li>
                    <li>Amount</li>
                    <li>Entry Level</li>
                    <li>Sweeptake Point</li>
                    <li></li>
                </ul>
            </div>
            <?php $i = 0;?>
            @foreach($sweepstakes as $sweepstake)
                <div class="packageDetails yellow">
                    <ul>
                        <li id="a{{$i}}">{{ strtoupper(@$sweepstake->subscription->package) }}</li>
                        <li id="a{{$i}}">${{ @$sweepstake->subscription->amount }}</li>
                        <li>{{ @$sweepstake->subscription->status_level }}</li>
                        <li>{{ @$sweepstake->entry_point }}</li>
                            <form method="POST" action="{{ url('sweeptakes/balance') }}" class="form-horizontal">
                            {{ csrf_field() }}
                            <input type="hidden" name="users_id" value="{{@$user->id}}">
                            <input type="hidden" name="sweepstakes_id" value="{{@$sweepstake->id}}">
                            <input type="hidden" name="sweeptake_point" value="{{@$sweepstake->entry_point}}">
                            <input type="submit" value="Join">
                        </form>
                        <?php ++$i ?>
                    </ul>
                </div>
                @if($i%5==0)
                    <div class="packageLeftBar">
                        <ul>
                            <li>Package Name</li>
                            <li>Amount</li>
                            <br><br>
                            <li>Entry Level</li>
                            <li>Entry Point</li>
                            <li></li>
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@stop


