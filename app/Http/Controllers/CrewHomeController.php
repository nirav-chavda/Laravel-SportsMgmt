<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\tournament;

class CrewHomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tmntsF=tournament::all()->where('isAdmin',1);
        $tmntsH=tournament::all()->where('isCrew',1);
        $tmntsK=tournament::all()->where('isHost',1);
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
        $tmnt=tournament::all()->where('Tournament_Id',$id);
        return view('pages.crew-tournaments')->with('tmnt',$tmnt);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
