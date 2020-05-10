<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Worker;
use App\Attendance;
use App\Overtime;
use App\SalaryDeduction;
use App\Salary;

class AdminSalaryController extends Controller
{
    public function index()
    {
        $now = Carbon::now('Asia/Manila');
        $monthNow = $now->month;
        $yearNow = $now->year;

        $total_hour = 0;

        $worker = Worker::all();
        $attendance = Attendance::all();
        $salary = Salary::all();
        $deduction = SalaryDeduction::all();
        $OT = OverTime::all();

        return view('admin.Salary.SalaryIndex',compact('monthNow','yearNow','worker','attendance','total_hour','salary','deduction','OT'));
    }

    public function salarySearch(Request $request)
    {
        $validate = request()->validate
        ([
            'month' => 'required',
            'year' => 'required',
        ]);

        $monthNow = request('month');
        $yearNow = request('year');

        $total_hour = 0;

        $worker = Worker::all();
        $attendance = Attendance::all();
        $salary = Salary::all();
        $deduction = SalaryDeduction::all();
        $OT = OverTime::all();

        return view('admin.Salary.SalarySearch',compact('monthNow','yearNow','worker','attendance','total_hour','salary','deduction','OT'));
    }

    public function salaryEarn(Request $request)
    {
        $monthNow = request('month');
        $yearNow = request('year');
        $month = request('month');
        $year = request('year');
        $id = request('id');
        $total_hour = 0;

        $worker = Worker::find($id);
        $attendance = Attendance::all();
        $salary = Salary::all();
        $OT = OverTime::all();

        return view('admin.Salary.SalaryEarn',compact('monthNow','yearNow','worker','attendance','salary','OT','month','year','total_hour'));
    }
}
