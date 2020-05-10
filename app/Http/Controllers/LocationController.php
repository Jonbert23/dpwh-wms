<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Location;
use App\Worker;
use App\Work;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $validateLocation = request()->validate([
            'Zone' => 'required',
            'Barangay' => 'required',
            'CityMunicipality' => 'required'
        ]);

        $zone = request('Zone');
        $barangay = request('Barangay');
        $city = request('CityMunicipality');

        $location = Location::all();

        foreach($location as $locations)
        {
            if($locations->zoneName == $zone && $locations->barangayName == $barangay && $locations->cityName == $city)
            {
                return back()->withErrors(['message' => 'Location is alreay exist']);
            }
        }

        $loc = new Location;
        $loc->zoneName = $zone;
        $loc->barangayName = $barangay;
        $loc->cityName = $city;

        $loc->save();

        return redirect('/adminSchedule/create');
    }
    public function edit($id)
    {
        // $location = Location::find($id);
        // $worker = Worker::all();
        // $work = Work::all();

        // return view('admin.schedule.ScheduleIndex', compact('location','worker','work'));

        //echo "hello fuckers";
        //return back()->withErrors(['message' => 'Hellow F*ckers']);
    }
    public function update(Request $request, $id)
    {
        
    }

    public function updateLocation(Request $request)
    {
        $validateLocation = request()->validate([
            'Zone' => 'required',
            'Barangay' => 'required',
            'CityMunicipality' => 'required',
            'id' => 'required'
        ]);

        $zone = request('Zone');
        $barangay = request('Barangay');
        $city = request('CityMunicipality');
        $id = request('id');

        $location = Location::all();

        foreach($location as $locations)
        {
            if($locations->zoneName == $zone && $locations->barangayName == $barangay && $locations->cityName == $city)
            {
                return back()->withErrors(['message' => 'Location is alreay exist']);
            }
        }


        $loc = Location::find($id);

        $loc->zoneName = $zone;
        $loc->barangayName = $barangay;
        $loc->cityName = $city;

        //echo $id;

        $loc->save();

        return redirect('/adminSchedule');
    }
}
