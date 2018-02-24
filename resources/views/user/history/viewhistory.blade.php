@extends('layouts.master')

@section('page-title') {{ trans('titles.packageHistory') }} @stop

@section('breadcrumb')
    <section class="content-header">
        <ol class="breadcrumb">
            <li>
                <a href="{{ url('home') }}"><i class="fa fa-dashboard"></i> Home</a>
            </li>
            <li class="active">Package History</li>
        </ol>
    </section>
@stop

@section('content')



  <div class="container">
      <h2>Balance</h2>
      <ul class="nav nav-tabs">
          <li class="active"><a href="#subcription">Subscription</a></li>
          <li><a href="#sweeptake">Sweeptake</a></li>
          <li><a href="#purchase">Purchase</a></li>
      </ul>

      <div class="tab-content">
          <div id="subcription" class="tab-pane fade in active">
              <h3>Subscription</h3>
              <div class="row">
                  <div class="col-md-12">
                      <div class="box">
                          <div class="box-header">

                          </div>
                          <div class="box-body">
                              <table id="userdata" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                      <th>S.No</th>
                                      <th>User Name</th>
                                      <th>Sweeptake Point</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php $srNo = 0?>
                                  @foreach($roledata as $roledata)
                                      <tr>
                                          <td>{{ ++$srNo }}</td>
                                          <td>{{ $roledata->role }}</td>
                                          <td>{{ $roledata->role }}</td>
                                      </tr>
                                  @endforeach
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div id="sweeptake" class="tab-pane fade">
              <h3>Sweeptake</h3>
              <div class="row">
                  <div class="col-md-12">
                      <div class="box">
                          <div class="box-header">

                          </div>
                          <div class="box-body">
                              <table id="userdata" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                      <th>S.No</th>
                                      <th>Role</th>
                                      <th>Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php $srNo = 0?>

                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
          <div id="purchase" class="tab-pane fade">
              <h3>Purchase</h3>
              <div class="row">
                  <div class="col-md-12">
                      <div class="box">
                          <div class="box-header">

                          </div>
                          <div class="box-body">
                              <table id="userdata" class="table table-bordered table-striped">
                                  <thead>
                                  <tr>
                                      <th>S.No</th>
                                      <th>Role</th>
                                      <th>Action</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php $srNo = 0?>

                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

  <script>
      $(document).ready(function(){
          $(".nav-tabs a").click(function(){
              $(this).tab('show');
          });
      });
  </script>
















@stop