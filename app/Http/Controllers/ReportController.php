<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Worker;
use App\Attendance;
use App\Overtime;
use App\SalaryDeduction;
use App\Salary;
use App\Contract;

class ReportController extends Controller
{
    public function dtrReport()
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

        return view('admin.report.DTRReport',compact('monthNow','yearNow','worker','attendance','total_hour','salary','deduction','OT'));      
    }
    public function dtrReportSearch(Request $request)
    {
        $validate = request()->validate
        ([
            'month' => 'required',
            'year' => 'required',
        ]);
        $now = Carbon::now('Asia/Manila');
        $currentYear = $now->year;

        $monthNow = request('month');
        $yearNow = request('year');

        $total_hour = 0;

        $worker = Worker::all();
        $attendance = Attendance::all();
        $salary = Salary::all();
        $deduction = SalaryDeduction::all();
        $OT = OverTime::all();

        return view('admin.report.DTRReportSearch',compact('monthNow','yearNow','worker','attendance','total_hour','salary','deduction','OT','currentYear'));
    }

    public function contractReport()
    {
        $now = Carbon::now('Asia/Manila');
        $monthNow = $now->month;
        $yearNow = $now->year;
        $dateNow = Carbon::now('Asia/Manila')->toDateString();
        $contract = Contract::all();

        return view('admin.report.ContractReport',compact('monthNow','yearNow','contract','dateNow'));
    }

    public function contractReportSearch(Request $request)
    {
        $validate = request()->validate
        ([
            'month' => 'required',
            'year' => 'required',
        ]);
        $now = Carbon::now('Asia/Manila');
        $currentYear = $now->year;
        $monthNow = request('month');
        $yearNow = request('year');

        $dateNow = Carbon::now('Asia/Manila')->toDateString();
        $contract = Contract::all();

        return view('admin.report.ContractReportSearch',compact('monthNow','yearNow','contract','dateNow','currentYear'));
    }

    public function salaryReport()
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

        return view('admin.report.SalaryReport',compact('monthNow','yearNow','worker','attendance','total_hour','salary','deduction','OT'));
    }

    public function salaryReportSearch()
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

        return view('admin.report.SalaryReport',compact('monthNow','yearNow','worker','attendance','total_hour','salary','deduction','OT'));
    }
}
