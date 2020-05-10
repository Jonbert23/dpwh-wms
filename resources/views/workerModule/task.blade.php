@extends('MasterTemplate.worker')

@section('head')
    <style>
        .img-resize
        {
            height: 350px;
            width: 350px;
            margin: auto;
        }
        hr.hrStyle
        {
            border: none;
            border-top: 2px solid;
        }
    </style>
@endsection()

@section('header')
    Worker Task
@endsection()

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-title panel-info">
      Active Task
      </div>
      <div class="panel-body table-responsive">
          <table id="contract04" class="table table-bordered">
              <thead>
                  <tr>
                      <th>Task</th>
                      <th>MPP</th>
                      <th>Location</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                  </tr>
              </thead>     
              <tbody>
                  @if($sched)
                    @foreach($sched as $scheds)
                        @if($worker->id == $scheds->worker->id && $scheds->dateTo >= $now) 
                        <tr>
                            <td>{{$scheds->work->name}}</td>
                            <td>
                                @foreach($mpp as $mpps)
                                    @if($scheds->mpp == $mpps->id)
                                        {{$mpps->firstName}} {{$mpps->lastName}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$scheds->location->zoneName}} {{$scheds->location->barangayName}}, {{$scheds->location->cityName}}</td>
                            <td>{{$scheds->dateFrom}}</td>
                            <td>{{$scheds->dateTo}}</td>
                        </tr>
                        @endif
                    @endforeach
                  @endif 
            </tbody>
          </table>
      </div>
    </div>
  </div>

  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-title panel-danger">
      Past Task/Expired Task
      </div>
      <div class="panel-body table-responsive">
          <table id="contract04" class="table display">
              <thead>
                  <tr>
                      <th>Task</th>
                      <th>MPP</th>
                      <th>Location</th>
                      <th>Start Date</th>
                      <th>End Date</th>
                  </tr>
              </thead>     
              <tbody>
                  @if($sched)
                    @foreach($sched as $scheds)
                        @if($worker->id == $scheds->worker->id && $scheds->dateTo <= $now)
                        <tr>
                            <td>{{$scheds->work->name}}</td>
                            <td>
                                @foreach($mpp as $mpps)
                                    @if($scheds->mpp == $mpps->id)
                                        {{$mpps->firstName}} {{$mpps->lastName}}
                                    @endif
                                @endforeach
                            </td>
                            <td>{{$scheds->location->zoneName}} {{$scheds->location->barangayName}}, {{$scheds->location->cityName}}</td>
                            <td>{{$scheds->dateFrom}}</td>
                            <td>{{$scheds->dateTo}}</td>
                        </tr>
                        @endif
                    @endforeach
                  @endif 
            </tbody>
          </table>
      </div>
    </div>
  </div>
@endsection()