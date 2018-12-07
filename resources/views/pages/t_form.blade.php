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
  <div  class="container " style="height:relative; width:50%">
    <h1 class="white-text center">Tournament Form</h1>
    <form action="{{route('tmnt.create')}}" class="center">
        <div class="row">
            <div class="input-field col s12 {{ $errors->has('Name') ? ' has-error' : '' }} white-text">
                <input id="Name" type="text" class="validate" name="Name" value="{{ old('Name') }}" required>
                <label for="Name">Name</label>
                  @if ($errors->has('Name'))
                      <div class="col s12">
                          <span class="red-text">
                              <strong>{{ $errors->first('Name') }}</strong>
                          </span>
                      </div>
                  @endif
              </div>
        </div>
    <div class="row">
        <div class="input-field white-text col s3 m6 {{ $errors->has('sport_id') ? ' has-error' : '' }}">
            <select name="sport_id" id="sport_id" >
              <option class="black-text" value="" disabled selected>Choose your option</option>
              <option class="black-text" id="s1" value="1">Football</option>
              <option class="black-text" id="s2" value="2">Handball</option>
              <option class="black-text" id="s2" value="3">Hockey</option>
            </select>
            <label for="sport_id">Sport</label>
            @if ($errors->has('sport_id'))
                          <div class="col s12">
                              <span class="red-text">
                                  <strong>{{ $errors->first('sport_id') }}</strong>
                              </span>
                          </div>
                      @endif
          </div>
      <div class="input-field white-text col s3 m6 {{ $errors->has('gtype_id') ? ' has-error' : '' }}">
        <select name="gtype_id" id="gtype_id">
          <option value="" disabled selected>Choose your option</option>
          <option id="t1" value="1">7-aside</option>
          <option id="t2" value="2">11-aside</option>
        </select>
        <label for="gtype_id">Type</label>
        @if ($errors->has('gtype_id'))
                      <div class="col s12">
                          <span class="red-text">
                              <strong>{{ $errors->first('gtype_id') }}</strong>
                          </span>
                      </div>
                  @endif
      </div>
    </div>
    <div class="row">
      <div class="input-field white-text col s3 m6 {{ $errors->has('category_id') ? ' has-error' : '' }}">
        <select name="category_id" id="category_id">
          <option value="" disabled selected>Choose your option</option>
          <option value="1" >Under21</option>
          <option value="2" >Opens</option>
        </select>
          <label>Category</label>
          @if ($errors->has('category_id'))
                      <div class="col s12">
                          <span class="red-text">
                              <strong>{{ $errors->first('category_id') }}</strong>
                          </span>
                      </div>
                  @endif
      </div>
    
      <div class="input-field white-text col s3 m6 {{ $errors->has('pool') ? ' has-error' : '' }}">
        <select name="pool" id="pool">
          <option value="" disabled selected>Choose your option</option>
          <option value="3" >3</option>
          <option value="4" >4</option>
        </select>
          <label>Pool Size</label>
          @if ($errors->has('pool'))
                      <div class="col s12">
                          <span class="red-text">
                              <strong>{{ $errors->first('pool') }}</strong>
                          </span>
                      </div>
                  @endif
      </div>
    </div>
    <div class="row">
        <div class="input-field white-text col s3 m6 {{ $errors->has('half_time') ? ' has-error' : '' }}">
          <select name="half_time" id="half_time">
            <option value="" disabled selected>Choose your option</option>
            <option value="10" >10 min</option>
            <option value="15" >15 min</option>
            <option value="20" >20 min</option>
            <option value="45" >45 min</option>
          </select>
            <label>Half Time</label>
            @if ($errors->has('half_time'))
                        <div class="col s12">
                            <span class="red-text">
                                <strong>{{ $errors->first('half_time') }}</strong>
                            </span>
                        </div>
                    @endif
        </div>
      
        <div class="input-field white-text col s3 m6 {{ $errors->has('break_time') ? ' has-error' : '' }}">
          <select name="break_time" id="break_time">
            <option value="" disabled selected>Choose your option</option>
            <option value="3" >3 min</option>
            <option value="5" >5 min</option>
            <option value="15" >15 min</option>
          </select>
            <label>BreakTime</label>
            @if ($errors->has('break_time'))
                        <div class="col s12">
                            <span class="red-text">
                                <strong>{{ $errors->first('break_time') }}</strong>
                            </span>
                        </div>
                    @endif
        </div>
      </div>
      <div class="row">
          <div class="input-field col s6 {{ $errors->has('reg_fees') ? ' has-error' : '' }} white-text">
                  <input id="reg_fees" type="text" class="validate" name="reg_fees" value="{{ old('reg_fees') }}" required>
                  <label for="reg_fees">Registration Fees</label>
                    @if ($errors->has('reg_fees'))
                        <div class="col s12">
                            <span class="red-text">
                                <strong>{{ $errors->first('reg_fees') }}</strong>
                            </span>
                        </div>
                    @endif
                </div>
        
                <div class="input-field col s6 {{ $errors->has('duration') ? ' has-error' : '' }} white-text">
                    <input id="duration" type="text" class="validate" name="duration" value="{{ old('duration') }}" required>
                    <label for="duration">Duration(Days)</label>
                      @if ($errors->has('duration'))
                          <div class="col s12">
                              <span class="red-text">
                                  <strong>{{ $errors->first('duration') }}</strong>
                              </span>
                          </div>
                      @endif
                  </div>
        </div>
    <div class="row">
      {{-- <div class="input-field white-text col s3 m4">
        <input id="chkbx" type="checkbox">
        <label class="white-text left" for="">Former Tournament?</label>
      </div> --}}
          <div class="col s4 m4">
              <input name="old" type="checkbox" class="filled-in" id="chkbx" value="2" />
              <label for="chkbx">Former Tournament</label>
          </div>
          <div class="col s4 m4">
              <input name="equip" type="checkbox" class="filled-in" id="chkbx2" value="2"/>
              <label for="chkbx2">Equipments ??</label>
          </div>
          <div class="input-field white-text col s3 m4 {{ $errors->has('total_teams') ? ' has-error' : '' }}">
              <select name="total_teams" id="total_teams">
                <option value="" disabled selected>Choose your option</option>
                <option value="12" >12</option>
                <option value="24" >24</option>
                <option value="36" >36</option>
              </select>
                <label>Max Teams</label>
                @if ($errors->has('total_teams'))
                            <div class="col s12">
                                <span class="red-text">
                                    <strong>{{ $errors->first('total_teams') }}</strong>
                                </span>
                            </div>
                        @endif
            </div>

        {{-- <div id="seed" class="right container">
          <div class="row">
            <div class="input-field col s3 m6">
              <input type="text">
              <label for="">Team1</label>
            </div>
            <div class="input-field col s3 m6">
              <input type="text">
              <label for="">Team2</label>
            </div>
          </div>
          <div class="row">
            <div class="input-field col s3 m6">
              <input type="text">
              <label for="">Team3</label>
            </div>
            <div class="input-field col s3 m6">
              <input type="text">
              <label for="">Team4</label>
            </div>
          </div>
        </div> --}}
    </div>
    <div class="row">
        

    </div><br>
      <div class="row">
          <div class="input-field col s12 center">
              <button type="submit" class="black btn waves-effect waves-light"><i class="material-icons right">send</i>Create</button>
      </div>
    </div>
  </div>
    </form>

  </div>
  <script>
  $(document).ready(function() {
  $('select').material_select();
  $('#seed').hide();
  });
  $('#chkbx').click(function(){
    $('#seed').toggle();
  });
  </script>
@endsection
