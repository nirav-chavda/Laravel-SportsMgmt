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
