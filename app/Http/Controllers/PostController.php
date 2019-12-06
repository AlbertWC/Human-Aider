<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VictimProfile;
use App\Comment;
use App\User;
use App\Maps;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profile = VictimProfile::get();
        return view('posts.index')->with('profile', $profile);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'type' => 'required',
            'description' => 'required',
            'height' => 'required|max:240',
            'gender' => 'required',
            'victim_image' => 'image|nullable|max:199999',
            'ffname' => 'required|max:30',
            'ffcontact' => 'required|max:15',
        ]);

        if($request->hasFile('victim_image'))
        {
            $victimImageWithExt  = $request->file('victim_image')->getClientOriginalName();

            $victimImage = pathinfo($victimImageWithExt, PATHINFO_FILENAME);

            $victimImageExtension = $request->file('victim_image')->getClientOriginalExtension();

            $victimImageToStore = $victimImage."_".time()."_".$victimImageExtension;

            $path = $request->file('victim_image')->storeAs('public/victim_image', $victimImageToStore);
        }

        $profile = new VictimProfile();
        $profile->type = $request->input('type');
        $profile->description = $request->input('description');
        $profile->height = $request->input('height');
        $profile->gender = $request->input('gender');
        $profile->victim_image = $victimImageToStore;
        $profile->victimcurrentlat = $request->input('lat');
        $profile->victimcurrentlon = $request->input('lon');
        $profile->ffname = $request->input('ffname');
        $profile->ffcontact  =$request->input('ffcontact');
        $profile->save();

        $maps = new Maps();
        $maps->victim_id = $request->session()->get('victim_id');
        $maps->user_id = auth()->user()->id;
        $maps->lat = $request->input('lat');
        $maps->lon = $request->input('lon');

        return redirect('posts')->with('success', 'Create Profile Successed');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        $profile = VictimProfile::find($id);
        $request->session()->put('victim_id', $id);
        $comment = Comment::where('victim_id' ,'=', $id)->get();
        $maps = Maps::where('victim_id','=', $id)->get();
        $locationlist = array();
        foreach($maps as $mapslist)
        {
            $locationlist[] = ['lat'=> $mapslist->lat , 'lon' => $mapslist->lon];
        }
        $data = array(
            'profile' => $profile,
            'comment' => $comment,
            'maps' => $maps,
            'locationlist' => $locationlist,
        );
        // dd($locationlist);
        // return($comment);
        // dd($profile->comment()->comment);
        // $id = $request->session()->put('victim_id');
        return view('posts.show')->with($data);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function addcomment(Request $request)
    {
        $this->validate($request, [
            'comment' => 'required'
            
        ]);
        $comment = new Comment();
        $comment->victim_id = $request->session()->get('victim_id');
        $comment->user_id = auth()->user()->id;
        $comment->comment = $request->input('comment');
        $comment->save();

        $maps = new Maps();
        $maps->victim_id = $request->session()->get('victim_id');
        $maps->user_id = auth()->user()->id;
        $maps->lat = $request->input('commentlat');
        $maps->lon = $request->input('commentlon');
        $maps->save();

        return back();
    }

}
