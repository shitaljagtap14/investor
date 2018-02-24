@extends('layouts.master')

@section('page-title') {{ trans('titles.purchase') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Purchase</li>
        </ol>
    </section>
@stop

@section('content')
    <div class="packageContainer">
        <div class="package">
            <div class="packageLeftBar">
                <ul>
                    <li>Amount</li>
                    <li>Reward Point</li>
                    <li>Sweeptake Point</li>

                    <li></li>
                </ul>
            </div>
            <?php $i = 0;?>
            @foreach($purchase as $purchase)
                <div class="packageDetails yellow">
                    <ul>
                        <li id="a{{$i}}">${{ $purchase->amount }}</li>
                        <br><br>
                        <li></li>
                        {{ $purchase->reword_point }}</li>
                        <li>{{ $purchase->additional_point }}</li>

                        <form action="{!! URL::route('addmoney.paypal') !!}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" name="business" value="Blueskymgmnt@gmail.com">
                            <input type="hidden" name="cmd" value="_xclick">
                            <input type="hidden" name="item_number" value="{{$purchase->id}}">
                            <input type="hidden" name="amount" value="{{$purchase->amount}}">
                            <input type="image" name="submit" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
                                   alt="PayPal - The safer, easier way to pay online">
                            <input type="hidden" name="cancel_return" value="http://127.0.0.1:8000/cancel">
                            <input type="hidden" name="return" value="http://127.0.0.1:8000/payment/success">
                            <input type="hidden" name="notify_url" value="http://127.0.0.1:8000/payment/success">
                        </form>

                        </form>
                        <?php ++$i ?>
                    </ul>
                </div>
                @if($i%5==0)
                    <div class="packageLeftBar">
                        ul>
                        <li>Amount</li>
                        <li>Reward Point</li>

                        <br><br>
                        <li>Additional Point</li>

                        <li></li>
                        </ul>
                    </div>
                @endif
            @endforeach
        </div>
    </div>
@stop



