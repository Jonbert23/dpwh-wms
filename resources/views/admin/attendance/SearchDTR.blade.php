@extends('MasterTemplate.admin')

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
    {{$worker->firstName}} {{$worker->lastName}}'s DTR
@endsection()


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
                Search Worker DTR
            </div>

            <div>
                <div class="panel-body">
                    <form class="form-inline" action="/adminSearchDTR" method="POST">
                        {{@csrf_field()}}
                        <div class="form-group col-md-3">
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

                        <div class="form-group col-md-3">
                            <label class="form-label col-md-3">Year</label>
                            <select name="year" id="" class="col-md-8" >
                                @for($i = 2015; $i <= $yearNow; $i++)
                                <option value="{{$i}}" @if($i == $yearNow)selected @endif>{{$i}}</option>
                                @endfor
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label class="form-label col-md-4">Quarter</label>
                            <select name="quarter" id="" class="col-md-7" >
                                <option value="1">Date 1-15</option>
                                <option value="2">Date 16-31</option>
                                <option value="3">Whole Month</option>
                            </select>
                        </div>

                        <input type="hidden" class="form-control"  name="workerId" value="{{$worker->id}}">
                        <button type="submit" class="btn btn-default">Search</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="col-md-12 col-sm-12">
        <div class="panel panel-default">
          <div class="panel-title">
          </div>

          <div class="row">
            <img class="img-responsive logo" src="{{asset('img/Dpwh Logo.png')}}" width="100%">
              <div class="col-md-12 col-sm-12 text-center text-liner padder">
                
                <b><p style="font-size: 14px;"> Republic of the Philippines</p></b><br>
                <p style="font-size: 20px; font-family: 'Brush Script MT'">Department of Public Works and Highways</p><br>
                <p style="font-size: 14px;">Region X</p><br>
                <b><p style="font-size: 22px;">OFFICE OF THE DISTRICT ENGINEER</p></b><br>
                <p style="font-size: 20px; font-family: 'Brush Script MT'">Lanao del Norte 2nd Engineering District</p><br>
                <p style="font-size: 14px;">Seminary Drive, Del Carmen, Iligan City, Tel. No. (063) 221-5703</p><br><br><br>
                <b><p style="font-size:18px; text-decoration: underline">DAILY TIME RECORD</p></b><br><br><br>
              </div>
          </div>
          <div class="row col-md-12" style="font-size: 14px;">
              <p class="text-left">Office Hours</p>
          </div>
          <div class="row text-liner">
              <div class="col-md-3 text-liner">
                <p style="font-size: 14px;">Regular Days</p>
                <p style="font-size: 14px;">Saturdays</p>
              </div>

              <div class="col-md-3">
                <p style="font-size: 14px;">A.M. 8:00 - 12:00</p>
                <p style="font-size: 14px;">A.M. 8:00 - 12:00</p>
              </div>

              <div class="col-md-3">
                <p style="font-size: 14px;">A.M. 13:00 - 17:00</p>
                <p style="font-size: 14px;">A.M. 13:00 - 17:00</p>
              </div>

              <div class="col-md-3">
                <p style="font-size: 14px;">For The Period covering:</p>
                <p style="font-size: 14px;">Month-Year</p>
              </div>
          </div>
  
          <div class="panel-body">
            <table class="table table-bordered">
              <thead class="text-center">
                <tr class="text-center">
                  <td>Date</td>
                  <td>IN</td>
                  <td>OUT</td>       
                  <td>IN</td>
                  <td>OUT</td>
                  <td>IN</td>
                  <td>OUT</td>
                  <td>Total <br> Working <br> Hours</td>
                  <td>Remark</td>                 
                </tr>
              </thead>
              <tbody>
                @for($i = $start; $i <= $end; $i++)
                <tr>
                    @foreach($attendance as $atten)
                        @if($worker->id == $atten->worker_id)
                            @if($month == \Carbon\Carbon::createFromFormat('Y-m-d', $atten->Date)->month)
                                @if($year  == \Carbon\Carbon::createFromFormat('Y-m-d', $atten->Date)->year )
                                    @if($i == \Carbon\Carbon::createFromFormat('Y-m-d', $atten->Date)->day)
                                     
                                            <td>{{$i}}</td>
                                            <td>{{$atten->morningSignin}}</td>
                                            <td>{{$atten->morningSignout}}</td>
                                            <td>{{$atten->afternoonSignin}}</td>
                                            <td>{{$atten->afternoonSignout}}</td>
                                            <?php $verifier = 1;?>

                                            <?php
                                                $m_total_hour = 0;
                                                $m_signin_time = \Carbon\Carbon::createFromTime(8,0,0, 'Asia/Manila');
                                                $m_signout_time = \Carbon\Carbon::createFromTime(12,0,0, 'Asia/Manila');

                                                if($atten->morningSignin <= $m_signin_time->toTimeString() && $atten->morningSignout > $m_signout_time->toTimeString())
                                                {
                                                    $m_total_hour = 240;
                                                }

                                                if($atten->morningSignin <= $m_signin_time->toTimeString() && $atten->morningSignout < $m_signout_time->toTimeString())
                                                {
                                                    if($atten->morningSignout == '00:00:00')
                                                    {
                                                        $m_total_hour = 0;
                                                    }
                                                    else 
                                                    {
                                                        $m_signout = $atten->morningSignout;
                                                        $hour =  $m_signout[0].''.$m_signout[1];
                                                        $minute = $m_signout[3].''.$m_signout[4];
                                                        $second = $m_signout[6].''.$m_signout[7];
    
                                                        $m_signout = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                        $m_total_hour = $m_signin_time->diffInMinutes($m_signout);
                                                    }
                                                        
                                                }
                                                if($atten->morningSignin > $m_signin_time->toTimeString() && $atten->morningSignout >= $m_signout_time->toTimeString()) 
                                                {
                                                    if($atten->morningSignin == '00:00:00')
                                                    {
                                                        $m_total_hour = 0;
                                                    }
                                                    else 
                                                    {
                                                        $m_signin = $atten->morningSignin;
                                                        $hour =  $m_signin[0].''.$m_signin[1];
                                                        $minute = $m_signin[3].''.$m_signin[4];
                                                        $second = $m_signin[6].''.$m_signin[7];
    
                                                        $m_signin = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                        $m_total_hour = $m_signin->diffInMinutes($m_signout_time);
                                                    }
                                                }

                                                if($atten->morningSignin > $m_signin_time->toTimeString() && $atten->morningSignout < $m_signout_time->toTimeString()) 
                                                {
                                                    if($atten->morningSignin == '00:00:00' || $atten->morningSignout == '00:00:00')
                                                    {
                                                        $m_total_hour = 0;
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
                                                }

                                                if($atten->afternoonSignin <= $a_signin_time->toTimeString() && $atten->aftrenoonSignout < $a_signout_time->toTimeString())
                                                {
                                                    if($atten->afternoonSignout == '00:00:00')
                                                    {
                                                        $a_total_hour = 0;
                                                    }
                                                    else 
                                                    {
                                                        $a_signout = $atten->afternoonSignout;
                                                        $hour =  $a_signout[0].''.$a_signout[1];
                                                        $minute = $a_signout[3].''.$a_signout[4];
                                                        $second = $a_signout[6].''.$a_signout[7];

                                                        $a_signout = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                        $a_total_hour = $a_signin_time->diffInMinutes($a_signout);
                                                    }
                                                        
                                                }
                                                if($atten->afternoonSignin > $a_signin_time->toTimeString() && $atten->afternoonSignout >= $a_signout_time->toTimeString()) 
                                                {
                                                    if($atten->afternoonSignin == '00:00:00')
                                                    {
                                                        $a_total_hour = 0;
                                                    }
                                                    else 
                                                    {
                                                        $a_signin = $atten->afternoonSignin;
                                                        $hour =  $a_signin[0].''.$a_signin[1];
                                                        $minute = $a_signin[3].''.$a_signin[4];
                                                        $second = $a_signin[6].''.$a_signin[7];

                                                        $a_signin = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                        $a_total_hour = $a_signin->diffInMinutes($a_signout_time);
                                                    }
                                                }

                                                if($atten->afternoonSignin > $a_signin_time->toTimeString() && $atten->afternoonSignout < $a_signout_time->toTimeString()) 
                                                {
                                                    if($atten->afternoonSignin == '00:00:00' || $atten->aftternoonSignout == '00:00:00')
                                                    {
                                                        $a_total_hour = 0;
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
                            @if($month == \Carbon\Carbon::createFromFormat('Y-m-d', $ot->date)->month)
                                @if($year  == \Carbon\Carbon::createFromFormat('Y-m-d', $ot->date)->year )
                                    @if($i == \Carbon\Carbon::createFromFormat('Y-m-d', $ot->date)->day)
                                        <?php $otVerifier = 1;?>

                                            <?php
                                                $o_total_hour = 0;
                                                $o_signin_time = \Carbon\Carbon::createFromTime(18,0,0, 'Asia/Manila');
                                                $o_signout_time = \Carbon\Carbon::createFromTime(23,59,0, 'Asia/Manila');

                                                if($ot->signin <= $o_signin_time->toTimeString() && $ot->signout >= $o_signout_time->toTimeString())
                                                {
                                                    if($ot->signin == '00:00:00')
                                                    {
                                                        $o_total_hour = 0;
                                                    }
                                                    $o_total_hour = 240;
                                                }

                                                if($ot->signin <= $o_signin_time->toTimeString() && $ot->signout < $o_signout_time->toTimeString())
                                                {
                                                    if($ot->signout == '00:00:00' || $ot->signin == '00:00:00' )
                                                    {
                                                        $o_total_hour = 0;
                                                    }
                                                    else 
                                                    {
                                                        $o_signout = $ot->signout;
                                                        $hour =  $o_signout[0].''.$o_signout[1];
                                                        $minute = $o_signout[3].''.$o_signout[4];
                                                        $second = $o_signout[6].''.$o_signout[7];

                                                        $o_signout = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                        $o_total_hour = $o_signin_time->diffInMinutes($o_signout);
                                                    }
                                                        
                                                }
                                                if($ot->signin > $o_signin_time->toTimeString() && $ot->signout >= $o_signout_time->toTimeString()) 
                                                {
                                                    if($ot->signin == '00:00:00')
                                                    {
                                                        $o_total_hour = 0;
                                                    }
                                                    else 
                                                    {
                                                        $o_signin = $ot->signin;
                                                        $hour =  $o_signin[0].''.$o_signin[1];
                                                        $minute = $o_signin[3].''.$o_signin[4];
                                                        $second = $o_signin[6].''.$o_signin[7];

                                                        $o_signin = \Carbon\Carbon::createFromTime($hour,$minute,$second, 'Asia/Manila');
                                                        $o_total_hour = $o_signin->diffInMinutes($o_signout_time);
                                                    }
                                                }

                                                if($ot->signin  > $o_signin_time->toTimeString() && $ot->signout < $o_signout_time->toTimeString()) 
                                                {
                                                    if($ot->signin == '00:00:00' || $ot->signout == '00:00:00')
                                                    {
                                                        $o_total_hour = 0;
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
                                                    }
                                                }
                                        ?>

                                        @if($verifier == 0)
                                            <td>{{$i}}</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>{{$ot->signin}}</td>
                                            <td>{{$ot->signout}}</td>
                                            <td>{{(int)($o_total_hour/60)}}:{{(int)($o_total_hour%60)}}</td>
                                            <td>Overtime</td>

                                            <?php $endLoop = 1?>
                                        @endif
                                        
                                        @if($verifier == 1)
                                            <td>{{$ot->signin}}</td>
                                            <td>{{$ot->signout}}</td>
                                            <td>{{(int)(($m_total_hour+$a_total_hour+$o_total_hour)/60)}}:{{(int)(($m_total_hour+$a_total_hour+$o_total_hour)%60)}} </td>
                                            <td>Present/Overtime</td>
                                        @endif

                                    @endif
                                @endif
                            @endif
                        @endif
                    @endforeach
                
                    @if( $verifier == 1 && $otVerifier == 0)
                        <td></td>
                        <td></td>
                        <td>{{(int)(($m_total_hour + $a_total_hour)/60)}}:{{(int)(($m_total_hour + $a_total_hour)%60)}}</td>
                        <td>Present</td>
                    @endif
                    
                </tr>
                    @if($verifier == 0 && $endLoop == 0)
                        <tr>
                            <td>{{$i}}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>0:00</td>
                            <td>Absent</td>
                        </tr>
                    @endif

                <?php $verifier = 0;?>  
                <?php $otVerifier = 0;?> 
                <?php $endLoop = 0;?>    
                @endfor
               
              </tbody>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <p class="text-justify" style="font-size: 12px;">
                        Note: the data in the above table is generated by Workers Management System. If applicable, grayed-out and greened areas to be
                        filled-up for duly approved out-of-office work/training/leave/ect. in the event of absences from the office. (Please attach supporting documents)
                    </p>
                    <b><p class="text-center"  style="font-size: 14px;">
                        Total credited number of days for the period: _______________________ days
                    </p></b>

                    <p style="font-size: 14px; text-indent: 50px;">
                        <b>I CONCUR</b> that the above time attendance report generated by the workers management system is correct and that it
                        completely reflects my number of hours/days of services rendered ti this office. Signed in Iligan City, Philippines, on (Date Now).
                    </p>
                </div>
            </div>
            <br>
            <br>
            <br>
            <div class="row">
                <div class="col-md-4"></div>
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <p class="text-center" style="font-size:15px; text-decoration: underline"><b> {{$worker->lastName}}, {{$worker->firstName}}</b></p>
                    <p class="text-center text-italic" style="font-size:12px; margin-top: -15px">EMPLOYEE'S SIGNATURE</p>
                </div>
            </div>
          </div>

          <div class="row">
              <div class="col-md-12">
                  <p style="font-size: 14px; text-indent: 50px;">
                      <b>I CERTIFY</b> on my honor that the above is true and correct report of the hour of work performed - the record of which was
                      made daily at the time of arrival at and departure from office using the district's Workers Management System.
                  </p>
              </div>
          </div>
          <br>
          <div class="row ">
              <div class="col-md-4">
                  <p><b>Recomending Approval:</b></p>
                  <br>
                  <p><b>_________________________________________________</b></p>
                  <p class="text-center" style="font-size:14px; margin-top: -15px"> Time Keeper</p>
              </div>
              <div class="col-md-4"></div>

              <div class="col-md-4">
                <p><b>Approved:</b></p>
                <br>
                <p><b>__________________________________</b></p>
            </div>  
              </div>
          </div>
        </div>
    </div>
@endsection()