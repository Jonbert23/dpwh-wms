@extends('MasterTemplate.admin')

@section('head')
 <style>
    .row-even {
    background-color:#9bdcde;
    }
    .row-odd {
    background-color:#BDE3FB;
    }
    .img-resize
    {
        height: 50px;
        width: 50px;
    }
    .dropdown-menu{
      background-color: transparent;
      border: transparent;
      border: none;
    }
    .dropdown-menu .dropdown-item > li > a:hover {
      background-image: none;
      
      background-color: #000!important;
    }

    .navbar {
      background: none;
    }
    .dropdown-content a:hover {
        background-color: transparent;
    }
    .hrStyle
        {
            border: none;
            border-top: 2px solid;
        }
 </style>
@endsection()

@section('header')
    Grant Leave
@endsection()

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
  <div class="col-lg-12 text-capitalized">
      @if(session()->has('message'))
          <div class="alert alert-success">
              {{ session()->get('message') }}
          </div>
      @endif
  </div>
</div>

 <!-- Modal -->
  <div class="modal fade" id="leave" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
      <div class="modal-content">
        <div class="modal-header">
          <span class="modal-title">Grant Leave to </span  > <span class="modal-title" id="name"></span>
        </div>
        <div class="modal-body">
          <form class="form-horizontal" action="/adminStoreLeave" method="POST">
            {{@csrf_field()}}
            <div class="form-group">
              <label class="col-sm-3 control-label form-label">Start Date</label>
              <div class="col-sm-9">
                <input type="date" class="form-control" name="startDate" required="required">
              </div>
            </div>
           
            <input type="hidden" name="leaveId" id="workerId">

            <div class="form-group">
              <div class="col-sm-offset-3 col-sm-9">
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


<div class="col-md-12">
    <div class="panel panel-default">

      <div class="panel-title">
       Grant Leave
      </div>

      <div class="panel-body">
        <table class="table table-bordered table-striped" id="leaveCreate">
          <thead>
            <tr>
              <td rowspan="2"><br>ID Picture</td>
              <td rowspan="2"><br>Name</td>
              <td rowspan="2"><br>ID Number</td>
              <td colspan="2" class="text-center">Leave Credit</td>
              <td colspan="2" class="text-center">Avalavility Date</td>
              <td rowspan="2"><br>Action</td>
            </tr>
            <tr>
                <td>Total</td>
                <td>Remaining</td>
                <td>From</td>
                <td>To</td>
              </tr>
          </thead>
          <tbody>
            @if($worker)
              @foreach($worker as $workers)
                @if($workers->role_id == 3)
                 
                    

                    @foreach($lc as $leave)
                        @if($workers->id == $leave->worker_id )
                        <tr>
                            <td class="center"><img class="img-responsive img-rounded img-resize" src="{{asset('img/Worker ID') }}/{{$workers->idPicture}}" center></td>
                            <td>{{$workers->firstName}} {{$workers->lastName}}</td>
                            <td>{{$workers->idNumber}}</td>
                            <td>{{$leave->totalLeave}} Hours</td>
                            <td>{{$leave->remainingLeave}} Hours</td>
                            <td>{{$leave->startDate}}</td>
                            <td>{{$leave->endDate}}</td>
                            <td>
                              <button type="submit" class="btn btn-default" 
                                data-toggle="modal" 
                                data-target="#leave" 
                                data-worker="{{$workers->firstName}} {{$workers->lastName}}" 
                                data-work = "{{$leave->id}}">
                                Grant Leave
                              </button>
                            </td>
                          </tr>

                            <?php $from = $leave->startDate?>
                            <?php $to = $leave->endDate?>
                            <?php $remaining = $leave->remainingLeave?>
                            <?php $lcId = $leave->id?>
                            <?php $temp = $workers->id?>
                        @endif
                    @endforeach
                  
                @endif
               
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
        $('#leaveCreate').DataTable();
    } );
</script>

<script>
    $('#leave').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget) 
      var worker = button.data('worker')
      var workerId = button.data('workers')
      var date = button.data('date')
      var workerKey = button.data('work')
      var to = button.data('to')
      var from = button.data('form')
      var remaining = button.data('remaining')
      var lc = button.data('lc')
      
      var modal = $(this)
      modal.find('#name').text(worker)
      modal.find('#hello').text(workerId)
      modal.find('#workerId').val(workerKey)
      modal.find('#date').val(date)
      modal.find('#from').val(from)
      modal.find('#to').val(to)
      modal.find('#remaining').val(remaining)
      modal.find('#lc').val(lc)
    })
  </script>
@endsection()