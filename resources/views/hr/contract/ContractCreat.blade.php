@extends('MasterTemplate.hr')

@section('head')
<style>
        .img-resize
        {
            height: 400px;
            width: 400px;
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
    Contract Registration
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
  
  <div class="row">
    <div class="col-lg-12">
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session()->get('message') }}
            </div>
        @endif
    </div>
  </div>

    <div class="container col-md-5 text-center">
        <img class="img-responsive img-rounded img-resize"src="{{asset('img/Worker ID')}}/{{$worker->idPicture}}">
        <h1>{{$worker->firstName}} {{$worker->lastName}}</h2>
        <hr class="hrStyle">
    </div>
    <div class="col-md-7">
        <div class="panel panel-default">
            <div class="panel-title panel-warning">
              Worker Profile Information
            </div>
            <div class="panel-body table-responsive">
                <table id="example0" class="table display">
                    <thead>
                        <tr>
                            <th>Skill</th>
                            <th>{{$worker->skill->name}}</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>Section</th>
                            <th>{{$worker->section->name}}</th>
                        </tr>
                    </thead>
                    <thead>
                        <tr>
                            <th>Education Attainment</th>
                            <th>{{$worker->education->name}}</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-7">
      <div class="panel panel-default">
        <div class="panel-title panel-warning">
          Last Registered Contract
        </div>
        <div class="panel-body table-responsive">
            <table id="contract04" class="table display">
                <thead>
                    <tr>
                        <th>Duration</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        
                    </tr>
                </thead>     
                <tbody>
                    @if($contract)
                      @foreach($contract as $contracts)
                        @if($contracts->worker_id == $worker->id)
                          <?php $lastD = $contracts->duration?>
                          <?php $lastS = $contracts->startingDate?>
                          <?php $lastE = $contracts->expiryDate?>
                      @endif
                      @endforeach
                      <tr>
                        <td>{{$lastD}} Days</td>
                        <td>{{$lastS}}</td>
                        <td>{{$lastE}}</td>
                      </tr>
                    @endif 
              </tbody>
            </table>
        </div>
      </div>
    </div>

    
    <div class="col-md-7">
            <div class="panel panel-default">
              <div class="panel-title panel-info">
                Contract Registration Form
              </div>
                  <div class="panel-body">
                    <form class="form-horizontal" action="/hrContract" method="POST" enctype="multipart/form-data">
                      {{@csrf_field()}}
                      
                      <div class="form-group">
                        <label class="col-sm-2 control-label form-label">Start Date</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" name="startDate">
                        </div>
                      </div>
      
                      <div class="form-group">
                        <label class="col-sm-2 control-label form-label">End Date</label>
                        <div class="col-sm-10">
                          <input type="date" class="form-control" name="endDate">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="col-sm-10">
                          <input type="hidden" class="form-control" name="id" value="{{$worker->id}}">
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="panel panel-default">
                  
                          <div class="panel-title">
                            Upload Contract Scanned Photo
                          </div>
                              <div class="panel-body">
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Contract Photo 1</label><br>
                                        <input type="file"  id="cp1"  name="cp1" style="display:none" required="required"/>
                                        <button type="button" class="btn btn-success"id="cp1-button"> <i class="fa fa-upload"> Upload Photo</i> </button>
                                        <span class="ml-2" id="cp1-text" >No file chosen, yet.</span>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label class="form-label">Contract Photo 2</label><br>
                                        <input type="file"  id="cp2"  name="cp2" style="display:none" required="required"/>
                                        <button type="button" class="btn btn-success"id="cp2-button"> <i class="fa fa-upload">   Upload Photo</i> </button>
                                        <span class="ml-2" id="cp2-text" >No file chosen, yet.</span>
                                    </div>
                                    
                              </div>
                        </div>
                    </div>

                      <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                          <button type="submit" class="btn btn-default btn-lg pull-right">Regiter Contract</button>
                        </div>
                      </div>
                    </form>
                  </div>
            </div>
          </div>
          
@endsection()

@section('jsScript')
  <script>
    const realFileBtn = document.getElementById("cp1");
    const customBtn = document.getElementById("cp1-button");
    const customTxt = document.getElementById("cp1-text");

    const realFileBtn2 = document.getElementById("cp2");
    const customBtn2 = document.getElementById("cp2-button");
    const customTxt2 = document.getElementById("cp2-text");

  
    customBtn.addEventListener("click", function() 
    {
        realFileBtn.click();
    });

    customBtn2.addEventListener("click", function() 
    {
        realFileBtn2.click();
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

    
    
  </script>
@endSection()