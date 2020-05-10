@extends('MasterTemplate.admin')

@section('header')
    Upload Attendace File
@endSection()

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


<div class="modal fade" id="dtr" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">DTR Filter</h5>
        {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button> --}}
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="/adminSearchDTR" method="POST">
          {{@csrf_field()}}
          <div class="form-group">
            <label class="col-sm-2 control-label form-label">Month</label>
            <div class="col-sm-10">
              <select name="month" id="" class="col-md-12">
                <option value="1" @if($monthNow == 1) selected @endif>January</option>
                <option value="2"  @if($monthNow == 2) selected @endif>Febuary</option>
                <option value="3" @if($monthNow == 3) selected @endif>March</option>
                <option value="4"  @if($monthNow == 4) selected @endif>April</option>
                <option value="5" @if($monthNow == 5) selected @endif>May</option>
                <option value="6" @if($monthNow == 6) selected @endif>June</option>
                <option value="7" @if($monthNow == 7) selected @endif>July</option>
                <option value="8" @if($monthNow == 8) selected @endif>August</option>
                <option value="9" @if($monthNow == 9) selected @endif>September</option>
                <option value="10" @if($monthNow == 10) selected @endif>October</option>
                <option value="11" @if($monthNow == 11) selected @endif>November</option>
                <option value="12" @if($monthNow == 12) selected @endif>December</option>
            </select>
            </div>
          </div>
  
          <div class="form-group">
            <label class="col-sm-2 control-label form-label">Year</label>
            <div class="col-sm-10">
              <select name="year" id="" class="col-md-12" >
                @for($i = 2015; $i <= $yearNow; $i++)
                <option value="{{$i}}" @if($i == $yearNow)selected @endif>{{$i}}</option>
                @endfor
              </select>
            </div>
          </div>
         
          <div class="form-group">
            <label class="col-sm-2 control-label form-label">Quarter</label>
            <div class="col-sm-10">
              <select name="quarter" class="col-sm-12">
                <option value="1">Date 1-15</option>
                <option value="2">Date 16-31</option>
                <option value="3">Whole Month</option>
              </select>
            </div>
          </div>
       
          <input type="hidden" class="form-control"  name="workerId" id="workerId">
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-default btn-block">Submit</button>
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



    {{-- <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-title">
          Upload excel attendance file from the biometric
        </div>
            <div class="panel-body">
              <form class="form-inline" action="/adminStoreAttedance" method="POST"  enctype="multipart/form-data">
                {{@csrf_field() }}
                <div class="col-md-9">
                    <input type="file"  id="real-file"  name="attendanceUpload" style="display:none"/>
                    <button type="button" class="btn btn-success"id="custom-button"> <i class="fa fa-upload"> Upload Excel Attendance </i> </button>
                    <span class="ml-2" id="custom-text" >No file chosen, yet.</span>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-default">Upload File</button>
                </div>
                
              </form>
            </div>
      </div>
    </div> --}}
<div class="row">
  <div class="col-md-12">
    <div class="panel panel-default">

      <div class="panel-title">
        View Workers DTR
      </div>

      <div class="panel-body">
        <table class="table table-bordered table-striped" id="DTRIndex">
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
                    @if($workers->role_id == 3)
                        <tr>
                            <td>{{$workers->firstName}} {{$workers->lastName}}</td>
                            <td>{{$workers->idNumber}}</td>
                            <td>{{$workers->section->name}}</td>
                            <td>{{$workers->skill->name}}</td>
                            <td>
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#dtr" data-workers="{{$workers->id}}">
                                  View DTR
                                </button>
                            </td>
                    @endif
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
      const realFileBtn = document.getElementById("real-file");
      const customBtn = document.getElementById("custom-button");
      const customTxt = document.getElementById("custom-text");

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

  <script>
    $(document).ready(function() {
        $('#DTRIndex').DataTable();
    } );
  </script>

  <script>
    $('#dtr').on('show.bs.modal', function(event)
    {
        var button = $(event.relatedTarget)
        var id = button.data('workers')

        var modal = $(this)
        modal.find('.modal-body  #workerId').val(id)
    })
  </script>
    
@endsection()