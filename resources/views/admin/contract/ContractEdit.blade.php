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
    Update Contract
@endsection()

@section('content')


<div class="modal fade" id="dtr" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Contract Photo</h5>
          {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button> --}}
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="/UpdateContractPhoto" method="POST" enctype="multipart/form-data">
            {{@csrf_field()}}
            <div class="form-group col-md-12">
                <label class="form-label">Choose Photo to Upload</label><br>
                <input type="file"  id="cp1"  name="cp1" style="display:none" required="required"/>
                <button type="button" class="btn btn-success" id="cp1-button"> <i class="fa fa-upload"> Upload Photo</i> </button>
                <span class="ml-2" id="cp1-text" >No file chosen, yet.</span>
            </div>
           
            <input type="hidden" class="form-control"  name="cp" id="cp">
            <div class="form-group">
              <div class="col-md-12">
                <button type="submit" class="btn btn-default btn-block">Update Photo</button>
              </div>
            </div>
  
          </form>   
        </div>
        <div class="modal-footer">
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
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
              @if (session()->has('unaccepted'))
              <div class="alert alert-danger">
                  {{session()->get('unaccepted')}}
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
      <div class="panel-title panel-info">
        Contract Registration Form
      </div>
          <div class="panel-body">
            <form class="form-horizontal" action="/adminContract/{{$contract->id}}" method="POST">
                {{@csrf_field()}}
                {{@methoD_field('PUT')}}
              
              <div class="form-group">
                <label class="col-sm-2 control-label form-label">Start Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="startDate" value="{{$contract->startingDate}}">
                </div>
              </div>

              <div class="form-group">
                <label class="col-sm-2 control-label form-label">End Date</label>
                <div class="col-sm-10">
                    <input type="date" class="form-control" name="endDate" value="{{$contract->expiryDate}}">
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-10">
                  <input type="hidden" class="form-control" name="id" value="{{$worker->id}}">
                  <input type="hidden" class="form-control" name="contractId" value="{{$contract->id}}">
                </div>
              </div>

              

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default pull-right">Update Contract</button>
                </div>
              </div>
            </form>
            <hr>
            <h4>Contract Photo</h4>
            <div class="col-md-12">
                @foreach($contractphoto as $cp)
                  @if($cp->contract_id == $contract->id )
                      <div class="col-md-6">
                          <img class="img-responsive img-rounded img-resize-c" src="{{asset('contract')}}/{{$cp->photo}}">
                          <br>
                          <button type="button" class="btn btn-primary btn-block " data-toggle="modal" data-target="#dtr" data-cp="{{$cp->id}}">
                            Update Photo
                          </button>
                      </div>
                  @endif
                @endforeach
                <div class="col-md-6">

                </div>
            </div>
          </div>
    </div>
  </div>
@endsection()

@section('jsScript')
    <script>
        $('#dtr').on('show.bs.modal', function(event)
        {
            var button = $(event.relatedTarget)
            var id = button.data('cp')

            var modal = $(this)
            modal.find('.modal-body  #cp').val(id)
        })
    </script>

<script>
    const realFileBtn = document.getElementById("cp1");
    const customBtn = document.getElementById("cp1-button");
    const customTxt = document.getElementById("cp1-text");

    customBtn.addEventListener("click", function() 
    {
        realFileBtn.click();
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
  </script>
@endsection()