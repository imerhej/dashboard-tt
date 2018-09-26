@extends('layouts.backend')

@section('content')
<div class="container-fluid">

<!-- Page Heading and Breadcrumb -->
  <div class="row">
    <div class="col-lg-12">
      <h3 class="page-header">
        <i class="fa fa-dashboard"> Dashboard</i>
      </h3>
      <ol class="breadcrumb">
        <li class="active">
          <a href="{{route('dashboard.dashboard')}}"><i class="fa fa-dashboard"> Dashboard</i></a>
        </li>
      </ol>
    </div>
  </div><!--/.row -->

  <div class="row">
    <div class="col-lg-3 col-md-6">
      <div class="panel panel-blue">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-calendar fa-4x"></i>
            </div>
            <div class="col-xs-8 text-right">
              <div class="huge">26</div>
              <div class="label">Scheduled Jobs!</div>
            </div>
          </div>
        </div>
        <a href="{{route('calendar.index')}}">
          <div class="panel-footer">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="panel panel-yellow">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-tasks fa-4x"></i>
            </div>
            <div class="col-xs-8 text-right">
              <div class="huge">12</div>
              <div class="label">Pending Jobs!</div>
            </div>
          </div>
        </div>
        <a href="">
          <div class="panel-footer">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="panel panel-green">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-truck fa-4x"></i>
            </div>
            <div class="col-xs-8 text-right">
              <div class="huge">24</div>
              <div class="label">Available Vehicles!</div>
            </div>
          </div>
        </div>
        <a href="">
          <div class="panel-footer">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>

    <div class="col-lg-3 col-md-6">
      <div class="panel panel-darkblue">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-3">
              <i class="fa fa-users fa-4x"></i>
            </div>
            <div class="col-xs-8 text-right">
              <div class="huge">12</div>
              <div class="label">Available Employees!</div>
            </div>
          </div>
        </div>
        <a href="">
          <div class="panel-footer">
            <span class="pull-left">View Details</span>
            <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>

  </div><!--/.row -->

</div><!--/.container-fluid -->

@endsection
