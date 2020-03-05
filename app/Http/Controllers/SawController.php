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
        $profile = VictimProfile::simplePaginate(1);
        $sawlist = Saw::all();
        $page = $request->get('page');
        // dd($page);
        $data = array(
            'profile' => $profile,
            'sawlist' => $sawlist,
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
        $comment = new Comment();
        $saw->user_id  = auth()->user()->id;
        $saw->victim_id = $request->input('id');
        $comment->victim_id = $request->input('id');
        $comment->user_id = auth()->user()->id;
        if($request->input('btnyes') == 'yes')
        {
            $saw->sawvictim = 1;
            $comment->comment = "I saw the victim";
        }
        else if($request->input('btnno') == 'no')
        {
            $saw->sawvictim = 0;
            $comment->comment = "I did not saw the victim";
        }
        $saw->save();
        $comment->save();

        return ;
    }
}
