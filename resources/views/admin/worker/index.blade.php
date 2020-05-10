@extends('MasterTemplate.admin')

@section('head')
 <style>
    .row-even {
    background-color:#9bdcde;
    }
    .row-odd {
    background-color:#BDE3FB;
    }
 </style>
@endsection()

@section('header')
    All Registered Workers
@endsection()

@section('content')
   
    <div class="row">
        <div class="col-md-12 ">
        <ul class="topstats clearfix  row-even">
            <li class="col-xs-6 col-lg-4">
            <span class="title"> Total Number of Worker </span>
            <h3> <i> <img class="center" src="img/w-icon.png" height="30" alt="logo"></i> - {{$labor}}</h3>
            
            </li>
            <li class="col-xs-6 col-lg-4">
            <span class="title">Total Number of Admin</span>
            <h3><i> <img class="center" src="img/hr-icon.png" height="40" alt="logo"></i> - {{$admin}}</h3>
            
            </li>
            <li class="col-xs-6 col-lg-4">
            <span class="title ">Total Number of MPP</span>
            <h3>  <h3><i> <img class="center" src="img/e-icon.png" height="40" alt="logo"></i> - {{$mpp}}</h3>
            </li>
        </ul>
    </div>

    <div class="col-md-12">
        <br>
    </div>
   
    <div class="col-md-12">
        <div class="panel panel-default ">
          {{-- <div class="panel-title panel-info">
            All Rigestered Workers
          </div> --}}
          <div class="panel-body table-responsive">
              <table id="worker" class="table table-bordered text-capitalize">
                  <thead>
                      <tr>
                          <th>Name</th>
                          <th>ID Number</th>
                          <th>Section</th>
                          <th>Skill</th>
                          <th>Status</th>
                          <th>Role</th>
                          <th>Action</th>
                      </tr>
                  </thead>     
                  <tbody>
                        @if($worker)
                            @foreach($worker as $workers)
                            <tr>
                                <td>{{$workers->firstName}} {{$workers->lastName}}</td>
                                <td>{{$workers->idNumber}}</td>
                                <td>{{$workers->section->name}}</td>
                                <td>{{$workers->skill->name}}</td>
                                <td>{{$workers->status == 1?'Employed':'Unemployed'}}</td>
                                <td>{{$workers->role->name}}</td>
                                <td>
                                    <a href="{{route('adminWorker.edit', $workers->id)}}">
                                        <button class="btn btn-default btn-icon col-md-4">
                                            <i class="fa fa-edit"></i>
                                        </button> 
                                    </a>
                                    
                                    <form class="col-md-6" action="/adminWorkerView" method="POST">
                                        {{@csrf_field()}}
                                        <input type="hidden" name="id" value="{{$workers->id}}">
                                        <button type="submit" class="btn btn-default col-md-12"><i class="fa fa-eye"></i></button>
                                    </form>      
                                </td>
                            </tr>
                            @endforeach
                        @endif  
                </tbody>
              </table>
          </div>
        </div>
    </div>
@endsection()

@section('jsScript')

    <script>
    $(document).ready(function() {
        $('#worker').DataTable();
    } );
    </script>  
@endsection()