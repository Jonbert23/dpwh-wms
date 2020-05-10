@extends('MasterTemplate.admin')

@section('header')
    Activity Logs
@endsection()

@section('content')
<div class="row">
    <div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-title">
            Search Worker DTR
        </div>

        <div>
            <div class="panel-body">
                <form class="form-inline" action="/searchLogs" method="POST">
                    {{@csrf_field()}}
                    <div class="form-group col-md-5">
                        <label class="form-label col-md-3">Enter Date</label>
                        <input type="date" class="form-control col-md-9"  name="searchLog" required="required">
                    </div>
                    <button type="submit" class="btn btn-default">Search</button>
                </form>
            </div>
        </div>
    </div>
</div>




    <div class="col-md-12">
        <div class="panel panel-default">
    
          <div class="panel-title">
            Activity Logs
          </div>
          <div class="panel-body">
            <table class="table table-bordered table-striped" id="leaveCreate">
              <thead>
                <tr>
                    <td>No.</td>
                    <td >Responsible</td>
                    <td >Activity</td>
                    <td >Date</td>
                    <td>Time</td>
                </tr>
              </thead>
              <tbody>
                @if($log)
                    @foreach($log as $logs)
                        <?php $counter = $counter + 1;?>     
                        <tr>
                            <td>{{$counter}}.</td>
                            <td >{{\App\Worker::find($logs->worker_id)->firstName}} {{\App\Worker::find($logs->worker_id)->lastName}}</td>
                            <td>{{$logs->activity}}</td>
                            <td>{{$logs->date}}</td>
                            <td>{{$logs->time}}</td>
                        </tr>     
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