@extends('layouts.master')

@section('page-title') {{ trans('titles.dashboard') }} @stop

@section('breadcrumb')
    <section class="content-header" xmlns:color="http://www.w3.org/1999/xhtml">
        <h1>


        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
        </ol>
    </section>
@stop

@section('content')
    @if($user->is_admin)
        <!-- Info boxes -->

        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12"><a href="/user">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="ion-person-stalker"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Current User </span>
                        <span class="info-box-number">{{ $userdata }}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </a>
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12"><a href="/subscription">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="fa fa-google-plus"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Subcription</span>
                        <span class="info-box-number">{{ $subscriptions }}</span>
                    </div>

                </div>
</a>
            </div>



            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12"><a href="/sweepstakes">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="ion ion-ios-cart-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sweeptakes</span>
                        <span class="info-box-number">{{ $sweeptakes }}</span>
                    </div>
</div></a>
                </div>

            </div>

            <div class="col-md-3 col-sm-6 col-xs-12"><a href="/purchase">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion ion-ios-people-outline"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Purchase</span>
                        <span class="info-box-number">{{ $purchase }}</span>
                    </div>

                </div>
</a>
            </div>

    

 
@else
    <br><br>
    <div class="row">

        <div class="col-md-3 col-sm-6 col-xs-12"><a href="/user/edit">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="ion-person-stalker"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Profile</span>
                        <span class="info-box-number"></span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12"><a href="/package/history">
                <div class="info-box">
                    <span class="info-box-icon bg-gray"><i class="fa fa-history" style="font-size:80px;color:white"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">History</span>
                        <span class="info-box-number"></span>
                    </div>
                </div>
            </a>
        </div>





        <div class="col-md-3 col-sm-6 col-xs-12"><a href="/subscriptionuser">
                <div class="info-box">
                   
                  <span class="info-box-icon bg-aqua"> <i class="material-icons" style="font-size:80px;color:white">&#xe873;</i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Subcription</span>
                        <span class="info-box-number">{{ $subscriptions }}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12"><a href="/sweeptakesuser">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="material-icons" style="font-size:80px;color:white">&#xe873;</i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sweeptakes</span>
                        <span class="info-box-number">{{ $sweeptakes }}</span>
                    </div>

                </div>
            </a>

        </div>
        <div class="col-md-3 col-sm-6 col-xs-12"><a href="/extrasweeptakeuser">
                <div class="info-box">
                    <span class="info-box-icon bg-red"><i class="material-icons" style="font-size:80px;color:white">&#xe873;</i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sweeptakes Point</span>
                        <span class="info-box-number">{{ $sweeptakes }}</span>
                    </div>

                </div>
            </a>

        </div>

        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12"><a href="/purchaseuser">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="material-icons" style="font-size:80px;color:white">&#xe873;</i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Purchase</span>
                        <span class="info-box-number">{{ $purchase }}</span>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12"><a href="/join/sweeptakes">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="material-icons" style="font-size:80px;color:white">&#xe873;</i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Join Sweeptakes</span>
                        <span class="info-box-number">{{ $sweeptakes_join }}</span>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12"><a href="/winner/list">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="material-icons" style="font-size:80px;color:white">&#xe873;</i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Sweeptake Winner</span>
                        <span class="info-box-number"></span>
                    </div>
                </div>
            </a>
        </div>
    </div>
   @endif
@stop