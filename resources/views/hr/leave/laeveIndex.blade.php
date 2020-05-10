@extends('MasterTemplate.hr')

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
    Leave Workers
@endsection()

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">

      <div class="panel-title">
       Grant Leave
      </div>
      <div class="panel-body">
        <table class="table table-bordered table-striped" id="leaveCreate">
          <thead>
            <tr>
                <td ><br>ID Picture</td>
                <td ><br>Name</td>
                <td ><br>ID Number</td>
                <td>Start Date</td>
                <td>End Date</td>
            </tr>
          </thead>
          <tbody>
            @if($worker)
              @foreach($worker as $workers)
                @if($workers->role_id == 3)
                    @foreach($leaveWorker as $lw)
                        @if($workers->id == $lw->worker_id )
                            <tr>
                                <td class="center"><img class="img-responsive img-rounded img-resize" src="{{asset('img/Worker ID') }}/{{$workers->idPicture}}" center></td>
                                <td>{{$workers->firstName}} {{$workers->lastName}}</td>
                                <td>{{$workers->idNumber}}</td>
                                <td>{{$lw->startDate}}</td>
                                <td>{{$lw->endDate}}</td>
                            </tr>
                        @endif
                    @endforeach
                @endif
              @endforeach
            @endif
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