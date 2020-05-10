@extends('MasterTemplate.hr')

@section('header')
Update Worker Task
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

<div class="row">
    <div class="col-lg-12">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
</div>

<div class="row">
        <div class="col-lg-12">
          <div class="panel panel-default ">
    
            <div class="panel-title panel-info">
             Update Task Form
            </div>
                <div class="panel-body">
                <form method="POST"  action= "/hrSchedule/{{$schedule->id}}" enctype="multipart/form-data" >
                    {{@csrf_field()}}
                    {{@method_field('PUT')}}

                    <div class="col-lg-12 form-group">
                        <label for="input3"  class="form-label col-sm-12">Worker Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control " name="worker" value="{{$schedule->worker->firstName}} {{$schedule->worker->lastName}}" disabled>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        <label for="input3"  class="form-label col-sm-11">Task Name</label>

                        <div class="col-sm-12">
                             <select type="text" class="form-control" name="task" >
                            {{-- <option disabled selected>Select Task Name</option> --}}
                            @if($work)
                                @foreach($work as $works)
                                    <option value="{{$works->id}}" @if($works->name == $schedule->work->name) selected @endif>{{$works->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        </div>
                    </div>
                   
                    <div class="col-lg-12 form-group">
                        <label for="input3"  class="form-label col-sm-12">Designation/Location</label>

                        <div class="col-sm-12">
                            <select type="text" class="form-control " name="designation" >
                               
                                @if($location)
                                    @foreach($location as $locations)
                                        <option value="{{$locations->id}}" @if($locations->id = $schedule->location->id) selected @endif>{{$locations->zoneName}} {{$locations->barangayName}}, {{$locations->cityName}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="col-lg-12 form-group">
                        <label for="input3"  class="form-label col-sm-12">MPP</label>
                        <div class="col-sm-12">
                            <select type="text" class="form-control " name="mpp" >
                      
                            @if($worker)
                                @foreach($worker as $workers)
                                    @if($workers->role_id == 2)
                                        <option value="{{$workers->id}}" @if($workers->id == $schedule->mpp) selected @endif>{{$workers->firstName}} {{$workers->lastName}} </option>
                                    @endif
                                @endforeach
                            @endif
                        </select>
                        </div>
                        
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="input3"  class="form-label col-sm-12">Start Date</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control " name="dateFrom" value="{{$schedule->dateFrom}}">
                        </div>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="input3"  class="form-label col-sm-12">End Date</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control " name="dateTo" value="{{$schedule->dateTo}}">
                        </div>
                    </div>

                    
                    <div class="col-lg-12 form-group">
                        <button type="submit" class="btn btn-default pull-right">Update</button>
                    </div> 
                  </form>
                    
                </div>
          </div>
        </div>
    </div>

@endsection()