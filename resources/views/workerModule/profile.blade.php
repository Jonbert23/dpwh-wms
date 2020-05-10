@extends('MasterTemplate.worker')

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

      {{-- <div class="col-md-12">
        <div class="panel panel-default">
    
            <div class="panel-title">
                Worker Contract Information
            </div>
    
            <div class="panel-body">
                <table class="table table-bordered table-striped" id="salaryIndex">
                    <thead>
                        <tr>
                            <th>Duration</th>
                            <th>Start Date</th>
                            <th>Expire Date</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody class="text-capitalize">
                        @foreach($contract as $contracts)
                            @if($findWorker->id == $contracts->worker_id)
                                <tr>
                                <td>{{$contracts->duration}} Days</td>
                                <td>{{$contracts->startingDate}}</td>
                                <td>{{$contracts->expiryDate}}</td>
                                @if($dateNow <= $contracts->expiryDate)
                                    <td>Active</td>
                                @endif
                                @if($dateNow > $contracts->expiryDate)
                                    <td>Void/Not Active</td>
                                @endif
                               
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div> --}}

    <div class="col-md-12">
        <div class="panel panel-default">
    
            <div class="panel-title">
                My Salary Information
            </div>
    
            <div class="panel-body">
                <table class="table table-bordered table-striped" id="salaryIndex">
                    <thead>
                        <tr>
                            <th>Register Date</th>
                            <th>Salary Amount</th>
                        </tr>
                    </thead>
                    <tbody class="text-capitalize">
                        @foreach($salary as $sal)
                            @if($findWorker->id == $sal->worker_id)
                                <tr>
                                    <td>{{$sal->date}}</td>
                                    <td>{{$sal->salaryAmount}}</td>
                                </tr>
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
                My Beneficial Information
            </div>
    
            <div class="panel-body">
                <table class="table table-bordered table-striped" id="salaryIndex">
                    <thead>
                        <tr>
                            <th>Register Date</th>
                            <th>PHILHEALTH</th>
                            <th>GSIS</th>
                            <th>PAG-IBIG</th>
                            <th>Remark</th>
                        </tr>
                    </thead>
                    <tbody class="text-capitalize">
                        @foreach($deduction as $deductions)
                            @if($findWorker->id == $deductions->worker_id)
                                <tr>
                                    <td>{{$deductions->date}}</td>
                                    <td>{{$deductions->PHILHEALTH}}</td>
                                    <td>{{$deductions->GSIS}}</td>
                                    <td>{{$deductions->PAGIBIG}}</td>
                                    @if($deductions->status == 1)
                                        <td>Active</td>
                                    @endif
                                    @if($deductions->status == 0)
                                        <td>Void/Not Active</td>
                                    @endif
                                </tr>
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
                My Leave Cridet Information
            </div>
    
            <div class="panel-body">
                <table class="table table-bordered table-striped" id="salaryIndex">
                    <thead>
                        <tr>
                            <th colspan="2" class="text-center">Leave Credit</th>
                            <th colspan="2" class="text-center">Availability Date</th>
                           
                        </tr>
                        <tr>
                            <th>Total</th>
                            <th>Remaining</th>
                            <th>Start Date</th>
                            <th>End Date</th>
                        </tr>
                    </thead>
                    <tbody class="text-capitalize">
                        @foreach($leave as $leaves)
                            @if($findWorker->id == $leaves->worker_id)
                                <tr>
                                    <td>{{$leaves->totalLeave}}</td>
                                    <td>{{$leaves->remainingLeave}}</td>
                                    <td>{{$leaves->startDate}}</td>
                                    <td>{{$leaves->endDate}}</td>
                                    
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
      
    
@endSection()
