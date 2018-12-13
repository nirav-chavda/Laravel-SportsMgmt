@extends('layouts.common')
@section('content')
  <!--<header>
    <nav>
      <div class="nav-wrapper black accent-4">
        <a href="/" class="brand-logo center" style="font-size:75px"><span class="deep-purple darken-3">P</span>lan<span class="deep-purple darken-3">I</span>t  <span class=" red accent-4">4</span> <span class=" green accent-4">Y</span>ou</a>
        <ul class="right">
          <li><a href="/" class="button wave-effect grey darken-2">LOGOUT</a></li>
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
                          <a href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>
                      <li>
                          @if (Route::has('register'))
                              <a href="{{ route('register') }}">{{ __('Register') }}</a>
                          @endif
                      </li>
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
  <div  class="container " style="height:auto; margin-bottom:10%;">
    <h1 class="white-text center">Welcome</h1>
    <form action="" class="center">
      <a class="btn waves-effect waves-light grey lighten-2 black-text" type="submit" href="/host/t_form">Create Tournament
         <i class="material-icons right">edit</i>
       </a><br><br>       
    </form>
    <h2 class="center white-text">Tournament List</h2>    
          @if(count($tmnts)>0)
          <table class="centered" style="border:1px">
              <thead class="white-text black">
                  <tr>
                      <th>Sr No</th>
                      <th>Name</th>
                      <th>Sport</th>
                      <th>Type</th>
                      <th>Category</th>
                      <th></th>
                  </tr>
                </thead>
                @php
                    $i=1;
                @endphp
                <tbody class="grey-text lighten-2">
          @foreach($tmnts as $tmnt)
          <tr class="white-text">
              <td>{{$i}}</td>
              <td>{{$tmnt->Name}}</td>
              <td>
                  @if($tmnt->sport_id==1)
                    Football
                  @elseif($tmnt->sport_id==2)
                    Handball
                  @elseif($tmnt->sport_id==3)
                    Hockey
                  @endif
              </td>
              <td>
                @if($tmnt->gtype_id==1)
                  7 Aside
                @elseif($tmnt->gtype_id==2)
                  11 Aside
                @endif
              </td>
              <td>
                @if($tmnt->category_id==1)
                  Under 21
                @elseif($tmnt->category_id==2)
                  Opens
                @endif
              </td>
              <td><a href="/host/tournament/{{$tmnt->id}}/info" class="btn hoverable grey black-text">View</td>
          </tr>
          @php
              $i++;
          @endphp
        @endforeach  
          {{-- <tr>
            <td>ACL</td>
            <td>7aside</td>
            <td>Under21</td>
            <td><a id="det-btn0" class="btn hoverable grey black-text"><i class="material-icons right">mode_edit</i></a></td>
            <td><a href="/schedular" class="btn hoverable grey black-text"><i class="material-icons right">access_time</i></a></td>
          </tr>
          <tr>
            <td>ACL</td>
            <td>7aside</td>
            <td>Opens</td>
            <td><a id="det-btn1" class="btn hoverable grey black-text"><i class="material-icons right">mode_edit</i></a></td>
            <td><a href="/schedular" class="btn hoverable grey black-text"><i class="material-icons right">access_time</i></a></td>
          </tr>
          <tr>
            <td>TimesOFIndia</td>
            <td>11aside</td>
            <td>Opens</td>
            <td><a id="det-btn2" class="btn hoverable grey black-text"><i class="material-icons right">mode_edit</i></a></td>
            <td><a href="/schedular" class="btn hoverable grey black-text"><i class="material-icons right">access_time</i></a></td>
          </tr>--}}
        </tbody> 
    </table>
    @else
    <div class="grey darken-2">
        <h3 class="center white-text">Created Tournament Details Here</h3>
    </div>
    @endif
    {{-- <div id="det">
      <h3 class="white-text">Add Venue Date</h3>
      <div class="row" style="padding-left:50px;">
        <div class="input-field white-text col s3 m4">
          <input type="text" name="place" value="">
          <label for="">Venue</label>
        </div>
        <div class="input-field white-text col s3 m4">
          <input type="text" class="datepicker">
          <label for="">Date(DD/MM/YY)</label>
          <div class="input-field white-text col s3 m4">
            <a  class="btn grey black-text hoverable">Add</a>
            </div>
        </div>
      </div>
    </div> --}}
  </div>
  <script>
//   $('.datepicker').pickadate({
// selectMonths: true, // Creates a dropdown to control month
// selectYears: 15, // Creates a dropdown of 15 years to control year,
// today: 'Today',
// clear: 'Clear',
// close: 'Ok',
// closeOnSelect: false // Close upon selecting a date,
// container: undefined, // ex. 'body' will append picker to body
// });
  </script>
  <script>
    $(document).ready(function(){
      $("#det").hide();
    });
    $("#det-btn0").click(function(){
      $("#det").slideDown();
    });
    $("#det-btn1").click(function(){
      $("#det").slideDown();
    });
    $("#det-btn2").click(function(){
      $("#det").slideDown();
    });
  </script>
@endsection
