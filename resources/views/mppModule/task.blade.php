@extends('MasterTemplate.mpp')


@section('header')
    My Task
@endsection()

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">

        <div class="panel-title">
        My Current Schedule
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <td>Location</td>
                        <td>Work/Task</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                    </tr>
                </thead>
            <tbody>
                <?php 
                    $sd = '';
                    $ed = '';
                ?>
                @foreach($task as $tasks)
                    @if($tasks->mpp == $mppId)
                        @if($tasks->dateFrom <= $dateNow && $tasks->dateTo >= $dateNow)
                            @if($sd != $tasks->dateFrom && $ed != $tasks->dateTo)
                                <tr>
                                    <td>{{\App\Location::find($tasks->location_id)->zoneName}} {{\App\Location::find($tasks->location_id)->barangayName}}, {{\App\Location::find($tasks->location_id)->cityName}}</td>
                                    <td>{{\App\Work::find($tasks->work_id)->name}}</td>
                                    <td>{{$tasks->dateFrom}}</td>
                                    <td>{{$tasks->dateTo}}</td>
                                </tr> 

                                <?php 
                                    $sd = $tasks->dateFrom;
                                    $ed = $tasks->dateTo;
                                ?>
                            @endif
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
        My Past Schedule
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped" id="task">
                <thead>
                    <tr>
                        <td>Location</td>
                        <td>Work/Task</td>
                        <td>Start Date</td>
                        <td>End Date</td>
                    </tr>
                </thead>
            <tbody>
                <?php 
                    $sd = '';
                    $ed = '';
                ?>
                @foreach($task as $tasks)
                    @if($tasks->mpp == $mppId)
                        @if($tasks->dateTo < $dateNow)
                            @if($sd != $tasks->dateFrom && $ed != $tasks->dateTo)
                                <tr>
                                    <td>{{\App\Location::find($tasks->location_id)->zoneName}} {{\App\Location::find($tasks->location_id)->barangayName}}, {{\App\Location::find($tasks->location_id)->cityName}}</td>
                                    <td>{{\App\Work::find($tasks->work_id)->name}}</td>
                                    <td>{{$tasks->dateFrom}}</td>
                                    <td>{{$tasks->dateTo}}</td>
                                </tr> 

                                <?php 
                                    $sd = $tasks->dateFrom;
                                    $ed = $tasks->dateTo;
                                ?>
                            @endif
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
            $('#task').DataTable();
        } );
    </script>
@endsection()