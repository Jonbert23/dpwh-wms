<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Attendance;
use App\Worker;
use Carbon\Carbon;
use App\Overtime;

class AdminAttedanceController extends Controller
{
    
    public function index()
    {
        //
    }

    public function create()
    {
        
    }

    public function uploadAttendace()
    {
        $worker = Worker::all();
        $now = Carbon::now('Asia/Manila');
        $yearNow = $now->year;
        $monthNow  = $now->month;
        return view('admin.attendance.UploadAttendance',compact('worker', 'yearNow','monthNow'));
    }

    public function DTRIndex()
    {
        $worker = Worker::all();
        return view('admin.attendance.DTRIndex', compact('worker'));
    }

    public function showDTR($id)
    {
        $now = Carbon::now('Asia/Manila');
        $month = $now->month;
        $yearNow = $now->year;

        $searchYear = $yearNow;
        $searchMonth = $now->month;

        $worker = Worker::find($id);

        return view('admin.attendance.DTR', compact('worker','month','yearNow','searchYear','searchMonth'));

    }

    public function searhDTR(Request $request)
    {
        $validate = request()->validate
        ([
            'month' => 'required',
            'year' => 'required',
            'quarter' => 'required'
        ]);
        $month = request('month');
        $year = request('year');
        $quarter = request('quarter');
        $id = request('workerId');

        $now = Carbon::now('Asia/Manila');
        $yearNow = $now->year;
        $monthNow  = $now->month;

        $verifier = 0;
        $otVerifier = 0;
        $endLoop = 0;
        $otEmpty = 0;

        $worker = Worker::find($id);
        $attendance = Attendance::all();
        $OT = OverTime::all();


        $end = 0;
        $start = 0;

        if($quarter == 1)
        {
            $start = 1;
            $end = 15;
        }

        if($quarter == 2)
        {
            $start = 16;
            $end = 31;
        }

        if($quarter == 3)
        {
            $start = 1;
            $end = 31;
        }

        return view('admin.attendance.SearchDTR', compact('attendance','start','end','worker','month','year','yearNow','monthNow','verifier','OT','otVerifier','endLoop','otEmpty'));
    }

    public function storeAttendance(Request $request)
    {
        $validateAttendance = request()->validate([
            'attendanceUpload' => 'required',
        ]);

        if($request->hasfile('attendanceUpload'))
        {
            $file = $request->file('attendanceUpload');
            $logName = $file->getClientOriginalName();
            $filename = time().$logName;
            $file->move('biometricFiles', $filename);
             
            $fileDir = "biometricFiles/".$filename;
            $fileToRead = fopen($fileDir,"r");
            $fileToCount = fopen($fileDir,"r");
            $copy = "";
            $finalCopy = "";
            $space = " ";
            $endLine = 0;
            $lineCounter = 0;

            while(!feof($fileToCount))
            {
                $bio = fgets($fileToCount);
                $endLine++;
            }
            fclose($fileToCount);

            $id = "";
            $workerId = "";
            $department = "";
            $date = "";
            $time = "";
            $deviceId = "";
            while(!feof($fileToRead))
            {
                $bioRecords = fgets($fileToRead);
                $bioRecords = str_replace("\t",",", $bioRecords);
                $bioRecords = str_replace("     ",",", $bioRecords);

                $lineCounter++;

                if($lineCounter > 1 && $lineCounter < $endLine)
                {
                    $attribute = explode(",", $bioRecords);
                    list($id, $workerId, $department, $date, $time, $deviceId) = $attribute;
                    
                    $date = str_replace(" ","",$date);
                    $workersId = str_replace(" ","",$workerId);
                    $time = str_replace(" ","",$time);

                    $hour = "";
                    $minute = "";
                    $second = "";
                    $counter = 0;
                    $timeLen = strlen($time);
                    
                    for($j = 0; $j < $timeLen; $j++)
                    {
                        if($time[$j] == ":")
                        {
                            $counter++;
                        }
                        if($counter == 0 && $time[$j] != ":")
                        {
                            $hour = $hour.$time[$j];
                        }
                        if($counter == 1 && $time[$j] != ":")
                        {
                            $minute = $minute.$time[$j];
                        }
                        if($counter == 2 && $time[$j] != ":")
                        {
                            $second = $second.$time[$j];
                        }
                    }
                    $date = Carbon::createFromFormat('Y-m-d', $date)->toDateString();
                    $time = Carbon::createFromTime($hour, $minute, $second, 'Asia/Manila')->toTimeString();
                    $default = Carbon::createFromTime(0,0,0, 'Asia/Manila')->toTimeString();
                    
                    $m_signinStart = Carbon::createFromTime(7,0,0, 'Asia/Manila')->toTimeString();
                    $m_signinEnd = Carbon::createFromTime(9,0,0, 'Asia/Manila')->toTimeString();
                    $m_signoutStart = Carbon::createFromTime(12,0,0, 'Asia/Manila')->toTimeString();
                    $m_signoutEnd = Carbon::createFromTime(12,30,0, 'Asia/Manila')->toTimeString();

                    $a_signinStart = Carbon::createFromTime(12,31,0, 'Asia/Manila')->toTimeString();
                    $a_signinEnd = Carbon::createFromTime(14,0,0, 'Asia/Manila')->toTimeString();
                    $a_signoutStart = Carbon::createFromTime(17,0,0, 'Asia/Manila')->toTimeString();
                    $a_signoutEnd = Carbon::createFromTime(17,30,0, 'Asia/Manila')->toTimeString(); 
                    
                    $o_signinStart = Carbon::createFromTime(17,31,0, 'Asia/Manila')->toTimeString();
                    $o_signinEnd = Carbon::createFromTime(19,0,0, 'Asia/Manila')->toTimeString();
                    $o_signoutStart = Carbon::createFromTime(20,0,0, 'Asia/Manila')->toTimeString();
                    $o_signoutEnd = Carbon::createFromTime(23,59,0, 'Asia/Manila')->toTimeString(); 

                    $worker = Worker::all();
                    $attendance = Attendance::all();
                    foreach($worker as $workers)
                    {

                        if($workerId == $workers->idNumber)
                        {
                            $workerPK = $workers->id;
                            $workerNumber = $workers->idNumber;
                            $exist = 0;
                            foreach($attendance as $atten)
                            {
                                if($date == $atten->Date && $workerPK == $atten->worker_id)
                                {
                                    $attenId = $atten->id;
                                    $exist = 1;
                                    if($time > $m_signinStart && $time < $m_signinEnd)
                                    {
                                        $updateAtten = Attendance::find($attenId);
                                        $updateAtten->morningSignin      = $time;
                                        $updateAtten->save();
                                    }
                                    if($time > $m_signoutStart && $time < $m_signoutEnd) 
                                    {
                                        $updateAtten = Attendance::find($attenId);
                                        $updateAtten->morningSignout      = $time;
                                        $updateAtten->save();
                                    }
                                    if($time > $a_signinStart && $time < $a_signinEnd)
                                    {
                                        $updateAtten = Attendance::find($attenId);
                                        $updateAtten->afternoonSignin      = $time;
                                        $updateAtten->save();
                                    }
                                    if($time >  $a_signoutStart && $time <  $a_signoutEnd) 
                                    {
                                        $updateAtten = Attendance::find($attenId);
                                        $updateAtten->afternoonSignout      = $time;
                                        $updateAtten->save();
                                    }
                                }
                            }
                            if($exist == 0)
                            {
                                if($time > $m_signinStart && $time < $m_signinEnd) 
                                {   
                                    $createAtten = new Attendance;
                                    $createAtten->Date               = $date;
                                    $createAtten->worker_id          = $workerPK;
                                    $createAtten->morningSignin      = $time;
                                    $createAtten->morningSignout     = $default;
                                    $createAtten->afternoonSignin    = $default;
                                    $createAtten->afternoonSignout   = $default;
                                    $createAtten->save();
                                }
                                if($time > $m_signoutStart && $time < $m_signoutEnd) 
                                {
                                    $createAtten = new Attendance;
                                    $createAtten->Date               = $date;
                                    $createAtten->worker_id          = $workerPK;
                                    $createAtten->morningSignin      = $default;
                                    $createAtten->morningSignout     = $time;
                                    $createAtten->afternoonSignin    = $default;
                                    $createAtten->afternoonSignout   = $default;
                                    $createAtten->save();
                                }
                                if($time > $a_signinStart && $time < $a_signinEnd) 
                                {
                                    $createAtten = new Attendance;
                                    $createAtten->Date               = $date;
                                    $createAtten->worker_id          = $workerPK;
                                    $createAtten->morningSignin      = $default;
                                    $createAtten->morningSignout     = $default;
                                    $createAtten->afternoonSignin    = $time;
                                    $createAtten->afternoonSignout   = $default;
                                    $createAtten->save();
                                }
                                if($time >  $a_signoutStart && $time <  $a_signoutEnd) 
                                {
                                    $createAtten = new Attendance;
                                    $createAtten->Date               = $date;
                                    $createAtten->worker_id          = $workerPK;
                                    $createAtten->morningSignin      = $default;
                                    $createAtten->morningSignout     = $time;
                                    $createAtten->afternoonSignin    = $default;
                                    $createAtten->afternoonSignout   = $default;
                                    $createAtten->save();
                                }
                                //Overtime------------------------------------------------------------------------------
                                
                            }
                            $overTime = Overtime::all();
                            $otExist = 0;
                            foreach($overTime as $ot)
                            {
                                if($date == $ot->date && $workerPK == $ot->worker_id)
                                {
                                    $otExist = 1;
                                    $otID = $ot->id;
                                    if($time >  $o_signinStart && $time <  $o_signinEnd) 
                                    {
                                        $updateOver = Overtime::find($otID);
                                        $updateOver->signin     = $time;
                                        $updateOver->save();
                                    }
                                    if($time >  $o_signoutStart && $time <  $o_signoutEnd) 
                                    {
                                        $updateOver = Overtime::find($otID);
                                        $updateOver->signout      = $time;
                                        $updateOver->save();
                                    }
                                }
                            }
                            if($otExist == 0)
                            {
                                if($time >  $o_signinStart && $time <  $o_signinEnd) 
                                {
                                    $createOver = new Overtime;
                                    $createOver->date               = $date;
                                    $createOver->worker_id          = $workerPK;
                                    $createOver->signin             = $time;
                                    $createOver->signout            = $default;
                                    $createOver->save();
                                }
                                if($time >  $o_signoutStart && $time <  $o_signoutEnd) 
                                {
                                    $createOver = new Overtime;
                                    $createOver->date               = $date;
                                    $createOver->worker_id          = $workerPK;
                                    $createOver->signin             = $default;
                                    $createOver->signout            = $time;
                                    $createOver->save();
                                }
                            }
                            $exist = 0;
                            $otExist = 0;
                        }
                    }
                    $counter = 0;
                }
            }
        }
        fclose($fileToRead);
        return redirect()->back()->with('message', 'Attendance Successfully Uploaded');
    }
}
