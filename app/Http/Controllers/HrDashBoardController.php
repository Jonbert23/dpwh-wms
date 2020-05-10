<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Worker;
use App\Contract;
use App\Schedule;
use Carbon\Carbon;
use App\Work;
use App\Location;

class HrDashBoardController extends Controller
{
    public function index()
    {
        $worker = Worker::all();
        $contract = Contract::all();
        $schedule = Schedule::all();
        $work = Work::all();
        $location = Location::all();
        $dateNow = Carbon::now('Asia/Manila')->toDateString();
        $yearNow = Carbon::now('Asia/Manila')->year;
        $monthNow = Carbon::now('Asia/Manila')->month;


        $admin = 0;
        $accounting = 0;
        $construction = 0;
        $maintenance = 0;
        $planning = 0;
        $forgotten = 0;
        $totalWorker = 0;
        $totalContract = 0;
        $staff = 0;
        $scheduled = 0;
        $workCounter = 0;

        foreach($worker as $workers)
        {
            if($workers->status == 1 && $workers->role_id == 3)
            {
                if($workers->section_id == 1)
                {
                    $accounting = $accounting + 1;
                }
    
                if($workers->section_id == 2)
                {
                    $admin = $admin + 1;
                }
    
                if($workers->section_id == 3)
                {
                    $construction = $construction + 1;
                }
    
                if($workers->section_id == 4)
                {
                    $maintenance = $maintenance + 1;
                }
    
                if($workers->section_id == 5)
                {
                    $planning = $planning + 1;
                }
    
                if($workers->section_id == 6)
                {
                    $forgotten = $forgotten + 1;
                }
    
                $totalWorker =  $totalWorker + 1;
            }

           
            else
            {
                $staff = $staff + 1;
            }

        }
        foreach($contract as $contracts)
        {
            if($contracts->expiryDate > $dateNow)
            {
                $totalContract =  $totalContract + 1;
            }
        }

        foreach($worker as $workers)
        {
            foreach($schedule as $sched)
            {
                if($workers->id == $sched->worker_id && $sched->dateTo > $dateNow)
                {
                    $scheduled =  $scheduled + 1;
                }
            }
        }

        return view('hr.dashboard', compact('admin','accounting','construction','planning','maintenance','forgotten',
        'totalWorker','totalContract','staff','scheduled','work','schedule','dateNow','workCounter','worker','location','contract',
        'monthNow','yearNow'));
    }
}
