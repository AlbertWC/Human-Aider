<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Maps;
use App\VictimProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use DateTime;

class GraphController extends Controller
{
    public function index()
    {
        $comments = Comment::get();
        $posts = VictimProfile::get();
        $maps = Maps::get();
        $forced = 0;
        $sexual = 0;
        $child = 0;
        $female = 0;
        $male = 0;
        $casecounter = 0;
        foreach($posts as $profilelist)
        {
            //type of criminal counter
            if($profilelist->type == 0)
            {
                $forced++;
            }
            elseif($profilelist->type == 1)
            {
                $sexual++;
            }
            else
            {
                $child++;
            }
            //gender counter
            if($profilelist->gender == 1)
            {
                $male++;
            }
            else
            {
                $female++;
            }
        }
        $johor = 0;
        $kualalumpur = 0;
        $labuan = 0;
        $putrajaya = 0;
        $kedah = 0;
        $kelantan = 0;
        $malacca = 0;
        $negerisembilan = 0;
        $pahang = 0;
        $perak = 0;
        $perlis = 0;
        $penang = 0;
        $sabah = 0;
        $sarawak = 0;
        $selangor = 0;
        $terengganu = 0;
        foreach($posts as $profilelist)
        {
            switch($profilelist->state)
            {
                case 'Johor':
                    $johor++;
                break;
                case 'Selangor':
                    $selangor++;
                break;
                case 'Kuala Lumpur':
                    $kualalumpur++;
                break;
                case "Labuan":
                    $labuan++;
                break;
                case "Putrajaya":
                    $putrajaya++;
                break;
                case "Kedah":
                    $kedah++;
                break;
                case "Kelantan":
                    $kelantan++;
                break;
                case "Malacca":
                    $malacca++;
                break;
                case "Negeri Sembilan":
                    $negerisembilan++;
                break;
                case "Pahang":
                    $pahang++;
                break;
                case "Perak":
                    $perak++;
                break;
                case "Perlis":
                    $perlis++;
                break;
                case "Penang":
                    $penang++;
                break;
                case "Sabah":
                    $sabah++;
                break;
                case "Sarawak":
                    $sarawak++;
                break;
                case "Terengganu":
                    $terengganu++;
                break;
            }
        }

        //month 
        $jancase = count(DB::table('victim_profiles')->whereMonth('created_at','01')->get());
        $febcase = count(DB::table('victim_profiles')->whereMonth('created_at','02')->get());
        $marcase = count(DB::table('victim_profiles')->whereMonth('created_at','03')->get());
        $aprcase = count(DB::table('victim_profiles')->whereMonth('created_at','04')->get());
        $maycase = count(DB::table('victim_profiles')->whereMonth('created_at','05')->get());
        $juncase = count(DB::table('victim_profiles')->whereMonth('created_at','06')->get());
        $julcase = count(DB::table('victim_profiles')->whereMonth('created_at','07')->get());
        $augcase = count(DB::table('victim_profiles')->whereMonth('created_at','08')->get());
        $sepcase = count(DB::table('victim_profiles')->whereMonth('created_at','09')->get());
        $octcase = count(DB::table('victim_profiles')->whereMonth('created_at','10')->get());
        $novcase = count(DB::table('victim_profiles')->whereMonth('created_at','11')->get());
        $deccase = count(DB::table('victim_profiles')->whereMonth('created_at','12')->get());
        $array = [
            'comments' => $comments,
            'posts' => $posts,
            'maps' => $maps,
            'forced' => $forced,
            'sexual' => $sexual,
            'child' => $child,
            'male' => $male,
            'female' => $female,
            'jancase' => $jancase,
            'febcase' => $febcase,
            'marcase' => $marcase,
            'aprcase' => $aprcase,
            'maycase' => $maycase,
            'juncase' => $juncase,
            'julcase' => $julcase,
            'augcase' => $augcase,
            'sepcase' => $sepcase,
            'octcase' => $octcase,
            'novcase' => $novcase,
            'deccase' => $deccase,
            'casecounter' => $casecounter,
            'johor' => $johor,
            'selangor' => $selangor,
            'labuan' => $labuan,
            'putrajaya' => $putrajaya,
            'kualalumpur' => $kualalumpur,
            'perak' => $perak,
            'pahang' => $pahang,
            'perlis' => $perlis,
            'penang' => $penang,
            'sabah' => $sabah,
            'sarawak' => $sarawak,
            'malacca' => $malacca,
            'kelantan' => $kelantan,
            'kedah' => $kedah,
            'terengganu' => $terengganu,
            'negerisembilan' => $negerisembilan,
            
        ];
        dd($array);
        return view('display')->with($array);
    }
}
