@extends('MasterTemplate.admin')

@section('header')
{{$worker->firstName}} {{$worker->lastName}}'s Earning Details
@endSection()

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
    
    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-title">
                Search Worker Earning
            </div>

            <div>
                <div class="panel-body">
                    <form class="form-inline" action="/adminSalarEarn" method="POST">
                        {{@csrf_field()}}
                        <div class="form-group col-md-4">
                            <label class="form-label col-md-3">Month</label>
                            <select name="month" id="" class="col-md-8">
                                <option value="1" @if($month == 1) selected @endif>January</option>
                                <option value="2"  @if($month == 2) selected @endif>Febuary</option>
                                <option value="3" @if($month == 3) selected @endif>March</option>
                                <option value="4"  @if($month == 4) selected @endif>April</option>
                                <option value="5" @if($month == 5) selected @endif>May</option>
                                <option value="6" @if($month == 6) selected @endif>June</option>
                                <option value="7" @if($month == 7) selected @endif>July</option>
                                <option value="8" @if($month == 8) selected @endif>August</option>
                                <option value="9" @if($month == 9) selected @endif>September</option>
                                <option value="10" @if($month == 10) selected @endif>October</option>
                                <option value="11" @if($month == 11) selected @endif>November</option>
                                <option value="12" @if($month == 12) selected @endif>December</option>
                            </select>
                        </div>

                        <div class="form-group col-md-4">
                            <label class="form-label col-md-3">Year</label>
                            <select name="year" id="" class="col-md-8" >
                                @for($i = 2015; $i <= $yearNow; $i++)
                                <option value="{{$i}}" @if($i == $yearNow)selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <input type="hidden" class="form-control"  name="id" value="{{$worker->id}}">
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12">
        <div class="panel panel-default">
  
          <div class="panel-title">
            Worker Earning Details
          </div>
  
          <div class="panel-body">

            <table class="table table-bordered table-striped" >
              <thead>
                <tr>
                    <td rowspan="2" class="text-center">Day</td>
                    <td colspan="2" class="text-center">Rendered Hours</td>
                    <td rowspan="2" class="text-center">Earning</td>
                </tr>
                <tr>
                    <td class="text-center">Hour</td>
                    <td class="text-center">Minute</td>
                    
                </tr>
              </thead>
              <tbody>
                  @for($i = 1; $i <= 31; $i++)
               

                    @foreach($attendance as $atten)
                        @if($worker->id == $atten->worker_id)
                            @if($monthNow == \Carbon\Carbon::createFromFormat('Y-m-d', $atten->Date)->month)
                                @if($yearNow  == \Carbon\Carbon::createFromFormat('Y-m-d', $atten->Date)->year )
                                    @if($i  == \Carbon\Carbon::createFromFormat('Y-m-d', $atten->Date)->day )

                                        <?php
                                            $m_total_hour = 0;
                                            $m_signin_time = \Carbon\Carbon::createFromTime(8,0,0, 'Asia/Manila');
                                            $m_signout_time = \Carbon\Carbon::createFromTime(12,0,0, 'Asia/Manila');

                                            if($atten->morningSignin <= $m_signin_time->toTimeString() && $atten->morningSignout > $m_signout_time->toTimeString())
                                            {
                                                $m_total_hour = 240;
                                                $total_hour =  $total_hour + $m_total_hour;
                                            }

                                            if($atten->morningSignin <= $m_signin_time->toTimeString() && $atten->morningSignout < $m_signout_time->toTimeString())
                                            {
                                                if($atten->morningSignout == '00:00:00')
                                                {
                                                    $m_total_hour = 0;
                                                    $total_hour =  $total_hour + $m_total_hour;
                                                }
                                                else 
                                                {
                                                    $m_signout = $atten->morningSignout;
                                                    $hour =  $m_signout[0].''.$m_signout[1];
                                                    $minute = $m_signout[3].''.$m_signout[4];
                                                    $second = $m_signout[6].''.$m_signout[7];

                                                    $m_signout = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                    $m_total_hour = $m_signin_time->diffInMinutes($m_signout);
                                                    $total_hour =  $total_hour + $m_total_hour;
                                                }
                                                    
                                            }
                                            if($atten->morningSignin > $m_signin_time->toTimeString() && $atten->morningSignout >= $m_signout_time->toTimeString()) 
                                            {
                                                if($atten->morningSignin == '00:00:00')
                                                {
                                                    $m_total_hour = 0;
                                                    $total_hour =  $total_hour + $m_total_hour;
                                                }
                                                else 
                                                {
                                                    $m_signin = $atten->morningSignin;
                                                    $hour =  $m_signin[0].''.$m_signin[1];
                                                    $minute = $m_signin[3].''.$m_signin[4];
                                                    $second = $m_signin[6].''.$m_signin[7];

                                                    $m_signin = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                    $m_total_hour = $m_signin->diffInMinutes($m_signout_time);
                                                    $total_hour =  $total_hour + $m_total_hour;
                                                }
                                            }

                                            if($atten->morningSignin > $m_signin_time->toTimeString() && $atten->morningSignout < $m_signout_time->toTimeString()) 
                                            {
                                                if($atten->morningSignin == '00:00:00' || $atten->morningSignout == '00:00:00')
                                                {
                                                    $m_total_hour = 0;
                                                    $total_hour =  $total_hour + $m_total_hour;
                                                }
                                                else 
                                                {
                                                    $m_signin = $atten->morningSignin;
                                                    $hour =  $m_signin[0].''.$m_signin[1];
                                                    $minute = $m_signin[3].''.$m_signin[4];
                                                    $second = $m_signin[6].''.$m_signin[7];

                                                    $m_signout = $atten->morningSignout;
                                                    $hour1 =  $m_signout[0].''.$m_signout[1];
                                                    $minute1 = $m_signout[3].''.$m_signout[4];
                                                    $second1 = $m_signout[6].''.$m_signout[7];

                                                    $m_signin = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                    $m_signout = \Carbon\Carbon::createFromTime($hour1,$minute1,$second1, 'Asia/Manila');
                                                    $m_total_hour = $m_signin->diffInMinutes($m_signout);
                                                    $total_hour =  $total_hour + $m_total_hour;
                                                }
                                            }
                                        ?>

                                        <?php
                                            $a_total_hour = 0;
                                            $a_signin_time = \Carbon\Carbon::createFromTime(13,0,0, 'Asia/Manila');
                                            $a_signout_time = \Carbon\Carbon::createFromTime(17,0,0, 'Asia/Manila');

                                            if($atten->afternoonSignin <= $a_signin_time->toTimeString() && $atten->aftrenoonSignout >= $a_signout_time->toTimeString())
                                            {
                                                $a_total_hour = 240;
                                                $total_hour =  $total_hour + $a_total_hour;
                                            }

                                            if($atten->afternoonSignin <= $a_signin_time->toTimeString() && $atten->aftrenoonSignout < $a_signout_time->toTimeString())
                                            {
                                                if($atten->afternoonSignout == '00:00:00')
                                                {
                                                    $a_total_hour = 0;
                                                    $total_hour =  $total_hour + $a_total_hour;
                                                }
                                                else 
                                                {
                                                    $a_signout = $atten->afternoonSignout;
                                                    $hour =  $a_signout[0].''.$a_signout[1];
                                                    $minute = $a_signout[3].''.$a_signout[4];
                                                    $second = $a_signout[6].''.$a_signout[7];

                                                    $a_signout = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                    $a_total_hour = $a_signin_time->diffInMinutes($a_signout);
                                                    $total_hour =  $total_hour + $a_total_hour;
                                                }
                                                    
                                            }
                                            if($atten->afternoonSignin > $a_signin_time->toTimeString() && $atten->afternoonSignout >= $a_signout_time->toTimeString()) 
                                            {
                                                if($atten->afternoonSignin == '00:00:00')
                                                {
                                                    $a_total_hour = 0;
                                                    $total_hour =  $total_hour + $a_total_hour;
                                                }
                                                else 
                                                {
                                                    $a_signin = $atten->afternoonSignin;
                                                    $hour =  $a_signin[0].''.$a_signin[1];
                                                    $minute = $a_signin[3].''.$a_signin[4];
                                                    $second = $a_signin[6].''.$a_signin[7];

                                                    $a_signin = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                    $a_total_hour = $a_signin->diffInMinutes($a_signout_time);
                                                    $total_hour =  $total_hour + $a_total_hour;
                                                }
                                            }

                                            if($atten->afternoonSignin > $a_signin_time->toTimeString() && $atten->afternoonSignout < $a_signout_time->toTimeString()) 
                                            {
                                                if($atten->afternoonSignin == '00:00:00' || $atten->aftternoonSignout == '00:00:00')
                                                {
                                                    $a_total_hour = 0;
                                                    $total_hour =  $total_hour + $a_total_hour;
                                                }
                                                else 
                                                {
                                                    $a_signin = $atten->afternoonSignin;
                                                    $hour =  $a_signin[0].''.$a_signin[1];
                                                    $minute = $a_signin[3].''.$a_signin[4];
                                                    $second = $a_signin[6].''.$a_signin[7];

                                                    $a_signout = $atten->afternoonSignout;
                                                    $hour1 =  $a_signout[0].''.$a_signout[1];
                                                    $minute1 = $a_signout[3].''.$a_signout[4];
                                                    $second1 = $a_signout[6].''.$a_signout[7];

                                                    $a_signin = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                    $a_signout = \Carbon\Carbon::createFromTime($hour1,$minute1,$second1, 'Asia/Manila');
                                                    $a_total_hour = $a_signin->diffInMinutes($a_signout);
                                                    $total_hour =  $total_hour + $a_total_hour;
                                                }
                                            }
                                        ?>                    
                                        
                                    @endif
                                @endif
                            @endif
                        @endif
                    @endforeach

                    @foreach($OT as $ot)
                        @if($worker->id == $ot->worker_id)
                            @if($monthNow == \Carbon\Carbon::createFromFormat('Y-m-d', $ot->date)->month)
                                @if($yearNow  == \Carbon\Carbon::createFromFormat('Y-m-d', $ot->date)->year )
                                @if($i  == \Carbon\Carbon::createFromFormat('Y-m-d', $ot->date)->day )
                                    <?php
                                        $o_total_hour = 0;
                                        $o_signin_time = \Carbon\Carbon::createFromTime(18,0,0, 'Asia/Manila');
                                        $o_signout_time = \Carbon\Carbon::createFromTime(23,59,0, 'Asia/Manila');

                                        if($ot->signin <= $o_signin_time->toTimeString() && $ot->signout >= $o_signout_time->toTimeString())
                                        {
                                            if($ot->signin == '00:00:00')
                                            {
                                                $o_total_hour = 0;
                                                $total_hour =  $total_hour + $o_total_hour;
                                            }
                                            $o_total_hour = 360;
                                            $total_hour =  $total_hour + $o_total_hour;
                                        }

                                        if($ot->signin <= $o_signin_time->toTimeString() && $ot->signout < $o_signout_time->toTimeString())
                                        {
                                            if($ot->signout == '00:00:00' || $ot->signin == '00:00:00' )
                                            {
                                                $o_total_hour = 0;
                                                $total_hour =  $total_hour + $o_total_hour;
                                            }
                                            else 
                                            {
                                                $o_signout = $ot->signout;
                                                $hour =  $o_signout[0].''.$o_signout[1];
                                                $minute = $o_signout[3].''.$o_signout[4];
                                                $second = $o_signout[6].''.$o_signout[7];

                                                $o_signout = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                $o_total_hour = $o_signin_time->diffInMinutes($o_signout);
                                                $total_hour =  $total_hour + $o_total_hour;
                                            }
                                                
                                        }
                                        if($ot->signin > $o_signin_time->toTimeString() && $ot->signout >= $o_signout_time->toTimeString()) 
                                        {
                                            if($ot->signin == '00:00:00')
                                            {
                                                $o_total_hour = 0;
                                                $total_hour =  $total_hour + $o_total_hour;
                                            }
                                            else 
                                            {
                                                $o_signin = $ot->signin;
                                                $hour =  $o_signin[0].''.$o_signin[1];
                                                $minute = $o_signin[3].''.$o_signin[4];
                                                $second = $o_signin[6].''.$o_signin[7];

                                                $o_signin = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                $o_total_hour = $o_signin->diffInMinutes($o_signout_time);
                                                $total_hour =  $total_hour + $o_total_hour;
                                            }
                                        }

                                        if($ot->signin  > $o_signin_time->toTimeString() && $ot->signout < $o_signout_time->toTimeString()) 
                                        {
                                            if($ot->signin == '00:00:00' || $ot->signout == '00:00:00')
                                            {
                                                $o_total_hour = 0;
                                                $total_hour =  $total_hour + $o_total_hour;
                                            }
                                            else 
                                            {
                                                $o_signin = $ot->signin;
                                                $hour =  $o_signin[0].''.$o_signin[1];
                                                $minute = $o_signin[3].''.$o_signin[4];
                                                $second = $o_signin[6].''.$o_signin[7];

                                                $o_signout = $ot->signout;
                                                $hour1 =  $o_signout[0].''.$o_signout[1];
                                                $minute1 = $o_signout[3].''.$o_signout[4];
                                                $second1 = $o_signout[6].''.$o_signout[7];

                                                $o_signin = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                $o_signout = \Carbon\Carbon::createFromTime($hour1,$minute1,$second1, 'Asia/Manila');
                                                $o_total_hour = $o_signin->diffInMinutes($o_signout);
                                                $total_hour =  $total_hour + $o_total_hour;
                                            }
                                        }
                                    ?>
                                @endif                
                                @endif
                            @endif
                        @endif
                    @endforeach

                    <?php $salAmount = 0;?>
                    @foreach($salary as $sal)
                        @if($worker->id == $sal->worker_id)
                            <?php $salAmount = $sal->salaryAmount;?>
                        @endif
                    @endForeach()


                    <tr>
                        <td class="text-center">{{$i}}</td>
                        <td class="text-center">{{(int)($total_hour / 60)}}</td>
                        <td class="text-center">{{$total_hour % 60}}</td>
                        <td>P {{$total_hour * ($salAmount/480)}}</td>
                </tr>
                <?php $total_hour = 0;?>
            @endfor


              </tbody>
            </table>
          </div>
  
        </div>
      </div>

@endSection()

@section('jsScript')
    <script>
        $(document).ready(function() {
            $('#earnSalary').DataTable();
        } );
    </script>
@endsection()