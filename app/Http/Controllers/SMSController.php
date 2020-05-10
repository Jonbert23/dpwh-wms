<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\contract;
use Carbon\Carbon;
use Twilio\Rest\Client;
use App\Worker;

class SMSController extends Controller
{
    public function notify()
    {
        $contract = Contract::all();
        $monthNow = Carbon::now('Asia/Manila')->month;
        $yearNow = Carbon::now('Asia/Manila')->year;


        foreach($contract as $contracts)
        {
            $contractMonth = Carbon::createFromFormat('Y-m-d', $contracts->expiryDate)->month;
            $contractYear = Carbon::createFromFormat('Y-m-d', $contracts->expiryDate)->year;
            
            if($monthNow == $contractMonth && $yearNow == $contractYear)
            {
                $id = $contracts->worker_id;
                
                $sid = 'ACc7070963a3b4fcd92e9d0cd6aa5ac1f0';
                $token = '5cf472b18b4a148b85eb6c5f69ff7b21';

                $smsReceiver = Worker::find($id)->contactNumber;
                $smsReceiver = '+63'.$smsReceiver;  
                $sms = "Your Contract is going to expire this month \n Expire Date: ".$contracts->expiryDate;

                $client =  new Client($sid,$token);
                $client->messages->create($smsReceiver,['from' => '+19798032820','body' => $sms]);
            }
        }
        return redirect()->back()->with(['message', 'Workers are successfully notified']);
    }
}
