<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
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
use App\Logs;
use Auth;

class AdminWorkerController extends Controller
{
   
    public function index()
    {
        $worker = Worker::all();

        $labor = 0;
        $admin = 0;
        $mpp = 0;

        foreach($worker as $workers)
        {
            if($workers->role_id == 1)
            {
                $admin = $admin + 1;
            }
            if($workers->role_id == 2)
            {
                $mpp = $mpp + 1;
            }
            if($workers->role_id == 3)
            {
                $labor = $labor + 1;
            }
        }

        return view('admin.worker.index',compact('worker','labor','admin','mpp'));
    }

    public function create()
    {
        $role = Role::all();
        $skill = Skill::all();
        $section = Section::all();
        $education = Education::all();
        
        return view('admin.worker.create', compact('role','skill','section','education'));
    }

    public function store(Request $request)
    {
        $validateWorker = request()->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'idNumber' => 'required',
            'contactNumber' => 'required',
            'role' => 'required',
            'skill' => 'required',
            'section' => 'required',
            'education' => 'required',
            'zone' => 'required',
            'barangay' => 'required',
            'city' => 'required',
            'zipCode' => 'required',
           
        ]);

        $role = request('role');
        $leave = request('leave');
        $gsis = request('gsis');
        $pagibig = request('pagibig');
        $ph = request('philhealth');
        if($role == 3)
        {
            $validateWorkerOnly = request()->validate([
                'startingDate' => 'required',
                'expiryDate' => 'required',
                'salary' => 'required',
               
            ]);

            if($leave != 0 || $leave != '')
            {
                $validateLeave = request()->validate([
                    'leave' => 'required',
                    'Sleave' => 'required',
                    'Eleave' => 'required',
                ]);
            }

            if($gsis != 0 && $pagibig != 0 && $ph != 0)
            {
                $validateSD = request()->validate([
                    'gsis' => 'required',
                    'pagibig' => 'required',
                    'philhealth' => 'required'
                ]);
            }
           

            $start = request('startingDate');
            $end = request('expiryDate');

            $start = Carbon::createFromFormat('Y-m-d', $start,'Asia/Manila');
            $end = Carbon::createFromFormat('Y-m-d',$end,'Asia/Manila');
            $now = Carbon::now('Asia/Manila')->toDateString();

            if($start < $now)
            {
                return back()->withErrors(['message' => 'Invalid Contract: Contract start date must be onwards than today']);
            }
            if($start > $end)
            {
                return back()->withErrors(['message' => 'Invalid Contract: Contract end date must be onwrads than start date']);
            }
            if($end < $now)
            {
                return back()->withErrors(['message' => 'Invalid Contract: Contract end date must be onwrads than today']);
            }

        }

        $worker = new Worker;
        $worker->firstName = request('firstName');
        $worker->lastname = request('lastName');
        $worker->idNumber = request('idNumber');
        $worker->gender = request('gender');
        $worker->contactNumber = request('contactNumber');
        $worker->status = request('status');
        $worker->password = bcrypt(request('idNumber'));
        $worker->role_id = request('role');
        $worker->skill_id = request('skill');
        $worker->education_id = request('education');
        $worker->section_id = request('section');
        
        if($request->hasfile('idPicture'))
        {
            $file = $request->file('idPicture');
            $imageName = $file->getClientOriginalName();
            $filename = time().''.$imageName;
            $file->move('img/Worker ID', $filename);

            $worker->idPicture = $filename;
        }
        else
        {
            $noImage = 'No Image.png';
            $worker->idPicture = $noImage;
        }
        $emp = Worker::all();
        $idNumber = request('idNumber');
        foreach($emp as $emps)
        {
            if($idNumber == $emps->idNumber)
            {
                return back()->withErrors(['message' => 'Worker ID Number Must be unique.']);
            }
        }
        $worker->save();

        //address---------------------------------------------------------------------------------------------------------------------------------------------------------
        $addID = Worker::all();
        $workerAddress  = 0;
        foreach($addID as $addId)
        {
            $workerAddress = $addId->id;
        }

        $address = new Address;
        $address->worker_id = $workerAddress;
        $address->zone = request('zone');
        $address->barangay = request('barangay');
        $address->city = request('city');
        $address->zipCode = request('zipCode');
        $address->save();
       

        if($role == 3)
        {
            
            $emp = Worker::all();
            $workerId = 0;

            foreach($emp as $workers)
            {
                $workerId = $workers->id;
            }
            //----------------------------------------------------Contract--------------------------------------------------------------------------------------------------

            $startingDate = request('startingDate');
            $expiryDate = request('expiryDate');

            $startingDate = Carbon::createFromFormat('Y-m-d',$startingDate);
            $expiryDate = Carbon::createFromFormat('Y-m-d',$expiryDate);
            $duration = $startingDate->diffInDays($expiryDate);

            $contract = new Contract;
            $contract->startingDate = $startingDate;
            $contract->expiryDate = $expiryDate;
            $contract->duration = $duration;
            $contract->worker_id = $workerId;
            $contract->save();

            $con = Contract::all();
            $conId = 0;

            foreach($con as $cons)
            {
                $conId = $cons->id;
            }

            $cp1 = new ContractPicture;

            if($request->hasfile('cp1'))
            {
                $file = $request->file('cp1');
                $imageName = $file->getClientOriginalName();
                $filename = time().''.$imageName;
                $file->move('contract', $filename);

                $cp1->photo = $filename;
                $cp1->contract_id = $conId;
                $cp1->save();
              
            }

            $cp2 = new ContractPicture;

            if($request->hasfile('cp2'))
            {
                $file = $request->file('cp2');
                $imageName = $file->getClientOriginalName();
                $filename = time().''.$imageName;
                $file->move('contract', $filename);

                $cp2->photo = $filename;
                $cp2->contract_id = $conId;
                $cp2->save();
                
            }

           
        
            //----------------------------------------------------------------Salary--------------------------------------------------------------------------------------
           
            $date = Carbon::now()->toDateString();
            $salary = new Salary;
            $salary->salaryAmount = (request('salary')/22);
            $salary->worker_id = $workerId;
            $salary->date = $date;
            $salary->save();

            //----------------------------------------------------------------Leave---------------------------------------------------------------------------------------
            if($leave != 0 || $leave != '')
            {
                $leave = new LeaveCredit;
                $leave->totalLeave = request('leave');
                $leave->remainingLeave = request('leave');
                $leave->worker_id = $workerId;
                $leave->startDate = request('Sleave');
                $leave->endDate = request('Eleave');
                $leave->save();
            }
           
            //-----------------------------------------------------------------beneficial-------------------------------------------------------------------------------
            if($gsis != 0 || $pagibig != 0 || $ph != 0)
            {
                $dn = Carbon::now('asia/Manila')->toDateString();

                $benefits = new SalaryDeduction;
                $benefits->date = $dn;
                $benefits->GSIS = (request('gsis'));
                $benefits->PAGIBIG = (request('pagibig'));
                $benefits->PHILHEALTH = (request('philhealth'));
                $benefits->worker_id = $workerId;
                $benefits->status = 1;
                $benefits->save();
            }
        }
        //-----------------------------------------------------------------Activity Logs-------------------------------------------------------------------------------
        // $activity = "Registered ".Worker::find($workerId)->firstName." ".Worker::find($workerId)->lastName;
        // $logs = new Logs;
        // $logs->worker_id = Auth::usre()->id;
        // $logs->date =  Carbon::now('Asia/Manila')->toDateString();
        // $logs->time = Carbon::now('Asia/Manila')->toTimeString();
        // $logs->activity = $activity;
        // $logs->save();
        return redirect()->back()->with('message', 'The worker is successfully registered!');
       
    }

    public function show($id)
    {
        $findWorker = Worker::findOrFail($id);
        $contract = Contract::findOrFail($id);

        $picture = "img/Worker ID"."/".$findWorker->idPicture;
        return view('admin.worker.view', compact('findWorker','picture','contract'));
        
    }

    public function edit($id)
    {
        $worker = Worker::findOrFail($id);
        $role = Role::all();
        $skill = Skill::all();
        $section = Section::all();
        $education = Education::all();
        $salary = Salary::all();
        $leave = LeaveCredit::all();
        $deduction = SalaryDeduction::all();

        $address = Address::all();
        $addId = 0;
        foreach($address as $add)
        {
            if($add->worker_id == $id)
            {
                $addId = $add->id;
            }
        }
        $w_address = Address::find($addId);
        $mySalary = 0;
        $myCredit = 0;
        $leaveStart = '';
        $leaveEnd = '';
        $myDeductionGsis = 0;
        $myDeductionPagibig = 0;
        $myDeductionPhilHealth = 0;
        $deductionStatus = 0;

        foreach($salary as $salaries)
        {
            if($salaries->worker_id == $worker->id )
            {
                $mySalary = $salaries->salaryAmount;
            }
        }

        foreach($leave as $leaves)
        {
            if($leaves->worker_id == $worker->id)
            {
                $myCredit = $leaves->totalLeave;
                $leaveStart = $leaves->startDate;
                $leaveEnd = $leaves->endDate;
               
            }
        }

        foreach($deduction as $deductions)
        {
            if($deductions->worker_id == $worker->id)
            {
                $myDeductionPagibig = $deductions->PAGIBIG;
                $myDeductionGsis = $deductions->GSIS;
                $myDeductionPhilHealth = $deductions->PHILHEALTH;
                $deductionStatus = $deductions->status;
            }
        }

        return view('admin.worker.edit', compact('worker','skill','section','education','role','mySalary','myCredit','myDeductionPagibig','myDeductionGsis','myDeductionPhilHealth','leaveStart','leaveEnd','w_address','deductionStatus'));
    }

    public function update(Request $request, $id)
    {
        $validateWorker = request()->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'idNumber' => 'required',
            'contactNumber' => 'required',
            'role' => 'required',
            'skill' => 'required',
            'section' => 'required',
            'education' => 'required',
            'zone' => 'required',
            'barangay' => 'required',
            'city' => 'required',
            'zipCode' => 'required'
        ]);

        $role = request('role');
        $leave = request('leave');
        $gsis = request('gsis');
        $pagibig = request('pagibig');
        $ph = request('philhealth');
        if($role == 3)
        {
            $validateWorkerOnly = request()->validate([
                'salary' => 'required',
            ]);

            if($leave != 0 || $leave != '')
            {
                $validateLeave = request()->validate([
                    'leave' => 'required',
                    'Sleave' => 'required',
                    'Eleave' => 'required',
                ]);
            }

            if($gsis != 0 && $pagibig != 0 && $ph != 0)
            {
                $validateSD = request()->validate([
                    'gsis' => 'required',
                    'pagibig' => 'required',
                    'philhealth' => 'required'
                ]);
            }
        }

        $worker = Worker::findOrFail($id);

        $worker->firstName = request('firstName');
        $worker->lastname = request('lastName');
        $worker->idNumber = request('idNumber');
        $worker->gender = request('gender');
        $worker->contactNumber = request('contactNumber');
        $worker->status = request('status');
        $worker->password = bcrypt(request('idNumber'));
        $worker->role_id = request('role');
        $worker->skill_id = request('skill');
        $worker->education_id = request('education');
        $worker->section_id = request('section');
        

        if($request->hasfile('idPicture'))
        {
            $file = $request->file('idPicture');
            $imageName = $file->getClientOriginalName();
            $filename = time().''.$imageName;
            $file->move('img/Worker ID', $filename);

            $worker->idPicture = $filename;
        }
        $worker->save();
        //adrsess--------------------------------------------------------------------------------------------------------------
        $address = Address::all();
        $addId = 0;
       
        foreach($address as $add)
        {
            if($add->id == $id)
            {
                $addId = $add->id;
            }
        }
        
        $address = Address::find($addId);
        $address->zone = request('zone');
        $address->barangay = request('barangay');
        $address->city = request('city');
        $address->zipCode = request('zipCode');
        $address->save();

        if($role == 3)
        {
            //-----------------------------------------------------------------beneficial-------------------------------------------------------------------------------
            $deduction = SalaryDeduction::all();
            $sd = 0;
            $old_gsis = 0;
            $old_pagibig = 0;
            $old_ph = 0;
            $dsExist = 0;
            foreach($deduction as $deduct)
            {
                if($deduct->worker_id == $id)
                {
                    $sd = $deduct->id;
                    $old_gsis = $deduct->GSIS;
                    $old_pagibig = $deduct->PAGIBIG;
                    $old_ph = $deduct->PHILHEALTH;
                    $dsExist = 1;
                }
            }
            if( $dsExist == 1)
            {
                $ds = SalaryDeduction::find($sd);
                $ds->status = request('deductionStatus');
               $ds->save();    
            }
           
            if($gsis != $old_gsis || $pagibig != $old_pagibig || $ph != $old_ph)
            {
                if( $dsExist == 1)
                {
                    $ds->status = 0;
                    $ds->save();   
                }
               
                $dn = Carbon::now('asia/Manila')->toDateString();
                $benefits = new SalaryDeduction;
                $benefits->date = $dn;
                $benefits->GSIS = (request('gsis'));
                $benefits->PAGIBIG = (request('pagibig'));
                $benefits->PHILHEALTH = (request('philhealth'));
                $benefits->worker_id = $id;
                $benefits->status = request('deductionStatus');
                $benefits->save();
            }

            //----------------------------------------------------------------Salary--------------------------------------------------------------------------------------
            $sal = Salary::all();
            $oldSal = 0;
            foreach($sal as $salary)
            {
                if($salary->worker_id == $id)
                {
                    $oldSal = $salary->salaryAmount;
                }
            }
            if($oldSal != request('salary'))
            {
                $date = Carbon::now()->toDateString();
                $salary = new Salary;
                $salary->salaryAmount = request('salary');
                $salary->worker_id = $id;
                $salary->date = $date;
                $salary->save();
            }
           
            ///----------------------------------------------------------------Leave---------------------------------------------------------------------------------------
            $workerLeave = LeaveCredit::all();
            $leaveId = 0;
            $lcExist = 0;

            foreach($workerLeave as $wl)
            {
                if($wl->worker_id == $id)
                {
                    $leaveId = $wl->id;
                    $lcExist = 1;
                }
            }
            if($lcExist == 1)
            {
                if($leave != 0 || $leave != '')
                {
                    $leave = LeaveCredit::find($leaveId);
                    $leave->totalLeave = request('leave');
                    $leave->remainingLeave = request('leave');
                    $leave->worker_id = $id;
                    $leave->startDate = request('Sleave');
                    $leave->endDate = request('Eleave');
                    $leave->save();
                }
            }
            if($lcExist == 0)
            {
                if($leave != 0)
                {
                    $leave = new LeaveCredit;
                    $leave->totalLeave = request('leave');
                    $leave->remainingLeave = request('leave');
                    $leave->worker_id = $id;
                    $leave->startDate = request('Sleave');
                    $leave->endDate = request('Eleave');
                    $leave->save();
                }
            }
            
        }
       return redirect()->back()->with('message', 'The worker profile is successfully updated!');
    }

    public function view()
    {
        $id = request('id');
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
        return view('admin.worker.view', compact('findWorker','picture','contract','workerAdd','dateNow','salary','deduction','leave'));
    }

}
