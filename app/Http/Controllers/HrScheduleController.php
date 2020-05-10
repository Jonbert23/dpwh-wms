<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Schedule;
use App\Worker;
use App\Location;
use App\Work;
use Carbon\Carbon;
use Twilio\Rest\Client;
use App\Logs;
use Auth;

class HrScheduleController extends Controller
{
    public function index()
    {
        $worker = Worker::all();
        $location = Location::all();
        $work = Work::all();
        $schedule = Schedule::all()->sortBy('work_id');
        $schedloc = Schedule::all()->sortBy('location_id');
        $now = Carbon::now('Asia/Manila')->toDateString();
        $scheduled = 0;
        $unscheduled = 0;
        $n_worker = 0;//
        $task = 0;
        $lastdata = 0;
        $lastloc = 0;
        $n_loc = 0;

        foreach($work as $works)
        {
            foreach($schedule as $sched)
            {
                if($works->id == $sched->work_id && $sched->dateTo > $now && $sched->dateFrom < $now && $lastdata != $works->id)
                {
                    $task = $task + 1;
                    $lastdata = $works->id;
                }
            }
        }

        foreach($location as $loc)
        {
            foreach($schedloc as $sched)
            {
                if($loc->id == $sched->work_id && $sched->dateTo > $now && $sched->dateFrom < $now && $lastloc != $loc->id)
                {
                    $n_loc = $n_loc + 1;
                    $lastloc = $loc->id;
                }
            }
        }

        //echo $task;
       
       return view('hr.schedule.ScheduleIndex', compact('worker','location','work','schedule','now','n_worker','scheduled','unscheduled','task', 'n_loc'));
    }

    public function create()
    {
        $worker = Worker::all()->sortBy('firstName');
        $work = Work::all()->sortBy('name');
        $location = Location::all()->sortBy('zoneName');
        $schedule = Schedule::all();
        $dateNow = Carbon::now('Asia/Manila')->toDateString();
        $lastSchedId = 0;
        $exist = 0;

        return view('hr.schedule.ScheduleCreate', compact('worker','work','location','schedule','dateNow','lastSchedId','exist'));
    }

    public function store(Request $request)
    {
        $validateSchedule = $request->validate([
            'workName' => 'required',
            'designation' => 'required',
            'mpp' => 'required',
            'dateFrom' => 'required',
            'dateTo' => 'required',
            'workers' => 'required'
        ]);

        $worker = request('workers');
        $latestSched = "";
        $mpp = request('mpp');

        $startDate = request('dateFrom');
        $endDate = request('dateTo');


        $startDate = Carbon::CreateFromFormat('Y-m-d', $startDate);
        $endDate = Carbon::CreateFromFormat('Y-m-d', $endDate);
        $now = Carbon::now();
        
        $schedule = Schedule::all();
        
        foreach($worker as $workers)
        {
            foreach($schedule as $schedules)
            {
                if($workers == $schedules->worker_id)
                {
                    $latestSched = $schedules->dateTo;
                }
            }
            
            $w = Worker::find($workers);
            if($latestSched > $startDate)
            {
               return back()->withErrors(['message' => "Worker"." ".$w->firstName.' '. $w->lastName." Schedule Overlap."]);
            }
            else if($startDate < $now )
            {
                return back()->withErrors(['message' => "Invalid Schedule: Start date must be onwards to the current date "]);
            }
            else if($startDate > $endDate)
            {
                return back()->withErrors(['message' => "Invalid Schedule: End date must be onwards than the start date "]);
            }
            else
            {
                $sched = new Schedule;

                $sched->work_id = request('workName');
                $sched->location_id = request('designation');
                $sched->mpp = request('mpp');
                $sched->dateFrom = $startDate;
                $sched->dateTo = $endDate;
                $sched->worker_id = $workers;
                $sched->save();


                $sid = 'ACc7070963a3b4fcd92e9d0cd6aa5ac1f0';
                $token = '5cf472b18b4a148b85eb6c5f69ff7b21';

                $smsReceiver = Worker::find($workers)->contactNumber;
                $smsReceiver = '+63'.$smsReceiver;  
                $location = Location::find(request('designation'));
                $task = Work::find(request('workName'));
                $mpp = Worker::find(request('mpp'));
                $sms = "\n Task: ".$task->name."\n Location: ". $location->zoneName." ". $location->barangayName.", ". 
                        $location->cityName."\n MPP :".$mpp->firstName." ".
                        $mpp->lastName."\n Start Date: ".$startDate->toDateString()."\n End Date: ".$endDate->toDateString();

                

                $client =  new Client($sid,$token);
                $client->messages->create($smsReceiver,['from' => '+19798032820','body' => $sms]);

            }
        }

        //logs---------------------------------------------------------------------------------------------------------------------------------------------------------
        $fname = Worker::find($mpp)->firstName;
        $lname = Worker::find($mpp)->lastName;
        $activity = "Created schedule for ".$fname." ".$lname;
        $logDate = Carbon::now('Asia/Manila');

        $logs = new Logs;
        $logs->worker_id = Auth::user()->id;
        $logs->date =  $logDate->toDateString();
        $logs->time = $logDate->toTimeString();
        $logs->activity = $activity;
        $logs->save();

        return redirect()->back()->with('message', 'Task successfully scheduled.');
    }

    public function show($id)
    {
        //echo $id;

        $worker = Worker::find($id);
        $sched = Schedule::all();
        $mpp = Worker::all();
        $now = Carbon::now('Asia/Manila')->toDateString();
        return view('hr.schedule.ScheduleView', compact('worker','sched','mpp','now'));
    }

    public function edit($id)
    {
        $worker = Worker::all();
        $location = Location::all();
        $work = Work::all();
        $schedule = Schedule::find($id);
        return view('hr.schedule.ScheduleEdit', compact('worker','location','work','schedule'));
    }

    public function update(Request $request, $id)
    {
        //echo "Hello Fuckers";
        // $validateSched = $request->validate([
        //     'worker' => 'required',
        //     'mpp' => 'required',
        //     'task' => 'required',
        //     'designation' => 'required',
        //     'dateFrom' => 'required',
        //     'dateTo' => 'required'
        // ]);

        $start = request('dateFrom');
        $end = request('dateTo');
        $currentSched = "";

        $start = Carbon::CreateFromFormat('Y-m-d', $start);
        $end = Carbon::CreateFromFormat('Y-m-d', $end);
        $now = Carbon::now();

        $worker = request('worker');
        $mpp = request('mpp');

        $schedule = Schedule::find($id);
        $worker = $schedule->worker_id;
        $workerSched = Schedule::all();

        // foreach($workerSched as $sched)
        // {
        //     if($sched->dateTo <= $start->toDateString())
        //     {
        //         if($sched->id != $schedule->id && $sched->worker_id ==  $schedule->worker_id)
        //         {
        //             return back()->withErrors(['message' => 'Invalid Schedule: Schedule Overlap']);
        //         }
        //     }
        // }
        
        if($start < $now )
        {
            return back()->withErrors(['message' => "Invalid Schedule: Start date must be onwards to the current date "]);
        }
        else if($start > $end)
        {
            return back()->withErrors(['message' => "Invalid Schedule: End date must be onwards than the start date "]);
        }
        else
        {
            $schedule->mpp = request('mpp');
            $schedule->work_id = request('task');
            $schedule->location_id = request('designation');
            $schedule->dateFrom = $start;
            $schedule->dateTo = $end;

            $schedule->save();

            //logs---------------------------------------------------------------------------------------------------------------------------------------------------------
            $fname = Worker::find($id)->firstName;
            $lname = Worker::find($id)->lastName;
            $activity = "Updated Schedule of ".$fname." ".$lname;
            $logDate = Carbon::now('Asia/Manila');

            $logs = new Logs;
            $logs->worker_id = Auth::user()->id;
            $logs->date =  $logDate->toDateString();
            $logs->time = $logDate->toTimeString();
            $logs->activity = $activity;
            $logs->save();

            return redirect()->back()->with('message', 'Task successfully updated.');

           // echo "hello fuckers";

        }
        


    }

   
}
