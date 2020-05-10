@extends('MasterTemplate.admin')
@section('head')
    <style>
        hr.hrStyle
        {
            border: none;
            border-top: 2px solid;
        }
    </style>
@endsection()

@section('header')
    <div class="row ">
        Register Worker
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


<div class="row">
    <div class="col-lg-12">
      <div class="panel panel-default ">

        {{-- <div class="panel-title">
          Worker Registration Form
        </div> --}}
            <div class="panel-body">
            <form method="POST"  action= "/adminWorker" enctype="multipart/form-data" >
                {{@csrf_field()}}
                <div class="col-md-12">
                    <h3>Worker Personal Information</h3>
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input1" class="form-label">First Name</label>
                    <input type="text" class="form-control " name="firstName" required="required" >
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input2" class="form-label">Last Name</label>
                    <input type="text" class="form-control " name="lastName" required="required" >
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">ID Number</label>
                    <input type="number" class="form-control " name="idNumber" required="required" >
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Gender</label>
                    <select type="text" class="form-control " name="gender" required="required" >
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                    </select>
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Contact Number</label>
                    <input type="number" class="form-control " name="contactNumber" required="required" >
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Higheist School Attainment</label>
                    <select type="text" class="form-control " name="education" required="required" >
                        <option ></option>
                        @if($education ?? '')
                            @foreach($education ?? '' as $educ)
                                <option value="{{$educ->id}}">{{$educ->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Skill</label>
                    <select type="text" class="form-control " name="skill" required="required" >
                        <option ></option>
                        @if($skill)
                            @foreach($skill as $skills)
                                <option value="{{$skills->id}}">{{$skills->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Section</label>
                    <select type="text" class="form-control " name="section" required="required" >
                        <option ></option>
                        @if($section)
                            @foreach($section as $section)
                                <option value="{{$section->id}}">{{$section->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-6 form-group">
                    <label for="input3"  class="form-label">Role</label>
                    <select type="text" class="form-control " name="role" id="roles" onchange="bawal();" required="required">
                        <option ></option>
                        @if($role)
                            @foreach($role as $roles)
                                <option value="{{$roles->id}}">{{$roles->name}}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
                <div class="col-lg-6 form-group">
                    <input type="hidden" class="form-control " name="status" value="1"   >
                </div>

                <div class="col-md-12">
                    <div class="panel panel-default">
              
                      <div class="panel-title">
                        Address
                      </div>
                          <div class="panel-body">
                                <div class="form-group col-md-6">
                                  <label class="form-label">Purok/Zone</label>
                                <input type="text" class="form-control" name="zone" required="required">
                                </div>
                                <div class="form-group col-md-6">
                                  <label class="form-label">Barangay</label>
                                  <input type="text" class="form-control" name="barangay" required="required">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">City/Minicipality</label>
                                    <input type="text" class="form-control" name="city" required="required">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" name="zipCode" required="required" >
                                </div>
                          </div>
                    </div>
                </div>

 
                <div class="col-lg-12 form-group">
                    <label for="input3"  class="form-label ">Upload Worker ID Picture</label><br>
                    {{-- <input type="file" class="form-control form-control-line" name="idPicture"> --}}
                    <input type="file"  id="dp"  name="idPicture" style="display:none"/>
                    <button type="button" class="btn btn-success"id="dp-button"> <i class="fa fa-upload"> Upload Photo</i> </button>
                    <span class="ml-2" id="dp-text" >No file chosen, yet.</span>
                    <br>
                </div>



{{-- ------------------------------------------------------------------CONTRACT------------------------------------------------------------------------------------- --}}
                <div id="workerOnly">
                    <div class="col-md-12">
                        <hr class="hrStyle">
                        <h3>Worker Contract</h3>
                    </div>

                    <div class="col-lg-6 form-group">
                        <label for="input3"  class="form-label">Contract Start Date</label>
                        <input type="date" class="form-control " name="startingDate" id="startDate">
                    </div>
                    <div class="col-lg-6 form-group">
                        <label for="input3"  class="form-label">Contract Expire Date</label>
                        <input type="date" class="form-control " name="expiryDate" id="endDate">
                    </div>

                    <div class="col-md-12">
                        <div class="panel panel-default">
                  
                          <div class="panel-title">
                            Upload Contract Scanned Photo
                          </div>
                              <div class="panel-body">
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Contract Photo 1</label><br>
                                        <input type="file"  id="cp1"  name="cp1" style="display:none"/>
                                        <button type="button" class="btn btn-success"id="cp1-button"> <i class="fa fa-upload"> Upload Photo</i> </button>
                                        <span class="ml-2" id="cp1-text" >No file chosen, yet.</span>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label class="form-label">Contract Photo 2</label><br>
                                        <input type="file"  id="cp2"  name="cp2" style="display:none"/>
                                        <button type="button" class="btn btn-success"id="cp2-button"> <i class="fa fa-upload">   Upload Photo</i> </button>
                                        <span class="ml-2" id="cp2-text" >No file chosen, yet.</span>
                                    </div>
                                    
                              </div>
                        </div>
                    </div>

    {{-- -------------------------------------------------------------------Salary------------------------------------------------------------------------------------- --}}
                    <div class="col-md-12">
                        <hr class="hrStyle">
                    </div>

                    {{-- <div class="col-lg-6 form-group">
                        <h3>Worker Salary Information</h3>
                        <label for="input3"  class="form-label">Salary Amount Per Day</label>
                        <input type="number" class="form-control " name="salary" id="salary">
                    </div> --}}

                    <div class="col-lg-6 form-group">
                        <label for="input3"  class="form-label">Monthly Salary Rate</label>
                        <select type="text" class="form-control " name="salary"  id="salary">
                            <option selected="selected" disabled="disabled">Select Salary Rate</option>
                            <option value="11551">P 11,551</option>
                            <option value="12276">P 12,27</option>
                            <option value="13019">P 13,019</option>
                            <option value="13807">P 13,807</option>
                            <option value="14641">P 14,641</option>
                            <option value="15542">P 15,542</option>
                            <option value="16458">P 16,458</option>
                            <option value="17505">P 17,505</option>
                            <option value="18784">P 18,784</option>
                            <option value="20219">P 20,219</option>
                            <option value="22316">P 22,316</option>
                            <option value="24459">P 24,459</option>
                            <option value="26754">P 26,754</option>
                            <option value="29277">P 29,277</option>
                            <option value="32053">P 32,053</option>
                        </select>
                    </div>

    {{-- ------------------------------------------------------------------Leave------------------------------------------------------------------------------------- --}}
                    
                    <div id="leaveField">
                        <div class="col-md-12">
                            <hr class="hrStyle">
                            <h3 class="col-md-11" style="margin-top: -10px; margin-top: -7px;" >Worker Leave Cridets</h3>
                            <button type="button" class="btn btn-info col-md-1" onclick="hideLF();" >
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                        <div class="col-lg-6 form-group">
                            
                            <label for="input3"  class="form-label">Number of Leave Cridets/Hour</label>
                            <input type="number" class="form-control " name="leave" id="leave">
                        </div>
                        <div class="col-lg-6 form-group">
                            <label for="input3"  class="form-label">Availability Date: Start</label>
                            <input type="date" class="form-control " name="Sleave" id="Sleave">
                        </div> 
                        <div class="col-lg-6 form-group">
                           
                        </div> 
                        <div class="col-lg-6 form-group">
                            <label for="input3"  class="form-label">Availability Date: End</label>
                            <input type="date" class="form-control " name="Eleave" id="Eleave">
                        </div> 
                    </div>
                   
    {{-- ------------------------------------------------------------------beneficial------------------------------------------------------------------------------------- --}}
                    <div id="bf">
                        <div class="col-md-12">
                            <hr class="hrStyle">
                            <h3 class="col-md-11" style="margin-top: -10px; margin-top: -7px;">Worker Beneficial Monthly Payment</h3>
                            <button type="button" class="btn btn-info col-md-1" onclick="hideBF();" >
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
    
                        <div class="col-lg-6 form-group">
                            <label for="input3"  class="form-label">GSIS</label>
                            <input type="number" class="form-control " name="gsis" id="gsis" value="0">
                        </div>   
                        
                        <div class="col-lg-6 form-group">
                            <label for="input3"  class="form-label">PAG-IBIG</label> 
                            <input type="number" class="form-control " name="pagibig" id="pagibig" value="0">
                        </div> 
    
                        <div class="col-lg-6 form-group" >
                            <label for="input3"  class="form-label">PHILHEALTH</label>
                            <input type="number" class="form-control " name="philhealth" id="philhealth" value="0">
                            <br>
                            <br>
                        </div> 
                    </div>


                    <div class="col-md-12" id="LFButton">
                        <hr class="hrStyle">
    
                        <button type="button" class="btn btn-info col-md-1" onclick="unhideLF();" >
                            <i class="fa fa-plus"></i>
                        </button>
                        <label  style="font-size: 12px;" class="col-md-10 text-capitalize">Click to add worker leave cridet(If there is any)</label>
                    </div>
    
                    <div class="col-md-12" style="margin-top: 10px" id="BFButton">
                        <hr class="hrStyle" id="hrBF">
                        <button type="button" class="btn btn-info col-md-1" onclick="unhideBF();" >
                            <i class="fa fa-plus"></i>
                        </button>
                        <label  style="font-size: 12px;" class="col-md-10 text-capitalize">Click to add worker Beneficials(If there is any)</label>
                    </div>

                </div>


               
               
               
{{-- ------------------------------------------------------------------Button------------------------------------------------------------------------------------- --}}

                <div class="col-lg-12 form-group">
                    <div class="col-md-5"></div>
                    <div class="col-md-2"><button type="submit" class="btn btn-default btn-lg">Register Worker</button></div>
                    <div class="col-md-5"></div>
                </div> 
              </form>
                
            </div>
      </div>
    </div>
</div>

@endsection()

@section('jsScript')
    <script>
        function bawal()
        {
            var d = document.getElementById('roles');
            var sel = d.options[d.selectedIndex].value;

            if(sel == 1 || sel == 2 || sel == 4)
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
        document.getElementById('leaveField').hidden = true;
        document.getElementById('bf').hidden = true;
        document.getElementById('hrBF').hidden = true;
    </script>

    
    <script>
        function unhideLF()
        {
            document.getElementById('leaveField').hidden = false;
            document.getElementById('LFButton').hidden = true;
            document.getElementById('hrBF').hidden = false;
        }

        function unhideBF()
        {
            document.getElementById('bf').hidden = false;
            document.getElementById('BFButton').hidden = true;
        }

        function hideBF()
        {
            document.getElementById('bf').hidden = true;
            document.getElementById('BFButton').hidden = false;
        }

        function hideLF()
        {
            document.getElementById('leaveField').hidden = true;
            document.getElementById('LFButton').hidden = false;
            document.getElementById('hrBF').hidden = true;
        }
        
        document.getElementById('bf').hidden = true;
    </script>

    <script>
        const realFileBtn = document.getElementById("cp1");
        const customBtn = document.getElementById("cp1-button");
        const customTxt = document.getElementById("cp1-text");

        const realFileBtn2 = document.getElementById("cp2");
        const customBtn2 = document.getElementById("cp2-button");
        const customTxt2 = document.getElementById("cp2-text");

        const realFileBtn3 = document.getElementById("dp");
        const customBtn3 = document.getElementById("dp-button");
        const customTxt3 = document.getElementById("dp-text");
        
       

        customBtn.addEventListener("click", function() 
        {
            realFileBtn.click();
        });

        customBtn2.addEventListener("click", function() 
        {
            realFileBtn2.click();
        });

        customBtn3.addEventListener("click", function() 
        {
            realFileBtn3.click();
        });
  
  
        realFileBtn.addEventListener("change", function() 
        {
            if (realFileBtn.value) 
            {
                customTxt.innerHTML = realFileBtn.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
               
            } 
            else 
            {
                customTxt.innerHTML = "No file chosen, yet.";
            }
        });

        realFileBtn2.addEventListener("change", function() 
        {
            if (realFileBtn2.value) 
            {
                customTxt2.innerHTML = realFileBtn2.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
               
            } 
            else 
            {
                customTxt2.innerHTML = "No file chosen, yet.";
                
            }
        });

        realFileBtn3.addEventListener("change", function() 
        {
            if (realFileBtn3.value) 
            {
                customTxt3.innerHTML = realFileBtn3.value.match(/[\/\\]([\w\d\s\.\-\(\)]+)$/)[1];
                
            } 
            else 
            {
                customTxt3.innerHTML = "No file chosen, yet.";
                
            }
        });
        
    </script>

@endsection()