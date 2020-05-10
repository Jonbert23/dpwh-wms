@extends('MasterTemplate.hr')

@section('head')
 <style>
    .row-even {
    background-color:#9bdcde;
    }
    .row-odd {
    background-color:#BDE3FB;
    }
 </style>
@endsection()


@section('header')
    Today's Task 
@endsection()

@section('content')
    <div class="row">
        <div class="col-lg-12">
                @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
        </div>
    </div>

    @if($schedule)
        @foreach($schedule as $sched)
            @if($sched->dateTo > $now && $sched->dateFrom < $now)
                <?php $scheduled = $scheduled + 1?>
            @endif
        @endforeach
    @endif

    @if($worker)
        @foreach($worker as $workers)
            @if($workers->status == 1 && $workers->role_id == 3)
                <?php $n_worker = $n_worker + 1?>
            @endif
        @endforeach
    @endif


    <div class="row">
        <div class="col-md-12 ">
        <ul class="topstats clearfix  row-even">
            <li class="col-xs-6 col-lg-3">
            <span class="title"> Scheduled Workers </span>
            <h3> <i> <img class="center" src="img/schedule.jpg" height="30" ></i> - {{$scheduled}}</h3>
            </li>
            <li class="col-xs-6 col-lg-3">
                <span class="title"> Unscheduled Workers </span>
                <h3> <i> <img class="center" src="img/unschedule.png" height="40" alt="logo"></i> - {{$n_worker - $scheduled}} </h3>
                </li>
            <li class="col-xs-6 col-lg-3">
            <span class="title">Task</span>
            <h3><i> <img class="center" src="img/task.png" height="30" alt="logo"></i> - {{$task}}</h3>
            
            </li>
            <li class="col-xs-6 col-lg-3">
            <span class="title ">Assigned Location</span>
            <h3>  <h3><i> <img class="center" src="img/location.png" height="30" alt="logo"></i> - {{$n_loc}}</h3>
            </li>
        </ul>
    </div>
       

        <div class="col-md-12">
                <div class="panel panel-default">
                    {{-- <div class="panel-title panel-info">
                        All MPP's
                    </div> --}}
                    <div class="panel-body table-responsive">
                        <table id="task" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Worker</th>
                                    <th>MPP</th>
                                    <th>Location</th>
                                    <th>Work</th>
                                    <td>Start Date</td>
                                    <td>End Date</td>
                                    <th>Action</th>
                                </tr>
                            </thead>     
                            <tbody>
                                @if($schedule && $worker)
                                    @foreach($schedule as $schedules)
                                        @if($schedules->dateFrom <= $now && $schedules->dateTo >= $now)
                                        <tr>
                                            <td>{{$schedules->worker->firstName}} {{$schedules->worker->lastName}}</td>
                                            <td> 
                                                @foreach($worker as $workers)
                                                    @if($workers->id == $schedules->mpp)
                                                        {{$workers->firstName}} {{$workers->lastName}}
                                                    @endif
                                                @endforeach                                    
                                            </td>
                                            <td>{{$schedules->location->zoneName}} {{$schedules->location->barangayName}}, {{$schedules->location->cityName}}</td>
                                            <td>{{$schedules->work->name}}</td>
                                            <td>{{$schedules->dateFrom}}</td>
                                            <td>{{$schedules->dateTo}}</td>
                                            <td>
                                                <a href="/hrSchedule/{{$schedules->id}}/edit"> 
                                                    <button type="button"  class="btn btn-default btn-icon btn-sm">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>
                                                <a href="/hrSchedule/{{$schedules->worker->id}}"> 
                                                    <button type="button"  class="btn btn-default btn-icon btn-sm">
                                                        <i class="fa fa-eye"></i>
                                                    </button>
                                                </a>
                                            </td>
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

@section('jsScript')

<script>
    $('#edit').on('show.bs.modal', function(event)
    {
        
        var button = $(event.relatedTarget)
        var name = button.data('name')
        var mpp = button.data('mpp')
        var location = button.data('location')
        var task = button.data('task')
       // var start = buton.data('start')
       // var end = button.data('end')

        var modal = $(this)
        modal.find('.modal-body  #worker').val(name)
        modal.find('.modal-body  #mpp').val(mpp)
        modal.find('.modal-body  #location').val(location)
        modal.find('.modal-body  #task').val(task)
        //modal.find('.modal-body  #start').val(start)
        //modal.find('.modal-body  #end').val(end)
        
    })
</script>

<script>
    $('#workEditModal').on('show.bs.modal', function(event)
    {
        console.log('Hellow Fuckers')
        var button = $(event.relatedTarget)
        var workName = button.data('working')
        var work = button.data('work')

        var modal = $(this)
        modal.find('.modal-body  #working').val(workName)
        modal.find('.modal-body  #work').val(work)
        
    })
</script>
<script>      
     $(document).ready(function() {
        $('#task').DataTable();
    } );
</script> 

@endsection()