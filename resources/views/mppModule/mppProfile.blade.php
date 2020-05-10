@extends('MasterTemplate.mpp')

@section('head')
    <style>
        .img-resize
        {
            height: 450px;
            width: 450px;
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
    View Worker Profile
@endsection()


@section('content')

<div class="container col-md-5 text-center">
    <img class="img-responsive img-rounded img-resize"src="{{asset('img/Worker ID')}}/{{$findWorker->idPicture}}">
    <h1>{{$findWorker->firstName}} {{$findWorker->lastName}}</h2>
    <hr class="hrStyle">
</div>


    <div class="col-md-7">
        <div class="panel panel-default">
          <div class="panel-title">
            My Profile
          </div>
          <div class="panel-body table-responsive">
              <table id="example0" style="border: none;" class="table display">
                  <thead>
                        <tr >
                            <th>ID Number</th>
                            <th>{{$findWorker->idNumber}}</th>
                        </tr>
                    </thead> 
                  <thead>
                    <tr>
                        <th>Gender</th>
                        <th>{{$findWorker->gender}}</th>
                    </tr>
                </thead> 
                <thead>
                    <tr>
                        <th>Contact Number</th>
                        <th>{{$findWorker->contactNumber}}</th>
                    </tr>
                </thead>    
                <thead>
                    <tr>
                        <th>Skill</th>
                        <th>{{$findWorker->skill->name}}</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>Section</th>
                        <th>{{$findWorker->section->name}}</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>Education</th>
                        <th>{{$findWorker->education->name}}</th>
                    </tr>
                </thead>

                <thead>
                    <tr>
                        <th>Address</th>
                        <th>{{$workerAdd->zone}} {{$workerAdd->barangay}}, {{$workerAdd->city}} {{$workerAdd->zipCode}}</th>
                    </tr>
                </thead>
               
                <thead>
                    <tr>
                        <th>Role</th>
                        <th>{{$findWorker->role->name}}</th>
                    </tr>
                </thead>
                <thead>
                    <tr>
                        <th>Status</th>
                        <th>{{$findWorker->status==1?'Employed':'Unemployed'}}</th>
                    </tr>
                </thead>
              </table>
          </div>
        </div>
      </div>   
    
@endSection()
