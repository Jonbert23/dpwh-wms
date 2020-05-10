@extends('MasterTemplate.admin')

@section('header')
    Reset Password
@endsection()

@section('content')

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
    <div class="col-md-12">
        <div class="panel panel-default">
  
          <div class="panel-title">
            View Workers DTR
          </div>
  
          <div class="panel-body">
            <table class="table table-bordered table-striped" id="resetIndex">
              <thead>
                <tr>
                    <th>Name</th>
                    <th>ID Number</th>
                    <th>Section</th>
                    <th>Skill</th>
                    <th>Action</th>
                </tr>
              </thead>
              <tbody class="text-capitalize">
                @if($worker)
                    @foreach($worker as $workers)
                         <tr>
                            <td>{{$workers->firstName}} {{$workers->lastName}}</td>
                            <td>{{$workers->idNumber}}</td>
                            <td>{{$workers->section->name}}</td>
                            <td>{{$workers->skill->name}}</td>
                            <td>
                                {{-- <a href="/resetPassword/{{$workers->id}}"  class="btn btn-default"> Reset Password </a> --}}
                                <form action="/resetPassword" method="POST">
                                    {{@csrf_field()}}
                                    {{@methoD_field('PUT')}}

                                    <input hidden="hidden" type="text" value="{{$workers->id}}" name="workerId">
                                    <input type="submit" class="btn btn-default" value="Reset Password">
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
</div>
    
@endsection()

@section('jsScript')

    <script>
    $(document).ready(function() {
        $('#resetIndex').DataTable();
    } );
    </script>
@endsection()