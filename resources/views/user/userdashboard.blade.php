@extends('layouts.master')

@section('page-title') {{ trans('titles.subscriptions') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Subscription</li>
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
                  {{--  <br><br>--}}
                    <li>Bonus Point</li>
                    <li>Extra Point</li>
                    <li>Reward Point</li>
                    <li>&nbsp;&nbsp;&nbsp;&nbsp;Interest</li>
                    <li></li>
                </ul>
            </div>

            <?php $i = 0;?>

            @foreach($subscriptions as $subscriptions)
                <div class="packageDetails yellow">
                    <ul>
                        <li id="a{{$i}}">{{ strtoupper($subscriptions->package) }}</li>
                        <li id="a{{$i}}">${{ $subscriptions->amount }}</li>
                        <li>{{$subscriptions->bonus_point }}</li>
                        <li>{{ $subscriptions->extra_point }}</li>
                        <li>{{ $subscriptions->reward_point }}</li>
                        <li>{{ $subscriptions->interest }}</li>
                        </li>
                        <form action="{!! URL::route('addmoney.paypal') !!}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="business" value="Blueskymgmnt@gmail.com">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="item_name" value="{{$subscriptions->package}}">
                            <input type="hidden" name="item_number" value="{{$subscriptions->id}}">
                            <input type="hidden" name="amount" value="{{$subscriptions->amount}}">
                            <input type="hidden" name="user_id" value="{{@$user->id}}">
                            <input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                                   alt="PayPal - The safer, easier way to pay online">
                            <input type="hidden" name="cancel_return" value="http://127.0.0.1:8000/cancel">
                            <input type="hidden" name="return" value="http://127.0.0.1:8000/payment/success">
                            <input type="hidden" name="notify_url" value="http://127.0.0.1:8000/payment/success">
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
                            <li>Bonus Point</li>
                            <li>Extra Point</li>
                            <li>Reward Point</li>
                            <li>&nbsp;&nbsp;&nbsp;&nbsp;Interest</li>
                            <li></li>
                        </ul>
                    </div>
                @endif
             @endforeach
        </div>
    </div>
@stop
<script>
    document.frmTransaction.submit();
</script>


