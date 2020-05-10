<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Worker;
use App\Role;
use App\Skill;
use App\Education;
use App\Section;
use App\Contract;
use Carbon\Carbon;
use App\Salary;
use App\LeaveCredit;
use App\SalaryDeduction;
use App\Address;
use App\ContractPicture;
use App\Schedule;
use App\Location;
use App\Work;
use App\Attendance;
use App\Overtime;
use App\LeaveWorker;

class WorkerModuleController extends Controller
{
    public function profile()
    {
        $id = Auth::user()->id;
        $findWorker = Worker::find($id);
        $contract = Contract::all();
        $salary = Salary::all();
        $deduction = SalaryDeduction::all();
        $leave = LeaveCredit::all();
        $dateNow = Carbon::now('Asia/Manila')->toDateString();
        
        $address = Address::all();
        $add = 0;
        foreach($address as $address)
        {
            if($address->worker_id == $id)
            {
                $add = $address->id;
            }
        }

        $workerAdd = Address::find($add);
        $picture = "img/Worker ID"."/".$findWorker->idPicture;
        return view('workerModule.profile', compact('findWorker','picture','contract','workerAdd','dateNow','salary','deduction','leave'));
    }

    public function contract()
    {
        $id = Auth::user()->id;
        $worker = Worker::find($id);
        $contract = Contract::all();
        $conPhoto = ContractPicture::all();
        $now = Carbon::now('Asia/Manila');

        return view('workerModule.contract',compact('worker','contract','now','conPhoto'));
    }

    public function task()
    {
        $id = Auth::user()->id;
        $worker = Worker::find($id);
        $sched = Schedule::all();
        $mpp = Worker::all();
        $now = Carbon::now('Asia/Manila')->toDateString();
        return view('workerModule.task', compact('worker','sched','mpp','now'));
    }

    public function dtr(Request $request)
    {
        $dateNow = Carbon::now('Asia/Manila');
        $month = $dateNow->month;
        $year = $dateNow->year;
        $quarter = 3;
        $id = Auth::user()->id;

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

        return view('workerModule.dtr', compact('attendance','start','end','worker','month','year','yearNow','monthNow','verifier','OT','otVerifier','endLoop','otEmpty'));
    }

    public function dtrSearch(Request $request)
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

        return view('workerModule.dtr', compact('attendance','start','end','worker','month','year','yearNow','monthNow','verifier','OT','otVerifier','endLoop','otEmpty'));
    }

    public function salary()
    {
        $dateNow = Carbon::now('Asia/Manila');
        $monthNow =  $dateNow->month;
        $yearNow =  $dateNow->year;
        $month =  $dateNow->month;
        $year =  $dateNow->year;
        $id =  Auth::user()->id;
        $total_hour = 0;

        $worker = Worker::find($id);
        $attendance = Attendance::all();
        $salary = Salary::all();
        $OT = OverTime::all();

        return view('workerModule.salary',compact('monthNow','yearNow','worker','attendance','salary','OT','month','year','total_hour'));
    }

    public function salarySearch(Request $request)
    {
        $validate = request()->validate
        ([
            'month' => 'required',
            'year' => 'required',
        ]);

        $monthNow =  request('month');
        $yearNow =  request('year');
        $month =  request('month');
        $year =  request('year');
        $id =  Auth::user()->id;
        $total_hour = 0;

        $worker = Worker::find($id);
        $attendance = Attendance::all();
        $salary = Salary::all();
        $OT = OverTime::all();

        return view('workerModule.salary',compact('monthNow','yearNow','worker','attendance','salary','OT','month','year','total_hour'));
    }

    public function myLeave()
    {
        $leave = LeaveWorker::all();
        $id = Auth::user()->id;
        $dateNow = Carbon::now('Asia/Manila')->toDateString();

        return view('workerModule.leave', compact('leave','id','dateNow'));
    }

}
