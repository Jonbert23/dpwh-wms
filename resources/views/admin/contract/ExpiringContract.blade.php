@extends('MasterTemplate.admin')

@section('header')
    Expiring Contract
@endsection()

@section('content')
<div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-title panel-info">
      All Registered Contract
      </div>
      <div class="panel-body table-responsive">
          <table id="contract04" class="table display">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>ID Number</th>
                      <th>Skill</th>
                      <th>Section</th>
                      <th>Duration</th>
                      <th>Epire date</th>
                      <th>Action</th>
                  </tr>
              </thead>     
              <tbody>
                  @if($contract)
                    @foreach($contract as $contracts)
                        @if($contracts->remarks == 0)
                        <tr>
                            <td>{{$contracts->worker->firstName}} {{$contracts->worker->lastName}}</td>
                            <td>{{$contracts->worker->idNumber}}</td>
                            <td>{{$contracts->worker->skill->name}}</td>
                            <td>{{$contracts->worker->section->name}}</td>
                            <td>{{$contracts->duration}} Days</td>
                            <td>{{$contracts->expiryDate}}</td>
                            <td><a href="/create/contract/{{$contracts->worker->id}}" class="btn btn-default" > Give New Contract</a></td>
                        </tr>
                        @endif
                    @endforeach
                  @endif 
            </tbody>
          </table>
      </div>
    </div>
  </div>
@endsection