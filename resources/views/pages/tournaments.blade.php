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
                <a class="brand-logo" href="{{ url('/tournaments') }}" style="font-size:75px">
                  <span class="deep-purple darken-3">P</span>lan<span class="deep-purple darken-3">I</span>t  <span class=" red accent-4">4</span> <span class=" green accent-4">Y</span>ou
                </a>
                <ul class="right">
                    <!-- Authentication Links -->
                    @guest
                        <li>
                            <a href="{{ route('login') }}" style="font-size:30px">{{ __('Login') }}</a>
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
                                    @else
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
        <h1 class="center white-text"> {{$t->Name}}[@if($t->Category_Id===1)Under21 @else Opens @endif, @if($t->Gtype_Id===1)7_Aside @else 11_Aside @endif] </h1>
    <div class="container" style="padding:30px; width:90%; margin-bottom:10%">
            <ul class="collapsible popout" data-collapsible="accordion">
                    <li>
                      <div class="collapsible-header black white-text"><i class="material-icons">create</i>Registrations</div>
                      <div class="collapsible-body grey darken-3">
                            <form action="{{ route('team.add') }}" method="post" class="col s12" enctype="multipart/form-data">
                                <div class="row">
                                        <div class="input-field col s6 {{ $errors->has('team_name') ? ' has-error' : '' }} white-text">
                                                <input id="team_name" type="text" class="validate" name="team_name"  required>
                                                <label for="team_name">Team Name</label>
                                                  @if ($errors->has('team_name'))
                                                      <div class="col s12">
                                                          <span class="red-text">
                                                              <strong>{{ $errors->first('team_name') }}</strong>
                                                          </span>
                                                      </div>
                                                  @endif
                                              </div>
                                              <input type="hidden" name="flag2" id="team-id" value="">
                                              <input type="hidden" name="flag1" value="{{ $t->id }}">  <!-- Tournament Id -->
                                    <div class="right col s6">
                                        <button id="t_reg" class="center btn waves-effect waves-light grey lighten-2 black-text" onclick="checkTeamName('{{ $t->id }}')" name="team">Register Team Name
                                           <i class="material-icons right">receipt</i>
                                         </button>
                                    </div>
                                </div>
                                <div class="row " id="players">
                                    <table>
                                        <thead class="white-text">
                                        <tr>
                                            <th class="center" style="width:10px">Sr No</th>
                                            <th class="center" style="width:100px">FirstName</th>
                                            <th class="center" style="width:100px">LastName</th>
                                            <th class="center" style="width:130px">Photo</th>
                                            <th class="center" style="width:130px">Signature</th>
                                            <th class="center" style="width:150px">Contact</th>
                                        </tr>
                                        </thead>
                                        <tbody class="white-text ">
                                            @if($t->gtype_id==1)
                                            @for($i=1;$i<=10;$i++)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td><div class="input-field col s12 {{ $errors->has('first_name') ? ' has-error' : '' }} white-text">
                                                            <input id="first_name{{$i}}" name="first_name{{$i}}" type="text" class="validate" name="first_name" value="{{ old('first_name') }}" required>
                                                            <label for="first_name">First Name</label>
                                                                @if ($errors->has('first_name'))
                                                                    <div class="col s12">
                                                                        <span class="red-text">
                                                                            <strong>{{ $errors->first('first_name') }}</strong>
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            </div></td>
                                                    <td><div class="input-field col  {{ $errors->has('last_name') ? ' has-error' : '' }} white-text">
                                                            <input id="last_name{{$i}}" name="last_name{{$i}}" type="text" class="validate" name="last_name" value="{{ old('last_name') }}" required>
                                                            <label for="last_name">Last Name</label>
                                                                @if ($errors->has('last_name'))
                                                                    <div class="col s12">
                                                                        <span class="red-text">
                                                                            <strong>{{ $errors->first('last_name') }}</strong>
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            </div></td>
                                                    <td><div class = "file-field input-field">
                                                            <div>
                                                                <button class="btn" style="height: 24px; line-height: 24px; padding: 0 0.5rem;"><span>Browse</span></button>
                                                                <input id="photo{{$i}}" name="photo{{$i}}" type = "file" />
                                                                <input class = "file-path-wrapper file-path validate" type = "text"
                                                                    placeholder = "Upload Photo" />
                                                            </div>
                                                        </div>
                                                        </td>
                                                    <td><div class = "file-field input-field">
                                                            <div>
                                                                <button class="btn" style="height: 24px; line-height: 24px; padding: 0 0.5rem;"><span>Browse</span></button>
                                                                <input id="sign{{$i}}" name="sign{{$i}}" type = "file" />
                                                                <input class = "file-path-wrapper file-path validate" type = "text" placeholder=" Upload Sign"/>
                                                            </div>
                                                        </div></td>
                                                    <td><div class="input-field col s12 {{ $errors->has('contact') ? ' has-error' : '' }} white-text">
                                                            <input id="contact{{$i}}" name="contact{{$i}}" type="text" class="validate" name="contact" value="{{ old('contact') }}" required>
                                                            <label for="contact">Contact</label>
                                                                @if ($errors->has('contact'))
                                                                    <div class="col s12">
                                                                        <span class="red-text">
                                                                            <strong>{{ $errors->first('contact') }}</strong>
                                                                        </span>
                                                                    </div>
                                                                @endif
                                                            </div></td>
                                                    </tr>
                                            @endfor
                                            @elseif($t->gtype_id==2)
                                            @for($i=1;$i<=15;$i++)
                                                    <tr>
                                                    <td>{{$i}}</td>
                                                    <td style="width:130px"><input type="text" placeholder="FirstName"></td>
                                                    <td style="width:130px"><input type="text" placeholder="LastName"></td>
                                                    <td ><input type="file" placeholder="Photo"></td>
                                                    <td><input type="file" placeholder="Signature"></td>
                                                    <td><input type="text" placeholder="Email"></td>
                                                </tr>
                                            @endfor
                                            @else
                                            <h1 class="white-text">Error !!!</h1>
                                            @endif
                                        </tbody>
                                    </table>
                                    {{ csrf_field() }}
                                    <div class="row center">
                                        <button class="center btn waves-effect waves-light grey lighten-2 black-text" type="submit" name="team">Make Payment
                                        <i class="material-icons right">receipt</i>
                                        </button>
                                    </div>
                                </div>
                              </form>
                      </div>
                    </li>
                    <li>
                      <div class="collapsible-header black white-text"><i class="material-icons">format_list_bulleted</i>Fixtures</div>
                      <div class="collapsible-body grey lighten-3" id="displayFixtures"><span>Lorem ipsum dolor sit amet.</span></div>
                    </li>
                  </ul>
    </div>
     <!--JavaScript at end of body for optimized loading-->
            <!--Import jQuery before materialize.js-->
            <!-- Compiled and minified CSS -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">-->

  <!-- Compiled and minified JavaScript -->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>-->
  <!--<script type = "text/javascript"
  src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>   -->    
         {{-- <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/materialize.min.js"></script> --}}
            <script>
                $(document).ready(function(){
                    $('#players').hide();
                });
                // $('#t_reg').click(function(){
                //     $('#players').show();
                // });
            </script>
@endsection