@extends('MasterTemplate.hr')

@section('head')
    <style>
        .text-liner
        {
            line-height:10px !important;
        }
        .logo
        {
            width: 10%;
            height:  10%;
            margin-top: 30px;
            margin-left: 140px;
        }
        .padder
        {
            margin-top: -100px;
        }
    </style>
@endsection()

@section('header')
    Salary Details
@endsection()

@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-title">
                Search Worker Salary Information
            </div>

            <div>
                <div class="panel-body">
                    <form class="form-inline" action="/adminContractReportSearch" method="POST">
                        {{@csrf_field()}}
                        <div class="form-group col-md-3">
                            <label class="form-label col-md-3">Month</label>
                            <select name="month" id="" class="col-md-8">
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

                        <div class="form-group col-md-3">
                            <label class="form-label col-md-3">Year</label>
                            <select name="year" id="" class="col-md-8" >
                                @for($i = 2015; $i <= $yearNow; $i++)
                                <option value="{{$i}}" @if($i == $yearNow)selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                        </div>
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <div class="col-md-12">
        <div class="panel panel-default">
  
          {{-- <div class="panel-title">
            Worker Salary Information
          </div>
   --}}
          <div class="panel-body">

            <div class="row">
                <img class="img-responsive logo" src="{{asset('img/Dpwh Logo.png')}}" width="100%">
                  <div class="col-md-12 col-sm-12 text-center text-liner padder">
                    
                    <b><p style="font-size: 14px;"> Republic of the Philippines</p></b><br>
                    <p style="font-size: 20px; font-family: 'Brush Script MT'">Department of Public Works and Highways</p><br>
                    <p style="font-size: 14px;">Region X</p><br>
                    <b><p style="font-size: 22px;">OFFICE OF THE DISTRICT ENGINEER</p></b><br>
                    <p style="font-size: 20px; font-family: 'Brush Script MT'">Lanao del Norte 2nd Engineering District</p><br>
                    <p style="font-size: 14px;">Seminary Drive, Del Carmen, Iligan City, Tel. No. (063) 221-5703</p><br><br><br>
                    <b><p style="font-size:18px; text-decoration: underline">STATISTICS OF JOB ORDER CONTRACT REPORT</p></b><br><br><br>
                  </div>
              </div>
              
              <div class="row text-liner">
                  <div class="col-md-3">
                    <p style="font-size: 14px;">For The Period covering:</p>
                    <p style="font-size: 14px;">Month-Year</p>
                  </div>
              </div>
            <table class="table table-bordered table-striped" >
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Name</th>
                        <th>ID Number</th>
                        <th>Designation</th>
                        <th>Effectivity Of Contract</th>
                        <th>Expiry Date</th>
                        <th>Remark</th>
                    </tr>
                </thead>
                <?php $no = 0;?>
                <tbody class="text-capitalize">
                    @foreach($contract as $cons)
                    <?php $no++;?>
                        @if($cons->startingDate <= $dateNow && $cons->expiryDate >= $dateNow)
                            <tr>
                                <td>{{$no}}</td>
                                <td>{{\App\Worker::find($cons->worker_id)->firstName}} {{\App\Worker::find($cons->worker_id)->lastName}}</td>
                                <td>{{\App\Worker::find($cons->worker_id)->idNumber}}</td>
                                <td>{{\App\Worker::find($cons->worker_id)->section->name}}</td>
                                <td>{{$cons->startingDate}}</td>
                                <td>{{$cons->expiryDate}}</td>
                                @if($cons->expiryDate >= $dateNow)
                                    <td>Active</td>
                                @endif
                                @if($cons->expiryDate < $dateNow)
                                    <td>Not Active/Void</td>
                                @endif
                                
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <p style="font-size: 14px; text-indent: 50px;">
                        <b>I CERTIFY</b> on my honor that the above is true and correct report of employees contract status/remark - the record of which from office using the district's Workers Management System.
                    </p>
                </div>
            </div>
            <br>
            <div class="row ">
                <div class="col-md-4">
                    <p><b>Recomending By:</b></p>
                    <br>
                    <p><b>_________________________________________________</b></p>
                    <p class="text-center" style="font-size:14px; margin-top: -15px"> Time Keeper</p>
                </div>
                <div class="col-md-4"></div>
  
                <div class="col-md-4">
                  <p><b>Approved By:</b></p>
                  <br>
                  <p><b>_____________________________________________</b></p>
                  <p class="text-center" style="font-size:14px; margin-top: -15px">District Engineer</p>
              </div>  
                </div>
            </div>
          </div>
        </div>
      </div>

@endSection()

@section('jsScript')
    <script>
        $(document).ready(function() {
            $('#salaryIndex').DataTable();
        } );
    </script>
@endsection()