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
                                <div class="collapsible-body grey lighten-3">
                                    <div>
                                        <form name="round1" action="" method="post">
                                            <label></label>
                                        </form>
                                    </div>
                                </div>
                                </li>
                                
                            </ul>
                </div>
        </main>
     <!--JavaScript at end of body for optimized loading-->
            <!--Import jQuery before materialize.js-->
            <!-- Compiled and minified CSS -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">-->

  <!-- Compiled and minified JavaScript -->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>-->
  <!--<script type = "text/javascript"
  src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>   -->    
         <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/materialize.min.js"></script>
@endsection