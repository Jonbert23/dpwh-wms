<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;
use App\LeaveCredit;
use Carbon\Carbon;
use App\LeaveWorker;
use App\Logs;
use Auth;

class HrLeaveController extends Controller
{

    public function index()
    {
        $leaveWorker = LeaveWorker::all();
        $worker = Worker::all();

        return view('hr.leave.laeveIndex',compact('worker','leaveWorker'));
    }

    public function grantLeave()
    {
        $lc = LeaveCredit::all();
        $worker = Worker::all();
        $dateNow =  Carbon::now('Asia/Manila')->toDateString();
        $from = 0;
        $to = 0;
        $remaining = 0;
        $temp = 0;
        $lcId = 0;
       
        return view('hr.leave.leaveCreate',compact('lc','worker','dateNow','temp','from','to','remaining','lcId'));
    }

    public function storeLeave(Request $request)
    {
    
       $leaveId = request('leaveId');
       $leaveStart = request('startDate');
       $dateNow =  Carbon::now('Asia/Manila')->toDateString();

       $leave = LeaveCredit::find($leaveId);
        
       if($leave->startDate >  $leaveStart)
       {
            return back()->withErrors(['message' => 'Leave Request is out of leave Availavility Date']);
       }
       if($leave->remainingLeave ==  0)
       {
            return back()->withErrors(['message' => 'You dont have enough leave credits']);
       }
       if($leaveStart <  $dateNow)
       {
            return back()->withErrors(['message' => 'Leave start date must be greater than the current date']);
       }

      
       $ly = ($leaveStart[0].$leaveStart[1].$leaveStart[2].$leaveStart[3]);
       $lm = ($leaveStart[5].$leaveStart[6]);
       $ld = ($leaveStart[8].$leaveStart[9]);
       $l_end = '';

       $january = 31;
       $febuary = 28;
       $march = 31;
       $april = 30;
       $may = 31;
       $june = 30;
       $july = 31;
       $august = 31;
       $september = 30;
       $october = 31;
       $november = 30;
       $december = 31;

       if((int)($lm) == 1)
       {
           $ld = $ld + 14;
           $l_end = $ly."-".$lm."-".$ld;

           if($ld > $january)
           {
                $lm = $lm + 1;
                $ld = $ld - $january;
                $l_end = $ly."-".$lm."-".$ld;
           }
       }
       else if((int)($lm) == 2)
       {
           $ld = $ld + 14;
           $l_end = $ly."-".$lm."-".$ld;

           if($ld > $febuary)
           {
                $lm = $lm + 1;
                $ld = $ld - $febuary;
                $l_end = $ly."-".$lm."-".$ld;
           }
       }
       else if((int)($lm) == 3)
       {
           $ld = $ld + 14;
           $l_end = $ly."-".$lm."-".$ld;

           if($ld > $march)
           {
                $lm = $lm + 1;
                $ld = $ld - $march;
                $l_end = $ly."-".$lm."-".$ld;
           }
       }
       else if((int)($lm) == 4)
       {
           $ld = $ld + 14;
           $l_end = $ly."-".$lm."-".$ld;

           if($ld >  $april)
           {
                $lm = $lm + 1;
                $ld = $ld -  $april;
                $l_end = $ly."-".$lm."-".$ld;
           }
       }
       else if((int)($lm) == 5)
       {
           $ld = $ld + 14;
           $l_end = $ly."-".$lm."-".$ld;

           if($ld >  $may)
           {
                $lm = $lm + 1;
                $ld = $ld - $may;
                $l_end = $ly."-".$lm."-".$ld;
           }
       }
       else if((int)($lm) == 6)
       {
           $ld = $ld + 14;
           $l_end = $ly."-".$lm."-".$ld;

           if($ld >  $june)
           {
                $lm = $lm + 1;
                $ld = $ld -  $june;
                $l_end = $ly."-".$lm."-".$ld;
           }
       }
       else if((int)($lm) == 7)
       {
           $ld = $ld + 14;
           $l_end = $ly."-".$lm."-".$ld;

           if($ld >   $july)
           {
                $lm = $lm + 1;
                $ld = $ld -   $july;
                $l_end = $ly."-".$lm."-".$ld;
           }
       }
       else if((int)($lm) == 8)
       {
           $ld = $ld + 14;
           $l_end = $ly."-".$lm."-".$ld;

           if($ld >   $august)
           {
                $lm = $lm + 1;
                $ld = $ld -  $august;
                $l_end = $ly."-".$lm."-".$ld;
           }
       }
       else if((int)($lm) == 9)
       {
           $ld = $ld + 14;
           $l_end = $ly."-".$lm."-".$ld;

           if($ld >    $september)
           {
                $lm = $lm + 1;
                $ld = $ld -   $september;
                $l_end = $ly."-".$lm."-".$ld;
           }
       }
       else if((int)($lm) == 10)
       {
           $ld = $ld + 14;
           $l_end = $ly."-".$lm."-".$ld;

           if($ld > $october)
           {
                $lm = $lm + 1;
                $ld = $ld - $october;
                $l_end = $ly."-".$lm."-".$ld;
           }
       }

       else if((int)($lm) == 11)
       {
           $ld = $ld + 14;
           $l_end = $ly."-".$lm."-".$ld;

           if($ld > $november)
           {
                $lm = $lm + 1;
                $ld = $ld - $november;
                $l_end = $ly."-".$lm."-".$ld;
           }
       }

       else if((int)($lm) == 12)
       {
           $ld = $ld + 14;
           $l_end = $ly."-".$lm."-".$ld;

           if($ld >  $december)
           {
                $ly = $ly + 1;
                $lm = 01;
                $ld = $ld -  $december;
                $l_end = $ly."-".$lm."-".$ld;
           }
       }
       $leaveEnd = Carbon::createFromFormat('Y-m-d', $l_end)->toDateString();

       $updateLeave = LeaveCredit::find($leaveId);
       $updateLeave->remainingLeave = 0;
       $updateLeave->save();

       $leaveWorker = new LeaveWorker;
       $leaveWorker->worker_id = $updateLeave->worker_id;
       $leaveWorker->startDate =  $leaveStart;
       $leaveWorker->endDate = $leaveEnd;
       $leaveWorker->save();

       //logs---------------------------------------------------------------------------------------------------------------------------------------------------------
       $fname = Worker::find($updateLeave->worker_id)->firstName;
       $lname = Worker::find($updateLeave->worker_id)->lastName;
       $activity = "Granted leave to ".$fname." ".$lname;
       $logDate = Carbon::now('Asia/Manila');

       $logs = new Logs;
       $logs->worker_id = Auth::user()->id;
       $logs->date =  $logDate->toDateString();
       $logs->time = $logDate->toTimeString();
       $logs->activity = $activity;
       $logs->save();

       return redirect()->back()->with('message', 'Leave has Successfully registered');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
