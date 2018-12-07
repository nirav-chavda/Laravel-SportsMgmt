@extends('layouts.common')
@section('content')
<header>
        <nav class="nav-extended black">
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
                                      {{-- @if(Auth::user()->isAdmin==1)
                                        <li>
                                                <a class="black-text" style="font-size:20px" href="{{ route('admin.home') }}">
                                                 {{ __('Home') }}
                                                </a>
                                        </li>
                                      @elseif(Auth::user()->isHost==1) --}}
                                      <li>
                                            <a class="black-text" style="font-size:20px" href="{{ route('host.home') }}">
                                             {{ __('Home') }}
                                            </a>
                                        </li>
                                        {{-- @elseif(Auth::user()->isCrew==1)
                                        <li>
                                              <a class="black-text" style="font-size:20px" href="{{ route('crew.home') }}">
                                               {{ __('Home') }}
                                              </a>
                                          </li>
                                      @endif --}}
                                    </ul>
                        </li>
                    @endguest
                </ul>
                <!--<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>-->
            </div>
            <div class="nav-content">
                    <ul class="tabs tabs-transparent">
                      <li class="tab"><a id="btn1" class="active" href="#details">Details</a></li>
                      <li class="tab"><a id="btn2" href="#test2">Teams</a></li>
                      <li class="tab"><a id="btn3" href="#test3">Pools</a></li>
                      <li class="tab"><a id="btn4" href="#test4">Fixtures</a></li>
                    </ul>
            </div>            
        </nav>
    </header>
    <main>
            <div class="container" id="details" style="min-height:400px">
                    <div class="container">
                        <h2 class="white-text center">Venue And Date</h2>
                        <input type="text" class="datepicker">
                        <input type="text" class="timepicker">
                    </div>
                </div>
                <div class="container" id="teams" style="min-height:400px">
                        <h1 class="white-text">teams Container</h1>
                </div>
                <div class="container" id="pools" style="min-height:400px">
                        <h1 class="white-text">pools Container</h1>
                </div>
                <div class="container" id="fixtures" style="min-height:400px">
                        <h1 class="white-text">fixtures Container</h1>
                </div>
    </main>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#details").show(1000);
            $("#teams").hide();
            $("#pools").hide();
            $("#fixtures").hide();
        });
        $("#btn1").click(function(){
            $("#details").show(1000);
            $("#teams").hide();
            $("#pools").hide();
            $("#fixtures").hide();
        });
        $("#btn2").click(function(){
            $("#details").hide();
            $("#teams").show(1000);
            $("#pool").hide();
            $("#fixtures").hide();
        });
        $("#btn3").click(function(){
            $("#details").hide();
            $("#teams").hide();
            $("#pools").show(1000);
            $("#fixtures").hide();
        });
        $("#btn4").click(function(){
            $("#details").hide();
            $("#teams").hide();
            $("#pools").hide();
            $("#fixtures").show(1000);
        });
    </script>
    <script>
        $('.datepicker').pickadate({
            selectMonths: true, // Creates a dropdown to control month
            selectYears: 15, // Creates a dropdown of 15 years to control year,
            today: 'Today',
            clear: 'Clear',
            close: 'Ok',
            closeOnSelect: false // Close upon selecting a date,
            container: undefined, // ex. 'body' will append picker to body
        });
        $('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'OK', // text for done-button
    cleartext: 'Clear', // text for clear-button
    canceltext: 'Cancel', // Text for cancel-button,
    container: undefined, // ex. 'body' will append picker to body
    autoclose: false, // automatic close timepicker
    ampmclickable: true, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });
    </script>
@endsection