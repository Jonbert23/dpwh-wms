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


class MppModuleController extends Controller
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
        return view('mppModule.mppProfile', compact('findWorker','picture','contract','workerAdd','dateNow','salary','deduction','leave'));
    }

    public function task()
    {
        $mppId = Auth::user()->id;
        $task = Schedule::all();
        $dateNow = Carbon::now('Asia/Manila')->toDateString();

        return view('mppModule.task', compact('mppId','task','dateNow'));
    }

    public function supervisory()
    {
        $mppId = Auth::user()->id;
        $task = Schedule::all();
        $dateNow = Carbon::now('Asia/Manila')->toDateString();

        return view('mppModule.supervisory', compact('mppId','task','dateNow'));
    }
}
