@extends('MasterTemplate.worker')

@section('head')
 <style>
    .row-even {
    background-color:#9bdcde;
    }
    .row-odd {
    background-color:#BDE3FB;
    }
    .img-resize
    {
        height: 50px;
        width: 50px;
    }
    .dropdown-menu{
      background-color: transparent;
      border: transparent;
      border: none;
    }
    .dropdown-menu .dropdown-item > li > a:hover {
      background-image: none;
      
      background-color: #000!important;
    }

    .navbar {
      background: none;
    }
    .dropdown-content a:hover {
        background-color: transparent;
    }
    .hrStyle
        {
            border: none;
            border-top: 2px solid;
        }
 </style>
@endsection()

@section('header')
    My Leave
@endsection()

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">

      <div class="panel-title">
       My Current Leave
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped">
          <thead>
            <tr>
                <td>Start Date</td>
                <td>End Date</td>
            </tr>
          </thead>
          <tbody>
            @foreach($leave as $leaves)
                @if($leaves->worker_id == $id)
                    @if($leaves->startDate <= $dateNow && $leaves->endDate >= $dateNow)
                        <tr>
                            <td>{{$leaves->startDate}}</td>
                            <td>{{$leaves->endDate}}</td>
                        </tr>
                    @endif
                   
                @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="panel panel-default">

      <div class="panel-title">
       My Past Leave
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped" id="leaveCreate">
          <thead>
            <tr>
                <td>Start Date</td>
                <td>End Date</td>
            </tr>
          </thead>
          <tbody>
            @foreach($leave as $leaves)
                @if($leaves->worker_id == $id)
                    @if($leaves->endDate < $dateNow)
                        <tr>
                            <td>{{$leaves->startDate}}</td>
                            <td>{{$leaves->endDate}}</td>
                        </tr>
                    @endif
                   
                @endif
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection()

@section('jsScript')
    <script>
        $(document).ready(function() 
        {
            $('#leaveCreate').DataTable();
        } );
    </script>
@endsection()