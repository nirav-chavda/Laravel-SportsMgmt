<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/',function(){
    return redirect('/tournaments');
});
Route::get('/tournaments', function(){
    return view('pages.home');
});
Route::get('/tournaments/{id}/info','DashboardController@show')->name('tournaments.show');
//Route::post('/tournaments/{id}/info','DashboardController@teamReg')->name('team.Reg');
Route::resource('tournaments','DashboardController');
// Route::get('/tournaments/{id}', function($id){
//     return view('pages.tournaments')->with('id',$id);
// });
Route::post('/tournaments/team/check','DashboardController@addTeamName')->name('team.check');
Route::post('/tournaments/team/add','DashboardController@addTeamMembers')->name('team.add');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::prefix('admin')->group(function(){
    //Route::get('/home', 'HomeController@index')->name('admin.home');
    Route::get('/register/admin','Auth\RegisterController@showRegistrationForm')->name('admin.reg');
    Route::post('/register/admin','Auth\RegisterController@create')->name('admin.submit');
    Route::get('/register/crew','Auth\CrewRegisterController@showRegistrationForm')->name('crew.reg');
    Route::post('/register/crew','Auth\CrewRegisterController@create')->name('crew.submit');
    Route::get('/register/host','Auth\HostRegisterController@showRegistrationForm')->name('host.reg');
    Route::post('/register/host','Auth\HostRegisterController@create')->name('host.submit');
    Route::resource('home','HomeController',[
        'names'=>[
            'index'=>'admin.home'
        ]
    ]);    
    // Route::get('/delete/{id}', function(){
    //     $user=User::find($id);
    //     $user->delete();
    //     \Session::flash('message', ['msg'=>'Record Deleted', 'class'=>'yellow']);
    //     return redirect()->intended('admin/home');
    // });
});
Route::prefix('host')->group(function(){
    // Route::get('/home', function(){
    //     $id=Auth::user()->id;
    //     $tmnts=tournament::all()->where('host_id',$id);
    //     return view('pages.host-home')->with('tmnts',$tmnts);
    // })->name('host.home');
    // Route::get('/register/admin','Auth\RegisterController@showRegistrationForm')->name('admin.reg');
    // Route::post('/register/admin','Auth\RegisterController@create')->name('admin.submit');
    // Route::get('/register/crew','Auth\CrewRegisterController@showRegistrationForm')->name('crew.reg');
    // Route::post('/register/crew','Auth\CrewRegisterController@create')->name('crew.submit');
    // Route::get('/register/host','Auth\HostRegisterController@showRegistrationForm')->name('host.reg');
    // Route::post('/register/host','Auth\HostRegisterController@create')->name('host.submit');
    Route::resource('home','HostController',[
        'names'=>[
            'index'=>'host.home'
        ]
    ]);
    Route::get('/tournament/{id}/info','HostController@show')->name('tournament.home');
    Route::post('/tournament/{id}/info','HostController@seedUpload')->name('seed.upload');
    Route::post('/tournament/{id}/info','HostController@addVenueDate')->name('add.venue');
    Route::get('/t_form','HostTmntController@index');
    Route::post('/t_form','HostTmntController@create')->name('tmnt.create');
});
Route::prefix('crew')->group(function(){
    //Route::get('/home', 'CrewController@index')->name('crew.home');
    // Route::get('/register/admin','Auth\RegisterController@showRegistrationForm')->name('admin.reg');
    // Route::post('/register/admin','Auth\RegisterController@create')->name('admin.submit');
    // Route::get('/register/crew','Auth\CrewRegisterController@showRegistrationForm')->name('crew.reg');
    // Route::post('/register/crew','Auth\CrewRegisterController@create')->name('crew.submit');
    // Route::get('/register/host','Auth\HostRegisterController@showRegistrationForm')->name('host.reg');
    // Route::post('/register/host','Auth\HostRegisterController@create')->name('host.submit');
    Route::resource('home','CrewController',[
        'names'=>[
            'index'=>'crew.home'
        ]
    ]);
});

