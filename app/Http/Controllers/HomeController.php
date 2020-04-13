<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\VictimProfile;
use App\Comment;
use App\Saw;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comment = Comment::get();
        $saw = Saw::get();
        $solvedposts = VictimProfile::where(['user_id' => auth()->user()->id, 'status' => '1'])->get();
        $notsolvedposts = VictimProfile::where(['user_id' => auth()->user()->id, 'status' => '0'])->get();
        // dd($solvedposts);
        $data = array(
            'solvedposts' => $solvedposts,
            'notsolvedposts' => $notsolvedposts,
            'comment' => $comment,
            'saw' => $saw,
        );
        return view('home')->with($data);
    }
    public function solvedcase(Request $request)
    {
        $id = explode('?', $request->getRequestUri());
        $lastid = end($id);
        // dd($lastid);
        $profile = VictimProfile::find($lastid);
        // dd($profile);
        $profile->status = 1;
        $profile->update();
        return back();
    }
}
