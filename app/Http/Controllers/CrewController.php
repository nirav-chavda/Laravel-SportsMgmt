<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\tournament;
use App\team;
use App\fixture;

class CrewController extends Controller
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
        $tmntsF=tournament::all()->where('sport_id',1);
        $tmntsH=tournament::all()->where('sport_id',2);
        $tmntsK=tournament::all()->where('sport_id',3);
        return view('pages.crew-home')->with(['tmntsF'=>$tmntsF,'tmntsH'=>$tmntsH,'tmntsK'=>$tmntsK]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        $r1=0;
        $r2=0;
        $r3=0;
        $tmnt=tournament::all()->where('id',$id);
        $team=team::all()->where('tournament_Id',$id);
        if(count($team)<=8){
            $r1=4;
            $r2=2;
            $r3=2;
        }elseif(count($team)>8 && count($team)<=16){
            $r1=8;
            $r2=4;
            $r3=2;
            $r4=2;
        }
        $round=fixture::all()->where('tournament_id',$id);
        //echo $round;
        return view('pages.crew-tournaments')->with(['tmnt'=>$tmnt,'round'=>$round]);
    }

    public function addScore(Request $request) {
        $data = $request->all();
        $fixture=fixture::where('tournament_id',$request->tournament_id);
        if(count($fixture)==16)
        {
            $index = ['1' => 9 , '3' => 10 , '5' => 11 , '7' => 12 , '9' => 13 , '11' => 14 ];
        $match = $request->match_id;

        if($request->team1=="") {
            $winner_id = $request->team2;
            $loser_id = $request->team1;
        } else  if ($request->team2=="") {
            $winner_id = $request->team1;
            $loser_id = $request->team2;
        } else {
            if($request->team1_goals > $request->team2_goals) {
                $winner_id = $request->team1;
                $loser_id = $request->team2;
            } else {
                $winner_id = $request->team2;
                $loser_id = $request->team1;
            }
        }

        $obj = fixture::where('match_id',$request->match_id)->where('tournament_id',$request->tournament_id)->update([
            'team1_goals' => $request->team1_goals,
            'team2_goals' => $request->team2_goals,
            'loser_id' => $loser_id,
            'winner_id' => $winner_id            
        ]);

        if( $match!=15 && $match!=16) {

            if($match==13) {
                fixture::where('match_id',15)->where('tournament_id',$request->tournament_id)->update(['team1_id'=>$winner_id]);
                fixture::where('match_id',16)->where('tournament_id',$request->tournament_id)->update(['team1_id'=>$loser_id]);
            } else if($match==14) {
                fixture::where('match_id',15)->where('tournament_id',$request->tournament_id)->update(['team2_id'=>$winner_id]);
                fixture::where('match_id',16)->where('tournament_id',$request->tournament_id)->update(['team2_id'=>$loser_id]);
            } else {
                if($match % 2 == 0) {
                    fixture::where('tournament_id',$request->tournament_id)->where('match_id',$index[$match-1])->update(['team2_id'=>$winner_id]); 
                } else {
                    fixture::where('match_id',$index[$match])->where('tournament_id',$request->tournament_id)->update(['team1_id'=>$winner_id]);
                }
            }
        }

        return response()->json(['status'=>'success','data'=>$data]);
        }
        elseif(count($fixture)==8)
        {
            $index = ['1' => 5 , '3' => 6 , '5' => 7];
        $match = $request->match_id;

        if($request->team1=="") {
            $winner_id = $request->team2;
            $loser_id = $request->team1;
        } else  if ($request->team2=="") {
            $winner_id = $request->team1;
            $loser_id = $request->team2;
        } else {
            if($request->team1_goals > $request->team2_goals) {
                $winner_id = $request->team1;
                $loser_id = $request->team2;
            } else {
                $winner_id = $request->team2;
                $loser_id = $request->team1;
            }
        }

        $obj = fixture::where('match_id',$request->match_id)->where('tournament_id',$request->tournament_id)->update([
            'team1_goals' => $request->team1_goals,
            'team2_goals' => $request->team2_goals,
            'loser_id' => $loser_id,
            'winner_id' => $winner_id            
        ]);

        if( $match!=7 && $match!=8) {

            if($match==5) {
                fixture::where('match_id',7)->where('tournament_id',$request->tournament_id)->update(['team1_id'=>$winner_id]);
                fixture::where('match_id',8)->where('tournament_id',$request->tournament_id)->update(['team1_id'=>$loser_id]);
            } else if($match==6) {
                fixture::where('match_id',7)->where('tournament_id',$request->tournament_id)->update(['team2_id'=>$winner_id]);
                fixture::where('match_id',8)->where('tournament_id',$request->tournament_id)->update(['team2_id'=>$loser_id]);
            } else {
                if($match % 2 == 0) {
                    fixture::where('tournament_id',$request->tournament_id)->where('match_id',$index[$match-1])->update(['team2_id'=>$winner_id]); 
                } else {
                    fixture::where('match_id',$index[$match])->where('tournament_id',$request->tournament_id)->update(['team1_id'=>$winner_id]);
                }
            }
        }

        return response()->json(['status'=>'success','data'=>$data]);
        }
        
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
