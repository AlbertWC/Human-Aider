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
        $posts = VictimProfile::where('user_id','=' , auth()->user()->id)->get();
        $data = array(
            'posts' => $posts,
            'comment' => $comment,
            'saw' => $saw,
        );
        return view('home')->with($data);
    }
    public function solved()
    {
        
    }
}
