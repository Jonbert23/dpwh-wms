@extends('MasterTemplate.hr')

@section('header')
    Admin Dashboard
@endsection()

@section('content')
<div class="row">
    <div class="col-lg-12">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
</div>
    
    <div class="col-md-4">
        <div class="panel panel-info">
            <div class="panel-title ">
            Total Workers
            </div>
            <div class="panel-body">
            <p class="text-center" style="font-size: 30px;">{{$totalWorker}}</p> 
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-success">
            <div class="panel-title ">
            Total Contracts
            </div>
            <div class="panel-body">
            <p class="text-center" style="font-size: 30px;">{{$totalContract}}</p> 
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="panel panel-danger">
            <div class="panel-title ">
            Unschedule Workers
            </div>
            <div class="panel-body">
            <p class="text-center" style="font-size: 30px;">{{$totalWorker - $scheduled}}</p> 
            </div>
        </div>
    </div>
        
  
    <div class="col-md-12">
        <div class="panel panel-default col-md-12">
            <div class="panel-body">
                <input type="hidden" value="{{$admin}}" id="admin">
                <input type="hidden" value="{{$accounting}}" id="accounting">
                <input type="hidden" value="{{$construction}}" id="construction">
                <input type="hidden" value="{{$maintenance}}" id="maintenance">
                <input type="hidden" value="{{$planning}}" id="planning">
                <input type="hidden" value="{{$forgotten}}" id="forgotten">
                <canvas id="chart"></canvas>
            </div>
        </div>
    </div>

    <div class="col-md-7">
            <div class="panel panel-widget">
              <div class="panel-title">
                Today's Task
              </div>
              <div class="panel-body">
                <table class="table table-dic table-hover ">
                    <thead>
                        <tr>
                            <td>Task</td>
                            <td>Location</td>
                            <td>MPP</td>
                            <td>Workers Number</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $locId = 0;
                            $workId = 0;
                            $mppId = 0;
                            $counter = 0;
                            $exist = 0;
                        ?>
                        @foreach($schedule as $sched)
                            @if($sched->dateFrom <= $dateNow && $sched->dateTo >= $dateNow)

                                @foreach($schedule as $s_sched)
                                    @if($sched->location_id == $s_sched->location_id && $sched->work_id == $s_sched->work_id && $sched->mpp == $s_sched->mpp)
                                       <?php $counter = $counter + 1;?>
                                    @endif
                                @endforeach

                                @if($locId == $sched->location_id && $workId == $sched->work_id &&  $mppId == $sched->mpp)
                                    <?php  $exist = 1;?>
                                @endif
                               
                                @if($exist == 0)
                                    <tr>
                                        <td>{{\App\Work::find($sched->work_id)->name}}</td>
                                        <td>{{\App\Location::find($sched->location_id)->zoneName}} {{\App\Location::find($sched->location_id)->barangayName}}, {{\App\Location::find($sched->location_id)->cityName}}</td>
                                        <td>{{\App\Worker::find($sched->mpp)->firstName}} {{\App\Worker::find($sched->mpp)->lastName}}</td>
                                        <td>{{$counter}} Distributed Workers</td>
                                    </tr>
                                    <?php
                                        $locId = $sched->location_id;
                                        $workId = $sched->work_id;
                                        $mppId = $sched->mpp;
                                    ?> 
                                @endif
                                
                            @endif
                            <?php 
                                $counter = 0;
                                $exist = 0;
                            ?>
                        @endforeach
                    </tbody>
                </table>          
            </div>
        </div>
    </div>

    <div class="col-md-5">
        <div class="panel panel-widget">
          <div class="panel-title">
            <div class="col-md-8">
                This Month Expiring Contract
            </div> 
            <div class="col-md-4">
                <a href="/notify" class="btn btn-default">Notify All</a>
            </div>
          </div>
          <div class="panel-body">
            <table class="table table-dic table-hover ">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Expire Date</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach($worker as $workers)
                        @foreach($contract as $contracts)
                            @if($workers->id == $contracts->worker_id)
                                @if($monthNow == \Carbon\Carbon::CreateFromFormat('Y-m-d',$contracts->expiryDate)->month)
                                    @if($yearNow == \Carbon\Carbon::CreateFromFormat('Y-m-d',$contracts->expiryDate)->year)
                                        <tr>
                                            <td>{{$workers->firstName}} {{$workers->lastName}}</td>
                                            <td>{{$contracts->expiryDate}}</td>
                                        </tr>
                                    @endif
                                @endif
                            @endif
                        @endforeach
                    @endforeach
                </tbody>
            </table>          

        </div>
    </div>
</div>
    
    
@endsection()

@section('jsScript')
    
<script>
    var admin = document.getElementById('admin').value;
    var accounting = document.getElementById('accounting').value;
    var construction = document.getElementById('construction').value;
    var maintenance = document.getElementById('maintenance').value;
    var planning = document.getElementById('planning').value;
    var forgotten = document.getElementById('forgotten').value;

    var ctx = document.getElementById('chart');
    var myChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: ['Administrative Section', 'Accounting Section', 'Maintenance Section', 'Construction Section', 'Planning Section', 'Sample Section'],
            datasets: [{
                label: 'Worker Distributon Per Section',
                data: [admin, accounting, maintenance, construction, planning, forgotten],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        }
    });
    </script>
@endsection()