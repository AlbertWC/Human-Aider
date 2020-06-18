<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Maps;
use App\VictimProfile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use AiFaiz\Malaysia\MyStates;

use DateTime;

class GraphController extends Controller
{
    
    public function index()
    {
        $zero = 0;

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
        //state count
        $johor = 0;
        $johorforced = 0;
        $johorsexual = 0;
        $johorchild = 0;

        $kualalumpur = 0;
        $kualalumpurforced = 0;
        $kualalumpursexual = 0;
        $kualalumpurchild = 0;

        $labuan = 0;
        $labuanforced = 0;
        $labuansexual = 0;
        $labuanchild = 0;

        $putrajaya = 0;
        $putrajayaforced = 0;
        $putrajayasexual = 0;
        $putrajayachild = 0;

        $kedah = 0;
        $kedahforced = 0;
        $kedahsexual = 0;
        $kedahchild = 0;
        
        $kelantan = 0;
        $kelantanforced = 0;
        $kelantansexual = 0;
        $kelantanchild = 0;
        
        $malacca = 0;
        $malaccaforced = 0;
        $malaccasexual = 0;
        $malaccachild = 0;
        
        $negerisembilan = 0;
        $negerisembilanforced = 0;
        $negerisembilansexual = 0;
        $negerisembilanchild = 0;
        
        $pahang = 0;
        $pahangforced = 0;
        $pahangsexual = 0;
        $pahangchild = 0;
        
        $perak = 0;
        $perakforced = 0;
        $peraksexual = 0;
        $perakchild = 0;
        
        $perlis = 0;
        $perlisforced = 0;
        $perlissexual = 0;
        $perlischild = 0;
        
        $penang = 0;
        $penangforced = 0;
        $penangsexual = 0;
        $penangchild = 0;
        
        $sabah = 0;
        $sabahforced = 0;
        $sabahsexual = 0;
        $sabahchild = 0;
        
        $sarawak = 0;
        $sarawakforced = 0;
        $sarawaksexual = 0;
        $sarawakchild = 0;
        
        $selangor = 0;
        $selangorforced = 0;
        $selangorsexual = 0;
        $selangorchild = 0;
        
        $terengganu = 0;
        $terengganuforced = 0;
        $terengganusexual = 0;
        $terengganuchild = 0;
        // dd($posts);
        foreach($posts as $profilelist)
        {
            if($profilelist->state == 'Johor')
            {
               $johor++; 
            }
            elseif($profilelist->state == 'Selangor')
            {
                $selangor++;
            }
            elseif($profilelist->state == 'Wilayah Persekutuan Kuala Lumpur')
            {
                $kualalumpur++;
            }
            elseif($profilelist->state == 'Labuan')
            {
                $labuan++;
            }
            elseif($profilelist->state == 'Putrajaya')
            {
                $putrajaya++;
            }
            elseif($profilelist->state == 'Kedah')
            {
                $kedah++;
            }
            elseif($profilelist->state == 'Kelantan')
            {
                $kelantan++;
            }
            elseif($profilelist->state == 'Malacca')
            {
                $malacca++;
            }
            elseif($profilelist->state == 'Negeri Sembilan')
            {
                $negerisembilan++;
            }
            elseif($profilelist->state == 'Pahang')
            {
                $pahang++;
            }
            elseif($profilelist->state == 'Perak')
            {
                $perak++;
            }
            elseif($profilelist->state == 'Perlis')
            {
                $perlis++;
            }
            elseif($profilelist->state == 'Penang')
            {
                $penang++;
            }
            elseif($profilelist->state == 'Sabah')
            {
                $sabah++;
            }
            elseif($profilelist->state == 'Sarawak')
            {
                $sarawak++;
            }
            elseif($profilelist->satte == 'Terengganu')
            {
                $terengganu ++;
            }
            else
            {
                $zero;
            }
            
        }
        // dd($johor);
        //total cases  
            $johorname = 'Johor';
            $selangorname = 'Selangor';
            $labuanname =   'Labuan';
            $putrajayaname =  'Putrajaya';
            $kualalumpurname = 'Kuala Lumpur';
            $perakname = 'Perak';
            $pahangname = 'Pahang';
            $perlisname = 'Perlis';
            $penangname = 'Penang';
            $sabahname = 'Sabah';
            $sarawakname = 'Sarawak';
            $malaccaname = 'Malacca';
            $kelantanname = 'Kelantan';
            $kedahname = 'Kedah';
            $terengganuname = 'Terengganu';
            $negerisembilanname = 'Negeri Sembilan';
        // $state = array(
        //     'Johor' => [
        //         'name' => $johorname,
        //     ],
        //     'Selangor' => [
        //         'name' => $selangorname,
        //     ],
        //     'Labuan' => [
        //         'name' => $labuanname,
        //     ],
        //     'Kuala Lumpur' => [
        //         'name' => $kualalumpurname,
        //     ],
        //     'Putrajaya' => [
        //         'name' => $putrajayaname,
        //     ],
        //     'Perak' => [
        //         'name' => $perakname,
        //     ],
        //     'Pahang' => [
        //         'name' => $pahangname,
        //     ],
        //     'Penang' => [
        //         'name' => $penangname,
        //     ],
        //     'Sabah' => [
        //         'name' => $sabahname,
        //     ],
        //     'Sarawak' => [
        //         'name' => $sarawakname,
        //     ],
        //     'Malacca' => [
        //         'name' => $malaccaname,
        //     ],
        //     'Kelantan' => [
        //         'name' => $kelantanname,
        //     ],

        //     'Kedah' => [
        //         'name' => $kedahname,
        //     ],

        //     'Terengganu' => [
        //         'name' => $terengganuname,
        //     ],

        //     'Negeri Sembilan' => [
        //         'name' => $negerisembilanname,
        //     ],
        //     'Perlis' => [
        //         'name' => $perlisname,
        //     ],



            // 'selangorname' => $selangorname,
            // 'labuanname' => $labuanname,
            // 'putrajayaname' => $putrajayaname,
            // 'kualalumpurname' => $kualalumpurname,
            // 'perakname' => $perakname,
            
            // 'pahangname' => $pahangname,
            // 'perlisname' => $perlisname,
            // 'penangname' => $penangname,
            // 'sabahname' => $sabahname,
            // 'sarawakname' => $sarawakname,

            // 'malaccaname' => $malaccaname,
            // 'kelantanname' => $kelantanname,
            // 'kedahname' => $kedahname,
            // 'terengganuname' => $terengganuname,
            // 'negerisembilanname' => $negerisembilanname,
        
            
        // );

        $selangorcase = DB::table('victim_profiles')->where('state','Selangor')->get();
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
        $states = MyStates::getStates();
        $tablesexual = 0;
        $tablechild = 0;
        $tableforced = 0;
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
            // 'state' => $state,
            'states' => $states,
            'tablesexual' => $tablesexual,
            'tablechild' => $tablechild,
            'tableforced' => $tableforced,
            'zero' => $zero,
        ];
        // dd($states);
        return view('display')->with($array);
    }
}
