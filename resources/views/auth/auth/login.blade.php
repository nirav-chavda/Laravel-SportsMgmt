@extends('layouts.common')

@section('content')
<header>
    <nav class="navbar black">
            <div class="nav-wrapper">
                <a class="brand-logo center" href="{{ url('/tournaments') }}" style="font-size:75px">
                  <span class="deep-purple darken-3">P</span>lan<span class="deep-purple darken-3">I</span>t  <span class=" red accent-4">4</span> <span class=" green accent-4">Y</span>ou
                </a>
                <!--<ul class="right"> Authentication Links
                    @guest
                        <li>
                            <a href="{{ url('/hlogin') }}"  style="font-size:30px">{{ __('Login') }}</a>
                        </li>
                        <li>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}"  style="font-size:30px">{{ __('Register') }}</a>
                            @endif
                        </li>
                    @else
                        <li>
                            <a class="dropdown-button" data-beloworigin="true" href="#!" data-activates="DD">
                                {{ Auth::user()->name }} <span class="caret"><i class="material-icons right">dehaze</i></span>
                            </a>
                            <ul id="DD" class="dropdown-content">
                              <li class="white">
                                  <a class="black-text" style="font-size:20px" href="{{ url('/tournaments') }}"
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
                </ul>-->
                <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>-->
            </div>
        </nav>
  </header>
  <main class="center" style="padding:5%; padding-left:25%">
    <div class="row">
        <div class="col s12 m9">
          <div class="card grey darken-3">
            <div class="card-content white-text">
              <span class="card-title" style="font-size:40px; font-weight:bold">Login</span>
              <form role="form" method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
    
                <div class="row">
                    <div class="input-field col s12 {{ $errors->has('username') ? ' has-error' : '' }} white-text">
                        <input id="username" type="text" class="validate" name="username" value="{{ old('username') }}" required>
                        <label for="username">Username</label>
                          @if ($errors->has('username'))
                              <div class="col s12">
                                  <span class="red-text">
                                      <strong>{{ $errors->first('username') }}</strong>
                                  </span>
                              </div>
                          @endif
                      </div>
                </div>
    
                <div class="row">
                    <div class="input-field col s12 {{ $errors->has('password') ? ' has-error' : '' }} white-text" required>
                        <input type="password" name="password" class="validate" min="8" id="password">
                        <label for="password">Password</label>
                        @if ($errors->has('password'))
                            <span class="red-text">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                <div class="row">
                    <!--<p class="col s12">
                        <input type="checkbox" id="remember" name="remember" />
                        <label for="remember">Remember Me</label>
                      </p>-->
          
                      <div class="input-field col s12 center">
                          <button type="submit" class="black btn waves-effect waves-light"><i class="material-icons right">send</i>Login</button>
                          <!--<p class="center">
                              <a class="" href="{{ url('/password/reset') }}">Forgot Your Password?</a>
                          </p>-->
                      </div>
                </div>
                </form>
            </div>
          </div>
        </div>
      </div>
  </main>
    
@endsection
