@extends('layouts.common')
@section('content')
    <!--<header>
        <nav>
          <div class="nav-wrapper black accent-4">
            <a href="/" class="brand-logo center" style="font-size:75px"><span class="deep-purple darken-3">P</span>lan<span class="deep-purple darken-3">I</span>t  <span class=" red accent-4">4</span> <span class=" green accent-4">Y</span>ou</a>
            <ul class="right">
              <li><a href="/login" class="button wave-effect grey darken-2">LOGIN</a></li>
            </ul>
          </div>
        </nav>
    </header>-->
    <header>
        <nav class="navbar black">
            <div class="nav-wrapper">
                <a class="brand-logo center" href="{{ url('/tournaments') }}" style="font-size:75px">
                  <span class="deep-purple darken-3">P</span>lan<span class="deep-purple darken-3">I</span>t  <span class=" red accent-4">4</span> <span class=" green accent-4">Y</span>ou
                </a>
                <ul class="right">
                    <!-- Authentication Links -->
                    @guest
                        <li>
                            <a href="{{ route('login') }}"  style="font-size:30px">{{ __('Login') }}</a>
                        </li>
                        
                    @else
                        <li>
                                <a class="dropdown-button" data-beloworigin="true" href="#!" data-activates="DD">
                                        {{ Auth::user()->first_name }} <span class="caret"><i class="material-icons right">dehaze</i></span>
                                    </a>
                                    <ul id="DD" class="dropdown-content">
                                      @if(Auth::user()->isAdmin==1)
                                        <li>
                                                <a class="black-text" style="font-size:20px" href="{{ route('admin.home') }}">
                                                 {{ __('Home') }}
                                                </a>
                                        </li>
                                      @elseif(Auth::user()->isHost==1)
                                      <li>
                                            <a class="black-text" style="font-size:20px" href="{{ route('host.home') }}">
                                             {{ __('Home') }}
                                            </a>
                                        </li>
                                        @elseif(Auth::user()->isCrew==1)
                                        <li>
                                              <a class="black-text" style="font-size:20px" href="{{ route('crew.home') }}">
                                               {{ __('Home') }}
                                              </a>
                                          </li>
                                      @endif
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
        <main style="min-height:400px">
                <h1 class="center white-text">@foreach($tmnt as $t) {{$t->Name}}[@if($t->Category_Id===1)Under21 @else Opens @endif, @if($t->Gtype_Id===1)7_Aside @else 11_Aside @endif] @endforeach</h1>
                <div class="container" style="padding:30px; width:90%">
                        <ul class="collapsible popout" data-collapsible="accordion">
                                
                                <li>
                                <div class="collapsible-header black white-text"><i class="material-icons">format_list_bulleted</i>Fixture Results</div>
                                <div class="collapsible-body grey ">
                                    <div>
                                        {{-- <form name="round1" action="" method="post">
                                            <label></label>
                                        </form> --}}
                                        <table class="centered bordered" >
                                            <thead>
                                                <tr class="black white-text">
                                                    <th>Match No.</th>
                                                    <th>Team 1</th>
                                                    <th>VS</th>
                                                    <th>Team2</th>
                                                    <th>Team1 Goals</th>
                                                    <th>Team2 Goals</th>
                                                    {{-- <th>Winner</th>
                                                    <th>Loser</th> --}}
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                $sr=1;
                                                @endphp
                                                @foreach($round as $r)
                                                    <tr class="grey lighten-2">
                                                        <td>{{$sr}}</td>
                                                        <td>{{$r->team1_id}}</td>
                                                        <td>VS</td>
                                                        <td>{{$r->team2_id}}</td>
                                                        <td>
                                                            <div class="input-field col s12 {{ $errors->has('t1_goal') ? ' has-error' : '' }} black-text">
                                                                <input id="t1_goal" type="text" class="validate black-text" name="t1_goal" value="" required>
                                                                {{-- <label for="t1_goal">t1_goal</label> --}}
                                                                    @if ($errors->has('t1_goal'))
                                                                        <div class="col s12">
                                                                            <span class="red-text">
                                                                                <strong>{{ $errors->first('t1_goal') }}</strong>
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="input-field col s12 {{ $errors->has('t2_goal') ? ' has-error' : '' }} black-text">
                                                                <input id="t2_goal" type="text" class="validate" name="t2_goal" value="" required>
                                                                {{-- <label for="t2_goal">t2_goal</label> --}}
                                                                    @if ($errors->has('t2_goal'))
                                                                        <div class="col s12">
                                                                            <span class="red-text">
                                                                                <strong>{{ $errors->first('t2_goal') }}</strong>
                                                                            </span>
                                                                        </div>
                                                                    @endif
                                                            </div>
                                                        </td>
                                                        {{-- <td>
                                                            <div class="input-field black-text col s12 {{ $errors->has('winner_id') ? ' has-error' : '' }}">
                                                                <select name="winner_id" id="winner_id" >
                                                                    <option class="black-text" value="Choose your option" disabled selected>Choose your option</option>
                                                                    <option class="black-text" id="s1" value="{{$r->team1_id}}">{{$r->team1_id}}</option>
                                                                    <option class="black-text" id="s2" value="{{$r->team2_id}}">{{$r->team2_id}}</option>
                                                                </select>
                                                                <label for="winner_id"></label>
                                                                @if ($errors->has('winner_id'))
                                                                    <div class="col s12">
                                                                        <span class="red-text">
                                                                            <strong>{{ $errors->first('winner_id') }}</strong>
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            </div>
                                                        </td> --}}
                                                        <td>
                                                            <button class="btn black white_text">Submit</button> 
                                                        </td>
                                                    </tr>
                                                    @php
                                                    $sr++;
                                                    @endphp
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                </li>
                                
                            </ul>
                </div>
        </main>
@endsection