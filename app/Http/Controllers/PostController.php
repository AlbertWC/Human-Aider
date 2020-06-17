<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\VictimProfile;
use App\Comment;
use App\User;
use App\Maps;
use App\Saw;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {   
        $this->middleware('auth:web',['only'=> ['create','store','addcomment']]);
        
    }
    public function index()
    {
        $profile = VictimProfile::get();
        // dd($profile);
        // $solvedprofile = VictimProfile::where('status','=','1')->get();
        // $data = array(
        //     'notsolvedprofile' => $notsolvedprofile,
        //     'solvedprofile' => $solvedprofile,
        // );
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
            'victim_image' => 'required|image|max:199999',
            'ffname' => 'required|max:30',
            'ffcontact' => 'required|max:15',
        ]);
        // get address
        $lat = $request->input('lat');
        $long = $request->input('lon');
        
        $address = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?latlng=$lat,$long&key=AIzaSyBVmmUEe9rAk8JKVDzWUJcXFToBpG023pA");
        $json_address = json_decode($address);
        $full_address = $json_address->results[0]->formatted_address;
        $statestring = explode(', ', $full_address);
        dd($statestring);
        // dd($statestring[count($statestring)-2]);
        // $state = $json_address->results[0]->address_components[count($json_address->results[0]->address_components)-2]->long_name;
        $state = $statestring[count($statestring)-2];
        dd($state);
        // $country = $json_address->results[0]->address_components[count($json_address->results[0]->address_components)-1]->long_name;
        $country = $statestring[count($statestring)-1];
        
        if($request->hasFile('victim_image'))
        {
            $victimImageWithExt  = $request->file('victim_image')->getClientOriginalName();
            $victimImage = pathinfo($victimImageWithExt, PATHINFO_FILENAME);
            $victimImageExtension = $request->file('victim_image')->getClientOriginalExtension();
            $victimImageToStore = $victimImage."_".time().".".$victimImageExtension;
            $path = $request->file('victim_image')->storeAs('public/victim_image', $victimImageToStore);
        }

        $profile = new VictimProfile();
        $profile->type = $request->input('type');
        $profile->description = $request->input('description');
        $profile->height = $request->input('height');
        $profile->gender = $request->input('gender');
        $profile->victim_image = $victimImageToStore;
        $profile->user_id = auth()->user()->id;
        $profile->victimcurrentlat = $request->input('lat');
        $profile->victimcurrentlon = $request->input('lon');
        $profile->ffname = $request->input('ffname');
        $profile->ffcontact  =$request->input('ffcontact');
        $profile->address  = $full_address;
        $profile->status = 0;
        $profile->state = $state;
        $profile->country = $country;
        $profile->save();

        $maps = new Maps();
        $maps->victim_id = $profile->id;
        $maps->user_id = auth()->user()->id;
        $maps->lat = $request->input('lat');
        $maps->lon = $request->input('lon');
        $maps->save();

        $comment = new Comment();
        $comment->victim_id = $profile->id;
        $comment->user_id = auth()->user()->id;
        $comment->comment = "Last seen is here";
        $comment->save();

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
        $saw = Saw::all();
        $locationlist = array();
        $yescounter = 0;
        $nocounter = 0;
        $commentcounter = 0;
        foreach($maps as $mapslist)
        {
            $locationlist[] = ['lat'=> $mapslist->lat , 'lon' => $mapslist->lon];
        }
        foreach($saw as $sawlist)
        {
            if($sawlist->sawvictim == 1 && $sawlist->victim_id == $id)
            {
                $yescounter++;
            }
            else
            {
                $nocounter++;
            }
        }
        foreach($comment as $commentlist)
        {
            if($commentlist->victim_id == $id)
            {
                $commentcounter++;
            }
        }
        $data = array(
            'profile' => $profile,
            'comment' => $comment,
            'maps' => $maps,
            'locationlist' => $locationlist,
            'saw' => $saw,
            'yescounter' => $yescounter,
            'nocounter' => $nocounter,
            'commentcounter' => $commentcounter,
        );
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
    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    //saw function in each post
    public function update(Request $request,$id)
    {
        $maps = new Maps();
        $maps->victim_id = $id;
        $maps->user_id = auth()->user()->id;
        $maps->lat = $request->input('sawprofilelat');
        $maps->lon = $request->input('sawprofilelon');
        $maps->save();

        $saw = new Saw();
        $comment = new Comment();
        $saw->user_id  = auth()->user()->id;
        $saw->victim_id = $id;
        $comment->victim_id = $id;
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
        // dd($maps->victim_id);
        $saw->save();
        $comment->save();
        return back()->with('success', $comment->comment);
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
        // dd($request->input('commentlat'));
        $maps->lat = $request->input('commentlat');
        $maps->lon = $request->input('commentlon');
        $maps->save();

        return back()->with('success', 'Comment Added');
    }
    public function deletecomment($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return back()->with('danger', 'Comment Removed');
    }
    public function search(Request $request)
    {
        $search = $request->input('search');
        $profile = VictimProfile::where('description', 'LIKE', '%'.$search.'%')->orWhere('ffname','LIKE','%'.$search.'%')->orWhere('address','LIKE','%'.$search.'%')->orWhere('ffcontact','LIKE','%'.$search.'%')->get();

        return view('posts.index')->with('profile', $profile);

    }



}
