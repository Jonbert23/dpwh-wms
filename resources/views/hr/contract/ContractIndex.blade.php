@extends('MasterTemplate.hr')

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
    All Registered Contracts
@endsection()

@section('content')
<div class="row">
    <div class="col-md-12 ">
    <ul class="topstats clearfix  row-even">
        <li class="col-xs-6 col-lg-4">
        <span class="title"> Active Contracts </span>
        <h3> <i> <img class="center" src="img/contract.png" height="40" alt="logo"></i> - {{$all}}</h3>
        
        </li>
        <li class="col-xs-6 col-lg-4">
        <span class="title">This Month Expiring Contract</span>
        <h3><i> <img class="center" src="img/expire-contract.png" height="40" alt="logo"></i> - {{$expire}}</h3>
        
        </li>
        <li class="col-xs-6 col-lg-4">
        <span class="title ">This Month Registered Contract</span>
        <h3>  <h3><i> <img class="center" src="img/new-contract.png" height="40" alt="logo"></i> - {{$new}}</h3>
        </li>
    
    </ul>

</div>

  <div class="col-md-12">
    <div class="panel panel-default">
      {{-- <div class="panel-title panel-info">
      All Registered Contract
      </div> --}}
      <div class="panel-body table-responsive">
          <table id="contract04" class="table table-bordered">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>ID Number</th>
                      <th>Skill</th>
                      <th>Section</th>
                      <th>Number of Contract</th>
                  
                      <th>Action</th>
                  </tr>
              </thead>     
              <tbody>
                  @if($contract)
                    @foreach($worker as $workers)
                        @if($workers->role_id == 3)
                            <tr>
                                <td>{{$workers->firstName}} {{$workers->lastName}}</a></td>
                                <td>{{$workers->idNumber}}</td>
                                <td>{{$workers->skill->name}}</td>
                                <td>{{$workers->section->name}}</td>

                                @foreach($contract as $contracts)
                                    @if($workers->id == $contracts->worker_id)
                                        <?php $count = $count + 1?>
                                    @endif
                                @endforeach

                                <td>{{$count}} Registered Contracts</td>
                                
                                <td>
                                    <a href="/hrcreate/contract/{{$workers->id}}">
                                        <button type="button"  class="btn btn-default btn-icon ">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </a>
                                    <a href="/hrContract/{{$workers->id}}">
                                        <button type="button"  class="btn btn-default btn-icon ">
                                            <i class="fa fa-eye"></i>
                                        </button>
                                    </a>
                                </td>
                            </tr>
                        @endif
                        <?php $count = 0?>
                        
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
    $(document).ready(function() 
    {
        $('#contract04').DataTable();
    } );
    </script>
@endsection()