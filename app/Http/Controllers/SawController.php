<?php

namespace App\Http\Controllers;

use App\VictimProfile;
use Illuminate\Http\Request;
use App\Maps;
use App\Saw;

class SawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web',['only' => 'storeresult']);
    }
    public function sawvictim(Request $request)
    {
        $profile = VictimProfile::paginate(1);

        // dd($profile);

        return view('saw')->with('profile', $profile);
    }
    public function storeresult(Request $request)
    {
        $id = $request->input('id');
        $maps = new Maps();
        $maps->victim_id = $id;
        $maps->user_id = auth()->user()->id;
        $maps->lat = $request->input('sawlat');
        $maps->lon = $request->input('sawlon');
        $maps->save();

        $saw = new Saw();
        $saw->user_id  = auth()->user()->id;
        $saw->victim_id = $request->input('id');
        return back();
    }
}
