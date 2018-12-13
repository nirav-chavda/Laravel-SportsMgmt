<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\User;
use Auth;
use App\tournament;

class HostTmntController extends Controller
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
        return view('pages.t_form')->with('id',$id);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'Name' => ['required', 'string', 'max:255'],
            'sport_id' => ['required', 'string'],
            'gtype_id' => ['required', 'string'],
            'category_id' => ['required', 'string'],
            //'pool'=>['required','string'],
            // 'half_time' => ['required', 'string'],            
            // 'break_time' => ['required', 'string'],
            'reg_fees' => ['required', 'string'],
            //'duration' => ['required', 'string'],
            'total_teams'=>['required', 'string'],
            'old' => ['required', 'string'],
            'equip' => ['required', 'string'],
        ]);
    }
    public function create(Request $request)
    {
        // echo $request->Name; echo '||';
        // echo $request->sport_id;echo '||';
        // echo $request->category_id;echo '||';
        // echo $request->gtype_id;echo '||';
        // echo $request->reg_fees;echo '||';
        // echo $request->total_teams;echo '||';
        // echo $request->old;echo '||';
        // echo $request->equip;echo '||';
        $id=Auth::user()->id;
        //$this->validator($request->all())->validate();
        // echo $request->Name;
        // exit(0);
        $tmnt=tournament::create([
            'Name'=>$request['Name'],
            'host_id'=>$id,
            'sport_id'=>$request['sport_id'],
            'gtype_id'=>$request['gtype_id'],
            'category_id'=>$request['category_id'],
            //'pool_size'=>$request['pool'],
            // 'half_time' => $request['half_time'],            
            // 'break_time' => $request['break_time'],
            'reg_fees' => $request['reg_fees'],
            // 'duration' => $request['duartion'],
            'total_teams'=>$request['total_teams'],
            'new_old' => $request['old'],
            'equipments' => $request['equip'],
        ]);
        \Session::flash('message', ['msg'=>'Tournament Created !!', 'class'=>'green']);
        return redirect()->intended('/host/home');
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
        $tmnt=tournament::all()->where('Tournament_Id',$id);
        return view('pages.host-tournament')->with('tmnt',$tmnt);
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
