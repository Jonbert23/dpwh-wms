@extends('MasterTemplate.hr')

@section('head')
<style>
        .img-resize
        {
            height: 250px;
            width: 250px;
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
    <div class="row ">
       Update Worker Profile
    </div>
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

<div class="panel panel-default">
                        
    <div class="panel-body">
        <div class="row">
            <div class="col-md-3">
                <img class="img-responsive img-rounded" src="{{asset('img/Worker ID')}}/{{$worker->idPicture}}" width="100%">
            </div>

            <div class="col-md-9">
                <table class="table display">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>{{$worker->firstName}} {{$worker->lastName}}</th>
                            <th></th><th></th><th></th><th></th><th></th><th></th>
                        </tr>
                    
                    </thead>
                    <thead>
                        <tr>
                            <th>ID Number</th>
                            <th>{{$worker->idNumber}}</th>
                            <th></th><th></th><th></th><th></th><th></th><th></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th>{{$worker->section->name}}</th>
                            <th></th><th></th><th></th><th></th><th></th><th></th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>Skill</th>
                            <th>{{$worker->skill->name}}</th>
                            <th></th><th></th><th></th><th></th><th></th><th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="container col-md-12">
    <div class="row">
      <div class="panel panel-default">
        <div class="panel-title">
          Worker Profile Update Form
        </div>
            <div class="panel-body">
            <form method="POST"  action="/hrWorker/{{$worker->id}}" enctype="multipart/form-data" >
                {{@csrf_field()}}
                {{@methoD_field('PUT')}}
                <div class="col-lg-6 form-group">
                    <label for="input1" class="form-label">First Name</label>
                    <input type="text" class="form-control " name="firstName" value="{{$worker->firstName}}">
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input2" class="form-label">Last Name</label>
                    <input type="text" class="form-control " name="lastName" value="{{$worker->lastName}}">
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">ID Number</label>
                    <input type="text" class="form-control " name="idNumber" value="{{$worker->idNumber}}">
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Gender</label>
                    <select type="text" class="form-control " name="gender" value="{{$worker->gender}}" >
                        <option value="Male" @if('Male' == $worker->gender) selected @endif>Male</option>
                        <option value="Female" @if('Female' == $worker->gender) selected @endif>Female</option>
                    </select>
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Contact Number</label>
                    <input type="text" class="form-control " name="contactNumber" value="{{$worker->contactNumber}}">
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Higheist School Attainment</label>
                    <select type="text" class="form-control " name="education">
                        @if($education ?? '')
                            @foreach($education ?? '' as $educ)
                                <option value="{{$educ->id}}" @if($educ->name == $worker->education->name) selected @endif>{{$educ->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Skill</label>
                    <select type="text" class="form-control " name="skill">
                        
                        @if($skill)
                            @foreach($skill as $skills)
                                <option value="{{$skills->id}}" @if($skills->name == $worker->skill->name) selected @endif >{{$skills->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                {{-- <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Role</label>
                    <select type="text" class="form-control " name="role" id="roles" onchange="bawal();">
                        
                        @if($role)
                            @foreach($role as $roles)
                                <option value="{{$roles->id}}" @if($roles->name == $worker->role->name) selected @endif>{{$roles->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div> --}}
                {{-- <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Worker Status</label>
                    <select type="text" class="form-control " name="status">
                        <option value="0"@if($worker->status == 0) selected @endif>Unemployed</option>
                        <option value="1"@if($worker->status == 1) selected @endif>Employed</option>
                    </select>
                </div> --}}
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Section</label>
                    <select type="text" class="form-control " name="section">
                        
                        @if($section)
                            @foreach($section as $section)
                                <option value="{{$section->id}}" @if($section->name == $worker->section->name) selected @endif >{{$section->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                
               
                <div class="col-md-12">
                    <div class="panel panel-default">
              
                      <div class="panel-title">
                        Address
                      </div>
                          <div class="panel-body">
                                <div class="form-group col-md-6">
                                  <label class="form-label">Purok/Zone</label>
                                  <input type="text" class="form-control" name="zone" value="{{$w_address->zone}}">
                                </div>
                                <div class="form-group col-md-6">
                                  <label class="form-label">Barangay</label>
                                  <input type="text" class="form-control" name="barangay"  value="{{$w_address->barangay}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">City/Minicipality</label>
                                    <input type="text" class="form-control" name="city"  value="{{$w_address->city}}">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" name="zipCode" value="{{$w_address->zipCode}}">
                                </div>
                          </div>
                    </div>
                </div>

                <div class="col-lg-12 form-group">
                    <label for="input3"  class="form-label">Upload Id Picture</label>
                    <input type="file" class="form-control form-control-line " name="idPicture" value="{!! $worker->idPicture !!}" >
                </div>


                <div id="workerOnly">
                    {{-- ------------------------------------------------------------------Salary------------------------------------------------------------------------------------- --}}
                    <div class="col-md-12">
                        <hr class="hrStyle">
                    </div>

                    <div class="col-lg-6 form-group">
                        <h3>Worker Salary Information</h3>
                        <label for="input3"  class="form-label">Salary Amount Per Day</label>
                        <input type="number" class="form-control " name="salary" id="salary" value="{{$mySalary}}">
                    </div>

                     {{-- ------------------------------------------------------------------Leave------------------------------------------------------------------------------------- --}}
                    <div class="col-md-12">
                        <hr class="hrStyle">
                        <h3>Worker Leave Cridets</h3>
                    </div>
                     <div class="col-lg-6 form-group">
                       
                        <label for="input3"  class="form-label">Number of Leave Cridets/Hour</label>
                        <input type="number" class="form-control " name="leave" id="leave" value="{{$myCredit}}">
                    </div> 
                    <div class="col-lg-6 form-group">
                        <label for="input3"  class="form-label">Availability Date: Start</label>
                        <input type="date" class="form-control " name="Sleave" id="Sleave" value="{{$leaveStart}}">
                    </div> 

                    

                    <div class="col-lg-6 form-group">
                        <label for="input3"  class="form-label">Availability Date: End</label>
                        <input type="date" class="form-control " name="Eleave" id="Eleave" value="{{$leaveEnd}}">
                    </div> 

                                     
                    {{-- ------------------------------------------------------------------beneficial------------------------------------------------------------------------------------- --}}

                    <div class="col-md-12">
                        <hr class="hrStyle">
                        <h3>Worker Beneficial Monthly Payment</h3>
                    </div>
                    
                    <div class="col-lg-6 form-group">
                        <label for="input3"  class="form-label">Deduction Status</label>
                        <select type="text" class="form-control " name="deductionStatus">
                            <option value="1"@if($deductionStatus == 1) selected @endif>Active</option>
                            <option value="0"@if($deductionStatus == 0) selected @endif>Not Active</option>
                        </select>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="input3"  class="form-label">GSIS</label>
                        <input type="number" class="form-control " name="gsis" id="gsis" value="{{$myDeductionGsis}}">
                    </div>   
                    
                    <div class="col-lg-6 form-group">
                        <label for="input3"  class="form-label">PAG-IBIG</label> 
                        <input type="number" class="form-control " name="pagibig" id="pagibig"value="{{$myDeductionPagibig}}">
                    </div> 

                    <div class="col-lg-6 form-group" >
                        <label for="input3"  class="form-label">PHILHEALTH</label>
                        <input type="number" class="form-control " name="philhealth" id="philhealth" value="{{$myDeductionPhilHealth}}">
                        <br>
                        <br>
                    </div> 

                </div>
    
                <div class="col-lg-12 form-group">
                    <div class="col-md-5"></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-default btn-lg">Update Worker Profile</button></div>
                    <div class="col-md-5"></div>
                </div> 
      </div>
    </div>
  </div>
  <hr>
@endsection()

@section('jsScript')
    <script>
        function bawal()
        {
            var d = document.getElementById('roles');
            var sel = d.options[d.selectedIndex].value;

            if(sel == 1 || sel == 2)
            {
                document.getElementById('workerOnly').hidden = true;
            }
            if(sel == 3)
            {
                document.getElementById('workerOnly').hidden = false;
            }
        }
    </script>

    <script>
        var d = document.getElementById('roles');
        var role = d.options[d.selectedIndex].value;

        if(role == 1)
        {
            document.getElementById('workerOnly').hidden = true;
        }
        if(role == 2)
        {
            document.getElementById('workerOnly').hidden = true;
        }
        if(role == 4)
        {
            document.getElementById('workerOnly').hidden = true;
        }
    </script>
@endsection()