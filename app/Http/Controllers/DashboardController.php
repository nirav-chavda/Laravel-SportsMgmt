<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tournament;
use App\team;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tmntsF=tournament::all()->where('sport_id',1);
        $tmntsH=tournament::all()->where('sport_id',2);
        $tmntsK=tournament::all()->where('sport_id',3);
        return view('pages.home')->with(['tmntsF'=>$tmntsF,'tmntsH'=>$tmntsH,'tmntsK'=>$tmntsK]);
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
        $tmnt=tournament::all()->where('id',$id);
        return view('pages.tournaments')->with('tmnt',$tmnt);
        
    }
    public function teamReg(Request $request){
        $name=ucwords($request);
        $team=team::create([
            'tournament_id'=>$id,
            'name'=>$request['team_name'],
        ]);
        \Session::flash('message', ['msg'=>'Team Registered !!', 'class'=>'green']);
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
