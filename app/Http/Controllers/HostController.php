<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Auth;
use App\tournament;
use App\team;
use App\fixture;

class HostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
       $id=Auth::user()->id;
        $tmnts=tournament::all()->where('host_id',$id);
        return view('pages.host-home')->with('tmnts',$tmnts);
        //return $id;
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function seedUpload(Request $request,$id)
    {
        $team=team::all()->where('tournament_Id',$id);
        $count=count($team);
        for($i=1;$i<=$count;$i++){
            // $flag1=${'t'.$i};
            // $flag2=${'s'.$i};
            $seeding=team::where('name',$request['t'.$i])->update(['seeding'=>$request['s'.$i]]);
        }

        $arr_fixture = $this->fixtureMaking($id);
        for($i=0;$i<count($arr_fixture);$i++) {
            fixture::create([
                'tournament_id' => $id,
                'match_id' => $i+1,
                'team1_id' => $arr_fixture[$i][0],
                'team2_id' => $arr_fixture[$i][1]
            ]);
        }

        for($i=8;$i<16;$i++) {
            fixture::create([
                'tournament_id' => $id,
                'match_id' => $i+1,
                'team1_id' => NULL,
                'team2_id' => NULL
            ]);
        }

        \Session::flash('message', ['msg'=>'Seeding Complete!!', 'class'=>'green']);
        return redirect()->route('tournament.home',$id);
    }

    public function addVenueDate(Request $request,$id){
        $venue=tournament::where('id',$id)->update(['start_date'=>$request['date'],'venue'=>$request['venue']]);
        \Session::flash('message', ['msg'=>'Venue & Date Added!!', 'class'=>'green']);

        return redirect()->route('tournament.home',$id);
    }

    public function fixtureData(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tmnt=tournament::where('id',$id)->first();
        $teamUS=team::all()->where('tournament_Id',$id)->where('seeding',NULL);
        $teamS=team::all()->where('tournament_Id',$id)->where('seeding','!=',NULL)->sortBy('seeding');
        $fixture = fixture::all()->where('tournament_id',$id);
        return view('pages.host-tournament')->with(['tmnt'=>$tmnt, 'teamUS'=>$teamUS, 'teamS'=>$teamS,'fixture'=>$fixture]);
    }

    public function fixtureMaking($id){
        $row=0; $bye=0;
        $team=array();
        $arr=array();
        $fixture=array();
        $teamS=team::all()->where('tournament_Id',$id)->where('seeding','!=',NULL)->sortBy('seeding');
        if(count($teamS)<=8)
        {
            $rows=2;
            $bye=8-count($teamS);
        }
        elseif(count($teamS)>8 && count($teamS)<=16)
        {
            $rows=4;
            $bye=16-count($teamS);
        }
        foreach($teamS as $t)
        {
            array_push($team,$t->seeding);
        }
        for($i=0;$i<$bye;$i++){
            array_push($team,null);
        }
        $index=0;
        for($i=0;$i<$rows;$i++)
        {
            if($i%2!=0)
            {
                for($j=3;$j>=0;$j--)
                {
                    $arr[$i][$j]=$team[$index++];
                }
            }
            else{
                for($j=0;$j<4;$j++)
                {
                    $arr[$i][$j]=$team[$index++];
                }
            }
        }
        //print_r($arr);
        for($i=0;$i<$rows;$i++)
        {
            $temp=$arr[$i][1];
            $arr[$i][1]=$arr[$i][3];
            $arr[$i][3]=$temp;
        }
        //print_r($arr);
        $try[]=array(array(1,2,3,4),array(5,6,null,null));
        if(count($arr)==2)
        {
            $c=0;
            for($i=0;$i<$rows;$i++)
            {
                for($j=0;$j<4;$j++)
                {
                    $fixture[$c]=array($arr[$i][$j],$arr[$i+1][$j]);
                    $c++;
                }
            }
            //print_r($fixture);
            print_r($try);
        }
        elseif(count($arr)==4)
        {
            //print_r($arr);
            $row=$rows;
            $l=0;
            $m=0;
            for($j=0;$j<$row;$j++)
            {
                for($k=0;$k<2;$k++)
                {
                    $fixture[$l]=array($arr[$m][$j],$arr[$row-1][$j]);
                    $l++;
                    $m++;
                    $row=$row-1;
                }
                $m=0;
                $row=4;
            }
        }
        
        return $fixture;
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
}
