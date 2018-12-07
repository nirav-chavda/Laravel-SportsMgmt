@extends('layouts.common')
@section('content')
<header>
    <nav class="navbar black">
            <div class="nav-wrapper">
                <a class="brand-logo center" href="{{ url('/tournaments') }}" style="font-size:75px">
                  <span class="deep-purple darken-3">P</span>lan<span class="deep-purple darken-3">I</span>t  <span class=" red accent-4">4</span> <span class=" green accent-4">Y</span>ou
                </a>
                <ul class="right"> <!--Authentication Links-->
                    @guest
                        <!--<li>
                            <a href="{{ url('/hlogin') }}"  style="font-size:30px">{{ __('Login') }}</a>
                        </li>
                        <li>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"  style="font-size:30px">{{ __('Register') }}</a>
                            @endif
                        </li>-->
                    @else
                        <li>
                            <a class="dropdown-button" data-beloworigin="true" href="#!" data-activates="DD">
                                {{ Auth::user()->first_name }} <span class="caret"><i class="material-icons right">dehaze</i></span>
                            </a>
                            <ul id="DD" class="dropdown-content">
                              <li class="white">
                                  <a class="black-text" style="font-size:20px" href="{{ route('logout') }}"
                                  onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                   {{ __('Logout') }}
                                  </a>
    
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                      @csrf
                                  </form>
                              </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
                <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>-->
            </div>
        </nav>
  </header>
<main style="height:relative; padding-bottom:5%;">
        <div class="fixed-action-btn click-to-toggle">
                <a class="btn-floating btn-large red tooltipped" data-position="left" data-tooltip="Add Account">
                  <i class="large material-icons">add</i>
                </a>
                <ul>
                  <li><a href="{{route('admin.reg')}}" class="btn-floating blue tooltipped" data-position="left" data-tooltip="Create Admin">A</a></li>
                  <li><a href="{{route('crew.reg')}}" class="btn-floating orange darken-1 tooltipped" data-position="left" data-tooltip="Create Crew">C</a></li>
                  <li><a href="{{route('host.reg')}}" class="btn-floating green tooltipped" data-position="left" data-tooltip="Create Host">H</a></li>
                </ul>
              </div>
    <h2 class="white-text center">Manage Accounts</h2>
    <div class="container grey darken-4" style="padding:5px">
        <div class="container">
                <h3 class="white-text center">Admins</h3>
                <table class="highlight bordered centered" id="football">
                    <thead class="black white-text">
                        <tr>
                            <th>Sr No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="grey">
                            @php
                            $i=1; 
                         @endphp
                         @foreach($admins as $admin)
                            <tr>                            
                                <td>{{$i}}</td>
                                <td>{{$admin->first_name}}</td>
                                <td>{{$admin->last_name}}</td>
                                <td>{{$admin->created_at}}</td>
                                <td>
                                    {!!Form::open(['action'=>['HomeController@destroy',$admin->id],'method'=>'POST'])!!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete',['class'=>'btn black'])}}
                                    {!!Form::close() !!}
                                </td>
                            </tr>
                            @php
                            $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
        </div><br>
        <div class="container">
                <h3 class="white-text center">Crews</h3>
                @if(count($crews)>0)
                <table class="highlight bordered centered" id="football">
                    <thead class="black white-text">
                        <tr>
                            <th>Sr No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="grey">
                            @php
                            $i=1; 
                         @endphp
                         @foreach($crews as $crew)
                            <tr>                            
                                <td>{{$i}}</td>
                                <td>{{$crew->first_name}}</td>
                                <td>{{$crew->last_name}}</td>
                                <td>{{$crew->created_at}}</td>
                                {{-- <td><a href="/delete/{{$admin->id}}" class="btn black">Delete</a></td> --}}
                                <td>
                                    {!!Form::open(['action'=>['HomeController@destroy',$crew->id],'method'=>'POST'])!!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete',['class'=>'btn black'])}}
                                    {!!Form::close() !!}
                                </td>
                            </tr>
                            @php
                            $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="divider"></div>
                    <h2 class="white-text">No Crew yet</h2>
                @endif
        </div><br>   
        <div class="container">
                <h3 class="white-text center">Hosts</h3>
                @if(count($hosts)>0)
                <table class="highlight bordered centered" id="football">
                    <thead class="black white-text">
                        <tr>
                            <th>Sr No</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Created At</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody class="grey">
                            @php
                            $i=1; 
                         @endphp
                         @foreach($hosts as $host)
                            <tr>                            
                                <td>{{$i}}</td>
                                <td>{{$host->first_name}}</td>
                                <td>{{$host->last_name}}</td>
                                <td>{{$host->created_at}}</td>
                                <td>
                                    {!!Form::open(['action'=>['HomeController@destroy',$host->id],'method'=>'POST'])!!}
                                        {{Form::hidden('_method','DELETE')}}
                                        {{Form::submit('Delete',['class'=>'btn black'])}}
                                    {!!Form::close() !!}
                                </td>
                            </tr>
                            @php
                            $i++;
                        @endphp
                        @endforeach
                    </tbody>
                </table>
                @else
                    <div class="divider"></div>
                    <h2 class="white-text">No Host yet</h2>
                @endif
        </div>    
    </div>
</main>
@endsection