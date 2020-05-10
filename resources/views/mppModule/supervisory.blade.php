@extends('MasterTemplate.mpp')


@section('header')
   Today's Supervisory
@endsection()

@section('content')

<div class="col-md-12">
    <div class="panel panel-default">

        <div class="panel-title">
        My Current Schedule
        </div>

        <div class="panel-body">
            <table class="table table-bordered table-striped" id="supervisory">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>ID Number</td>
                        <td>Section</td>
                        <td>Skill</td>
                    </tr>
                </thead>
            <tbody>
                @foreach($task as $tasks)
                    @if($tasks->mpp == $mppId)
                        @if($tasks->dateFrom <= $dateNow && $tasks->dateTo >= $dateNow)
                            <tr>
                                <td>{{\App\Worker::find($tasks->worker_id)->firstName}} {{\App\Worker::find($tasks->worker_id)->lastName}}</td>
                                <td>{{\App\Worker::find($tasks->worker_id)->idNumber}}</td>
                                <td>{{\App\Worker::find($tasks->worker_id)->section->name}}</td>
                                <td>{{\App\Worker::find($tasks->worker_id)->skill->name}}</td>
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
            $('#supervisory').DataTable();
        } );
    </script>
@endsection()