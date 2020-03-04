<?php

namespace App\Http\Controllers;

use App\VictimProfile;
use Illuminate\Http\Request;
use App\Maps;
use App\Saw;
use App\Comment;

class SawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:web',['only' => 'storeresult']);
    }
    public function sawvictim(Request $request)
    {
        $profile = VictimProfile::all();
        $sawlist = Saw::all();
        $sawprofile = Saw::paginate(1);
        $profilelink = VictimProfile::paginate(1);
        $data = array(
            'profile' => $profile,
            'sawlist' => $sawlist,
            'sawprofile' => $sawprofile,
            'profilelink' => $profilelink,
        );
        // dd($profile);

        return view('saw')->with($data);
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
        if($request->input('btnyesno') == 'yes')
        {
            $saw->sawvictim = 1;
        }
        else
        {
            $saw->sawvictim = 0;
        }
        $saw->save();

        $comment = new Comment();

        return back();
    }
}
