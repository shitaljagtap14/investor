@extends('layouts.master')

@section('page-title') {{ trans('titles.join_sweeptakes') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <h1>&nbsp;</h1>
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Join Sweeptakes</li>
        </ol>
    </section>
@stop

@section('content')

    <div class="packageContainer">
        <div class="row">
            @foreach($sweeptakejoin as $sweeptakejoin)
            <div class="col-md-4">
                <div class="box box-widget widget-user-2">
                    <!-- Add the bg color to the header using any of the bg-* classes -->
                    <div class="widget-user-header bg-yellow">
                        <!-- /.widget-user-image -->
                        <h3>Win {{$sweeptakejoin->win_product }}</h3>
                        <h5>Point {{ $sweeptakejoin->sweeptakes_entry }}</h5>
                    </div>
                    <div class="box-footer no-padding">
                        <p class="text-muted text-center">{{ $sweeptakejoin->no_of_winner }} winner</p>
                        <p class="text-muted text-center">{{ $sweeptakejoin->till_at }}</p>
                    </div>
                    <?php
                    $temp=1;
                    $today = date('Y-m-d');
                    $till_at = new DateTime($sweeptakejoin->till_at);
                    $date1 = date_create($today);
                    $date2 = date_create($till_at->format('Y-m-d'));
                    $diff = date_diff($date1, $date2);
                    $timeDiff = $diff->format("%R%a days");
                    if ($timeDiff < 0) {
                        $temp=0;
                        echo '<p class="text-muted text-center">Expired.</p>';

                    } else {
                        echo '<p class="text-muted text-center">'.$timeDiff = $diff->format("%a days").'</p>';
                    }
                    ?>
                    <form method="POST" action="{{ url('join/sweeptakes/user') }}" class="form-horizontal">
                        {!! csrf_field() !!}

                        <input id="sweeptake_offers_id" type="hidden" name="sweeptake_offers_id"
                               value="{{ $sweeptakejoin->id }}">
                        <input id="users_id" type="hidden" name="users_id"
                               value="{{ @$user->id }}">
                        <input id="sweeptake_point" type="hidden" name="sweeptake_point"
                               value="{{ $sweeptakejoin->sweeptakes_entry }}">
                        <input id="no_of_winner" type="hidden" name="no_of_winner"
                               value="{{ $sweeptakejoin->no_of_winner}}">
                        <input id="till_at" type="hidden" name="till_at"
                               value="{{ $sweeptakejoin->till_at}}">
                        <input id="package_Status" type="hidden" name="package_Status"
                               value="{{ $temp }}">
                        @if($timeDiff < 0)
                            <button type="submit" class="btn bg-maroon btn-flat margin" disabled>Join</button>
                        @else
                            @if(count($sweeptakejoin->userSweeptake)== 0)
                                <button type="submit" class="btn bg-maroon btn-flat margin">Join</button>
                            @else
                                <button type="button" class="btn bg-purple btn-flat margin">Participated</button>
                            @endif
                        @endif
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <div class="card jsmasonry sLgBox public" data-win="300000" data-entryfee="8" data-leaguesize="50000" style="position: absolute; left: 0px; top: 139px;">
        <span class="fetu BookMark" title="Recommended" style="display: block;"></span>
        <div class="win">Win <span class="sWinTitle">Rs.3,00,000</span></div>
        <div class="pay">Pay <span class="sEntryFee">Rs.8</span></div>
        <div class="lgType">
        </div>
        <div class="lgFillCnt"><span class="lgFillTxt"><span class="sCurrentSize">35,859</span>/<span class="sLeagueSize">50,000</span> teams</span>
            <div class="lgFilled"><span style="width: 72%;"></span></div>
        </div>

        <div class="multiWinner" data-tourid="784" data-roundid="9915" data-leagueid="36423092" data-leaguetype="special" data-price="8" data-invitecode="4KWPV35UNE6C" data-win="300000" style="display: block;">
            <div class="winDesc">
                <span>
                    <p class="winnerCnt">30,000 Winners</p>
                </span>
            </div>

            <div class="winDet">

                <div class="MultiWinnerTemplate"></div>
            </div>
        </div>

    </div>













@stop
