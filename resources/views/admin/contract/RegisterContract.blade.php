@extends('MasterTemplate.admin')

@section('header')
    Register Contract
@endsection()
@section('content')

<div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-title  panel-warning">
        Registered Workers with no contract
      </div>
      <div class="panel-body table-responsive">
          <table id="contract01" class="table display">
              <thead>
                  <tr>
                      <th>Name</th>
                      <th>ID Number</th>
                      <th>Skill</th>
                      <th>Section</th>
                      <th>Eduaction Attainment</th>
                      <th>Action</th>
                  </tr>
              </thead>     
              <tbody>
                @if($worker  && $contract)
                    @foreach($worker as $workers)
                        @if($workers->role->name == "Worker" )
                            <tr>
                                <td>{{$workers->firstName}} {{$workers->lastName}}</td>
                                <td>{{$workers->idNumber}}</td>
                                <td>{{$workers->skill->name}}</td>
                                <td>{{$workers->section->name}}</td>
                                <td>{{$workers->education->name}}</td>
                                <td><a href="/create/contract/{{$workers->id}}" class="btn btn-default " > Give Contract</a></td>
                            </tr> 
                        @endif  
                    @endforeach
                @endif 

                {{-- @if($contract)
                    @foreach($contract as $contrcats)
                        @if()
                            
                        @endif
                    @endforeach
                @endif --}}

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
         $('#contract01').DataTable();
    } );
</script> 
<script>
    $(document).ready(function() 
    {
        $('#contract02').DataTable();
    } );
</script>
@endsection()