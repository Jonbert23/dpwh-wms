@extends('MasterTemplate.hr')

@section('header')
    Create Schedule
@endsection()

@section('content')


 {{--Work Insert Modal ----------------------------------------------------------------------------------------------------------}} 
 <div class="modal fade" id="workModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Work Name</h4>
        </div>
            <div class="modal-body">
                <form action="/adminWork" method="POST">
                    {{@csrf_field()}}
                    <div class="form-group">
                        <label for="input1" class="form-label">Work Name</label>
                        <input type="text" class="form-control" name="WorkName">
                    </div>
                             
                    <button type="submit" class="btn btn-default pull-right">Submit</button>
                </form>
            </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
</div>
{{-- End Work Insert Modal ----------------------------------------------------------------------------------------------------------}}

{{-- Location Insert Modal ----------------------------------------------------------------------------------------------------------}}
<div class="modal fade" id="locationModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Add New Location Address</h4>
        </div>
        <div class="modal-body">
            <form action="/adminLocation" method="POST">
                {{@csrf_field()}}
                <div class="form-group">
                    <label for="input1" class="form-label">Poruk/Zone Name</label>
                    <input type="text" class="form-control"  name="Zone">
                </div>
                <div class="form-group">
                    <label for="input2" class="form-label">Barangay Name</label>
                    <input type="text" class="form-control"  name="Barangay">
                </div>
                <div class="form-group">
                    <label for="input3"  class="form-label">City/Municipality Name</label>
                    <input type="text" class="form-control"  name="CityMunicipality">
                </div>
                <button type="submit" class="btn btn-default pull-right">Submit</button>
            </form>
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
</div>
{{-- End Location Insert Modal ----------------------------------------------------------------------------------------------------------}}

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
             Create Schedule Form
            </div>
                <div class="panel-body">
                <form method="POST"  action= "/hrSchedule" enctype="multipart/form-data" >
                    {{@csrf_field()}}
                    <div class="col-lg-12 form-group">
                        <label for="input3"  class="form-label col-sm-11">Task Name</label>

                        <div class="col-sm-11">
                             <select type="text" class="form-control" name="workName" >
                            <option disabled selected>Select Task Name</option>
                            @if($work)
                                @foreach($work as $works)
                                    <option value="{{$works->id}}">{{$works->name}}</option>
                                @endforeach
                            @endif
                        </select>
                        </div>
                       
                        <button type="button" class="btn btn-default btn-icon col-sm-1" data-toggle="modal" data-target="#workModal">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                   
                    <div class="col-lg-12 form-group">
                        <label for="input3"  class="form-label col-sm-12">Designation</label>

                        <div class="col-sm-11">
                            <select type="text" class="form-control " name="designation" >
                                <option></option>
                                @if($location)
                                    @foreach($location as $locations)
                                        <option value="{{$locations->id}}">{{$locations->zoneName}} {{$locations->barangayName}}, {{$locations->cityName}}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                        <button type="button" class="btn btn-default btn-icon col-sm-1" data-toggle="modal" data-target="#locationModal">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>

                    <div class="col-lg-12 form-group">
                        <label for="input3"  class="form-label col-sm-12">MPP</label>
                        <div class="col-sm-12">
                            <select type="text" class="form-control " name="mpp" >
                            @if($worker)
                                @foreach($worker as $workers)
                                    @if($workers->role_id == 2)
                                        
                                        


                                            @foreach($schedule as $sched)
                                            @if($sched->mpp == $workers->id)
                                                <?php 
                                                    $lastSchedId = $sched->id;
                                                    $exist = 1;
                                                ?>
                                            @endif
                                            @endforeach

                                            @if($exist == 1)
                                                @if($dateNow >= \App\Schedule::find($lastSchedId)->dateTo)
                                                    <option value="{{$workers->id}}">{{$workers->firstName}} {{$workers->lastName}} </option>
                                                @endif
                                            @endif

                                            @if($exist == 0)
                                                <option value="{{$workers->id}}">{{$workers->firstName}} {{$workers->lastName}} </option>
                                            @endif
                                            
                                            <?php 
                                                $exist = 0;
                                            ?>
                                        @endif 

                                   
                                @endforeach
                            @endif
                        </select>

                        </div>
                        
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="input3"  class="form-label col-sm-12">Start Date</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control " name="dateFrom">
                        </div>
                        
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="input3"  class="form-label col-sm-12">End Date</label>
                        <div class="col-sm-12">
                            <input type="date" class="form-control " name="dateTo">
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="panel">
                            <div class="panel-title">
                                Unscheduled Workers
                            </div>
                            <div class="panel-body table-responsive">
                            <table id="select" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>Select</th>
                                        <th>Name</th>
                                        <th>ID Number</th>
                                        <th>Skill</th>
                                        <th>Section</th>
                                        <th>Education Attainment</th>
                                    </tr>
                                </thead>     
                                <tbody>
                                    @if($worker)
                                        @foreach($worker as $workers)
                                            @if($workers->role_id == 3)
                                                @foreach($schedule as $sched)
                                                    @if($sched->worker_id == $workers->id)
                                                        <?php 
                                                            $lastSchedId = $sched->id;
                                                            $exist = 1;
                                                        ?>
                                                    @endif
                                                @endforeach

                                                @if($exist == 1)
                                                    @if($dateNow >= \App\Schedule::find($lastSchedId)->dateTo)
                                                        <tr>
                                                            <td width="5">
                                                                <div class="col-md-12">
                                                                    <div class="col-md-4"></div>
                                                                    <div class="col-md-2"><input class="checkbox" type="checkbox"  name="workers[]" value="{{$workers->id}}" > </div>
                                                                    <div class="col-md-5"></div>
                                                                </div>
                                                            </td>
                                                            <td>{{$workers->firstName}} {{$workers->lastName}}</td>
                                                            <td>{{$workers->idNumber}}</td>
                                                            <td>{{$workers->skill->name}}</td>
                                                            <td>{{$workers->section->name}}</td>
                                                            <td>{{$workers->education->name}}</td>
                                                        </tr> 
                                                    @endif
                                                @endif

                                                @if($exist == 0)
                                                    <tr>
                                                        <td width="5">
                                                            <div class="col-md-12">
                                                                <div class="col-md-4"></div>
                                                                <div class="col-md-2"><input class="checkbox" type="checkbox"  name="workers[]" value="{{$workers->id}}" > </div>
                                                                <div class="col-md-5"></div>
                                                            </div>
                                                        </td>
                                                        <td>{{$workers->firstName}} {{$workers->lastName}}</td>
                                                        <td>{{$workers->idNumber}}</td>
                                                        <td>{{$workers->skill->name}}</td>
                                                        <td>{{$workers->section->name}}</td>
                                                        <td>{{$workers->education->name}}</td>
                                                    </tr> 
                                                @endif
                                                
                                                <?php 
                                                    $exist = 0;
                                                ?>
                                                @endif  
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>     
                        </div>
                    </div>
                    <div class="col-lg-12 form-group">
                        <button type="submit" class="btn btn-default pull-right btn-lg">Create Schedule</button>
                    </div> 
                  </form>
                    
                </div>
          </div>
        </div>
    </div>

@endsection()

@section('jsScript')
<script>      
     $(document).ready(function() {
        $('#select').DataTable();
    } );
</script>    

@endsection()