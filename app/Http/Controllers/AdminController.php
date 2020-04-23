<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\VictimProfile;
use App\Comment;
use App\Saw;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
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
    public function report()
    {
        $posts = VictimProfile::get();
        $data = array(
            'posts' => $posts
        );
        return view('reports.reports')->with($data);
    }
    public function reportdetails($id)
    {
        $post = VictimProfile::find($id);
        return view('reports.details')->with('post',$post);
    }
}
