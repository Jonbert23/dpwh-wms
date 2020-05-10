<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Work;

class WorkController extends Controller
{
    public function store(Request $request)
    {
       $validateWork = request()->validate([
           'WorkName' => 'required'
       ]);
    
       $workName = request('WorkName');

       $work = Work::all();
       foreach($work as $works)
       {
           if($workName == $works->name)
           {
               return back()->withErrors(['message' => 'Work name already exist']);
           }
       }
       
       $subWork = new Work;
       $subWork->name = $workName;

       $subWork->save();
       return redirect('/adminSchedule/create');
    }
   
    public function updateWork(Request $request)
    {
        $validateWork = request()->validate([
            'WorkName' => 'required',
            'workId' => 'required'
        ]);
     
        $workName = request('WorkName');
        $id = request('workId');
 
        $work = Work::all();
        foreach($work as $works)
        {
            if($workName == $works->name)
            {
                return back()->withErrors(['message' => 'Work name already exist']);
            }
        }
        
        $subWork = Work::find($id);
        $subWork->name = $workName;
 
        $subWork->save();
        return redirect('/adminSchedule');
    }

}
