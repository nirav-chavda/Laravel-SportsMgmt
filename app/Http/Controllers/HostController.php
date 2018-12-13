<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

use Auth;
use App\tournament;
use App\team;

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
        \Session::flash('message', ['msg'=>'Seeding Complete!!', 'class'=>'green']);

        return redirect()->route('tournament.home',$id);
    }

    public function addVenueDate(Request $request,$id){
        $venue=tournament::where('id',$id)->update(['start_date'=>$request['date'],'venue'=>$request['venue']]);
        \Session::flash('message', ['msg'=>'Venue & Date Added!!', 'class'=>'green']);

        return redirect()->route('tournament.home',$id);
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
        return view('pages.host-tournament')->with(['tmnt'=>$tmnt, 'teamUS'=>$teamUS, 'teamS'=>$teamS]);
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
