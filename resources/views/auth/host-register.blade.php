@extends('layouts.common')

@section('content')
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
  <main class="center" style="padding:5%; padding-left:25%">
    <div class="row">
        <div class="col s12 m9">
          <div class="card grey darken-3">
            <div class="card-content white-text">
              <span class="card-title" style="font-size:40px; font-weight:bold">Register</span>
              <form role="form" method="POST" action="{{ route('host.submit') }}">
                {{ csrf_field() }}

                <div class="row">
                    <div class="input-field col s12 {{ $errors->has('first_name') ? ' has-error' : '' }} white-text">
                        <input id="first_name" type="text" class="validate" name="first_name" value="{{ old('first_name') }}" required>
                        <label for="first_name">First Name</label>
                          @if ($errors->has('first_name'))
                              <div class="col s12">
                                  <span class="red-text">
                                      <strong>{{ $errors->first('first_name') }}</strong>
                                  </span>
                              </div>
                          @endif
                      </div>
                </div>

                <div class="row">
                    <div class="input-field col s12 {{ $errors->has('last_name') ? ' has-error' : '' }} white-text">
                        <input id="last_name" type="text" class="validate" name="last_name" value="{{ old('last_name') }}" required>
                        <label for="last_name">Last Name</label>
                          @if ($errors->has('last_name'))
                              <div class="col s12">
                                  <span class="red-text">
                                      <strong>{{ $errors->first('last_name') }}</strong>
                                  </span>
                              </div>
                          @endif
                      </div>
                </div>

                <div class="row">
                    <div class="input-field col s12 {{ $errors->has('acc_no') ? ' has-error' : '' }} white-text">
                        <input id="acc_no" type="text" class="validate" name="acc_no" value="{{ old('acc_no') }}" required>
                        <label for="acc_no">Account No.</label>
                          @if ($errors->has('acc_no'))
                              <div class="col s12">
                                  <span class="red-text">
                                      <strong>{{ $errors->first('acc_no') }}</strong>
                                  </span>
                              </div>
                          @endif
                      </div>
                </div>
    
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

                <div class="input-field col s12{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input id="password-confirm" type="password" class="validate" name="password_confirmation">
                    <label>Confirm Password</label>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
                </div>
                
                <div class="row">
                    <!--<p class="col s12">
                        <input type="checkbox" id="remember" name="remember" />
                        <label for="remember">Remember Me</label>
                      </p>-->
          
                      <div class="input-field col s12 center">
                          <button type="submit" class="black btn waves-effect waves-light"><i class="material-icons right">send</i>Register</button>
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
