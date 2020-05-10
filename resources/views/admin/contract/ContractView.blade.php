@extends('MasterTemplate.admin')

@section('head')
    <style>
        .img-resize
        {
            height: 450px;
            width: 450px;
            margin: auto;
        }
        .img-resize-c
        {
            height: 200px;
            width: 200px;
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
    Worker Contaract Details
@endsection()


@section('content')

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

    <div class="panel panel-default">
        <div class="panel-title panel-info">
            Active Contracts
        </div>                          
        <div class="panel-body">
        
            @if($contract)
            @foreach($contract as $contracts)
                @if($worker->id == $contracts->worker_id && $now < $contracts->expiryDate)
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body table-responsive">
                                <table id="contract04" class="table display">
                                    <thead>
                                        <tr>
                                            <th>Duration</th>
                                            <th>Starting date</th>
                                            <th>End date</th>
                                            <th>Remarks</th>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
        
                                        <tr>
                                            <td>{{$contracts->duration}} Days</td>
                                            <td>{{$contracts->startingDate}}</td>
                                            <td>{{$contracts->expiryDate}}</td>
                                            <td>{{$contracts->expiryDate > $now ? 'Active':'Not Active'}}</td>
                                            <td>
                                                <a href="/edit/contract/{{$contracts->worker->id}}/{{$contracts->id}}">
                                                    <button type="button" class="btn btn-default btn-icon ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>
                                            </td>
        
                                        </tr>
        
                                    </tbody>
                                </table>
                                <hr class="hrStyle">
                                <h3>Contract Photo</h3>
                                <div class="col md-12">
                                    @foreach($conPhoto as $cp)
                                        @if($contracts->id == $cp->contract_id)
                                            <div class="col-md-6">
                                                <img class="img-responsive img-rounded img-resize-c" src="{{asset('contract')}}/{{$cp->photo}}"> 
                                            </div>
                                        @endif 
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            @endif 
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-title panel-danger">
            ExpiredContracts
        </div>                         
        <div class="panel-body">
        
            @if($contract)
            @foreach($contract as $contracts)
                @if($worker->id == $contracts->worker_id && $now > $contracts->expiryDate)
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-body table-responsive">
                                <table id="contract04" class="table display">
                                    <thead>
                                        <tr>
                                            <th>Duration</th>
                                            <th>Starting date</th>
                                            <th>End date</th>
                                            <th>Remarks</th>
                                            <td>Action</td>
                                        </tr>
                                    </thead>
                                    <tbody>
        
                                        <tr>
                                            <td>{{$contracts->duration}} Days</td>
                                            <td>{{$contracts->startingDate}}</td>
                                            <td>{{$contracts->expiryDate}}</td>
                                            <td>{{$contracts->expiryDate > $now ? 'Active':'Not Active'}}</td>
                                            <td>
                                                <a href="/edit/contract/{{$contracts->worker->id}}/{{$contracts->id}}">
                                                    <button type="button" class="btn btn-default btn-icon ">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </a>
                                            </td>
        
                                        </tr>
        
                                    </tbody>
                                </table>
                                <hr class="hrStyle">
                                <h3>Contract Photo</h3>
                                <div class="col md-12">
                                    @foreach($conPhoto as $cp)
                                        @if($contracts->id == $cp->contract_id)
                                            <div class="col-md-6">
                                                <img class="img-responsive img-rounded img-resize-c" src="{{asset('contract')}}/{{$cp->photo}}"> 
                                            </div>
                                        @endif 
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
            @endif 
        </div>
    </div>
@endSection()

@section('jsScript')
@endsection()