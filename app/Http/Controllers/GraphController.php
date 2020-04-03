<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Maps;
use App\VictimProfile;
class GraphController extends Controller
{
    public function index()
    {
        $comments = Comment::all();
        $posts = VictimProfile::all();
        $maps = Maps::all();
        $data = array([
            '$comments' => $comments,
            '$posts' => $posts,
            '$maps' => $maps,
        ]);
        return view('display')->with($data);
    }
}
