<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Contract;
use App\Worker;
use Carbon\Carbon;
use App\ContractPicture;

class AdminContractController extends Controller
{
    public function index()
    {
       $worker = Worker::all();
       $contract = Contract::all();
       $count = 0;
       $new = 0;
       $all = 0;
       $expire = 0;
       $now = Carbon::now('Asia/Manila');
       $nowMonth = $now->month;
       $nowYear = $now->year;

       foreach($contract as $contracts)
       {
           $expiry = Carbon::createFromFormat('Y-m-d', $contracts->expiryDate);
           $start = Carbon::createFromFormat('Y-m-d', $contracts->startingDate);
            if($expiry >= $now)
            {
                $all = $all + 1;
            }

            if($expiry->month == $nowMonth && $expiry->year == $nowYear)
            {
                $expire = $expire + 1;
            }

            if($start->month == $nowMonth && $start->year == $nowYear)
            {
                $new = $new + 1;
            }

            //echo $expiry->month.'  '. $expiry->year.'<br>';
       }
        return view('admin.contract.ContractIndex', compact('worker','contract','count','all','new','expire'));
    }

    public function registerContract()
    {
        $worker = Worker::all();
        $contract = Contract::all();

        $temp = false;


       return view('admin.contract.RegisterContract', compact('worker','contract'));
    }

    public function expiringContract()
    {
        $worker = Worker::all();
        $contract = Contract::all();
        return view('admin.contract.ExpiringContract', compact('worker','contract'));
    }

    public function createContract($id)
    {
        $worker = Worker::findOrFail($id);
        $contract = Contract::all();
        $lastD = 0;
        $lastS = 0;
        $lastE = 0;

        return view('admin.contract.ContractCreat', compact('worker','contract','lastD','lastS','lastE'));
    }

    public function store(Request $request)
    {
        $validateContract = request()->validate([
            'startDate' => 'required',
            'endDate' => 'required',
            'id' => 'required'
        ]);
        
        $startDate = request('startDate');
        $expireDate = request('endDate');
        $workerId = request('id');

        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $expireDate = Carbon::createFromFormat('Y-m-d', $expireDate);
        $currentDate = Carbon::now();
        $duration = $startDate->diffInDays($expireDate);

        if($startDate < $currentDate)
        {
            return back()->withErrors(['message' => 'Invalid Contract: Contract start date must onwards than today/Current date']);
        }
        if($startDate > $expireDate)
        {
            return back()->withErrors(['message' => 'Invalid Contract: Contract end date must be onwards than the coontract start date']);
        }

        if($expireDate < $currentDate)
        {
            return back()->withErrors(['mesage' => 'Invalid Contract: Contract end date must onwards that today/Current date']);
        }

        $con = Contract::all();
        $lastExpiry = 0;
        foreach($con as $cons)
        {
            if($cons->worker_id == $workerId)
            {
                $lastExpiry = $cons->expiryDate;
            }
        }

        if($lastExpiry >= $startDate)
        {
            return back()->withErrors(['mesage' => 'Invalid Contract: Contract overlapping']);
        }

        $contract = new Contract;
        $contract->startingDate = $startDate;
        $contract->expiryDate = $expireDate;
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
        
        return redirect()->back()->with('message', 'The contract is successfully registered!');
    }

    public function editContract($workerId,$contractId)
    {
        $contract = Contract::find($contractId);
        $worker = Worker::find($workerId);
        $contractphoto = ContractPicture::all();

        return view('admin.contract.ContractEdit',compact('contract','worker','contractphoto'));
    }

    public function update(Request $request, $id)
    {
        $validateContract = request()->validate([
            'startDate' => 'required',
            'endDate' => 'required',
            'id' => 'required',
            'contractId' => 'required'
        ]);
        
        $startDate = request('startDate');
        $expireDate = request('endDate');
        $workerId = request('id');
        $contractId = request('contractId');

        $startDate = Carbon::createFromFormat('Y-m-d', $startDate);
        $expireDate = Carbon::createFromFormat('Y-m-d', $expireDate);
        $currentDate = Carbon::now();
        $duration = $startDate->diffInDays($expireDate);

        if($startDate < $currentDate)
        {
            return back()->withErrors(['message' => 'Invalid Contract: Contract start date must onwards than today/Current date']);
        }
        if($startDate > $expireDate)
        {
            return back()->withErrors(['message' => 'Invalid Contract: Contract end date must be onwards than the coontract start date']);
        }

        if($expireDate < $currentDate)
        {
            return back()->withErrors(['mesage' => 'Invalid Contract: Contract end date must onwards that today/Current date']);
        }

        $con = Contract::all();
        $lastExpiry = 0;
        $lastExpiryId = 0;
        //echo $workerId;
        foreach($con as $cons)
        {
           if($cons->expiryDate <= $startDate->toDateString())
           {
               if($cons->id != $contractId && $workerId == $cons->worker_id)
               {
                    return back()->withErrors(['mesage' => 'Invalid Contract: Contract overlapping '.$cons->expiryDate." ".$cons->id]);
               }
           }
        }
      
        // if($lastExpiry >= $startDate->toDateString())
        // {
        //     return back()->withErrors(['mesage' => 'Invalid Contract: Contract overlapping']);
        // }

        $contract = Contract::find($contractId);
        $contract->startingDate = $startDate;
        $contract->expiryDate = $expireDate;
        $contract->duration = $duration;
        $contract->worker_id = $workerId;
        $contract->save();

        return redirect()->back()->with('message', 'The contract is successfully updated!');
    
    }

    public function show($id)
    {
        $worker = Worker::find($id);
        $contract = Contract::all();
        $conPhoto = ContractPicture::all();
        $now = Carbon::now('Asia/Manila');

        return view('admin.contract.ContractView',compact('worker','contract','now','conPhoto'));
    }

    public function UpdateContractPhoto(Request $request)
    {
        $cpId = request('cp');
        $cp = ContractPicture::find($cpId);

        if($request->hasfile('cp1'))
        {
            $file = $request->file('cp1');
            $imageName = $file->getClientOriginalName();
            $filename = time().''.$imageName;
            $file->move('contract', $filename);

            
            $cp->photo = $filename;
            $cp->save();
        }
        return redirect()->back()->with('message', 'Contract Photo successfully Updated');
    }
}
