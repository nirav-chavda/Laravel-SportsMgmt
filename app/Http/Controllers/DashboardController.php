<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\tournament;
use App\team;
use App\participant;

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

    public function generateUrl($title,$token){
        $title=trim($title);
        $title=strip_tags($title);
        $title=preg_replace("/[^a-zA-Z0-9 ]+/", "", $title);
        $url=str_replace(" ","-",$title);
        $url=$url."-".$token;
        return $url;
    }

    public function addTeamMembers(Request $request)
    {
        $type=tournament::select('gtype_id')->where('id',$request['flag1'])->first();

        if($type['gtype_id']==1) {

            for($i=1;$i<=3;$i++) {
            
                $file = $_FILES['photo'.$i];
                $unique_token=substr(md5(microtime()),rand(0,26),12);
                $url=$this->generateUrl($request['first_name'.$i].$request['last_name'.$i],$unique_token);
                $photo_path = '';

                if(isset($file) && $file['error']==0 ) {
                    $path_parts = pathinfo($file["name"]);
                    $extension = $path_parts['extension'];
                    $path = public_path('uploads/user'.'/'.$url.".".$extension);
                    if( move_uploaded_file($file['tmp_name'] , $path) )
                    {
                        $photo_path = 'uploads/user'.'/'.$url.".".$extension;
                    }
                }
            
                $file = $_FILES['sign'.$i];
                $unique_token=substr(md5(microtime()),rand(0,26),12);
                $url=$this->generateUrl($request['first_name'.$i].$request['last_name'.$i],$unique_token);
                $sign_path = '';

                if(isset($file) && $file['error']==0 ) {
                    $path_parts = pathinfo($file["name"]);
                    $extension = $path_parts['extension'];
                    $path = public_path('uploads/sign'.'/'.$url.".".$extension);
                    if( move_uploaded_file($file['tmp_name'] , $path) )
                    {
                        $sign_path = 'uploads/sign'.'/'.$url.".".$extension;
                    }
                }

                participant::create([
                    'first_name'=>$request['first_name'.$i],
                    'last_name'=>$request['last_name'.$i],
                    'contact'=>$request['contact'.$i],
                    'photo' => $request['photo_path'],
                    'signature' => $request['sign_path'],
                    'team_Id' => $request['flag2'],
                    'tournament_Id' => $request['flag1']
                ]);
            }
         }
        // elseif ($type['gtype_id']==2) {
        //     for($i=1;$i<=15;$i++) {
        //         participants::create([
        //             'first_name'=>$request['first_name'.$i],
        //             'last_name'=>$request['last_name'.$i],
        //             'contact'=>$request['contact'.$i],
        //         ]);
        //     }
        // }
        \Session::flash('message', ['msg'=>'Players Registration Complete!!', 'class'=>'green']);
        return Redirect::away('/tournaments/'.$request["flag1"].'/info');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tmnt=tournament::findOrFail($id);
        return view('pages.tournaments')->with('t',$tmnt);
        
    }
    public function addTeamName(Request $request){
        // $name=ucwords($request);
        // $team=team::create([
        //     'tournament_id'=>$id,
        //     'name'=>$request['team_name'],
        // ]);
        // \Session::flash('message', ['msg'=>'Team Registered !!', 'class'=>'green']);

        $id = $request->id;
        $team_name = $request->team_name;

        $obj = team::select('id')->where('name',$team_name)->where('tournament_Id',$id)->first();

        if ($obj){
            return response()->json(['status'=>'fail']);
        }
        else{
            $tname=team::create([
                'tournament_Id'=>$id,
                'name'=>$team_name
            ]);
            return response()->json(['status'=>'success', 'id'=>$tname->id]);
        }
    }

}
