@extends('layouts.common')
@section('content')
    <!--<header>
        <nav>
          <div class="nav-wrapper black accent-4">
            <a href="/" class="brand-logo center" style="font-size:75px"><span class="deep-purple darken-3">P</span>lan<span class="deep-purple darken-3">I</span>t  <span class=" red accent-4">4</span> <span class=" green accent-4">Y</span>ou</a>
            <ul class="right">
              <li><a href="/home" class="button wave-effect grey darken-2">LOGIN</a></li>
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
    <main style="height:relative">
        <div class="container deep-purple darken-3" style="width:75%; padding-bottom:4%">
            <h1 class="white-text center">Football Tournaments</h1>
            <div class="container deep-purple lighten-2 " style="width:85%">
                    @if(count($tmntsF)>0)
                    <table class="highlight bordered centered" id="football">
                         <thead class="black white-text">
                             <tr>
                                 <th>Sr No</th>
                                 <th>Name</th>
                                 <th>Type</th>
                                 <th>Category</th>
                                 <th>Registration Amount</th>
                                 <th>Start Date</th>
                                 <th>Venue</th>
                                 <th></th>
                             </tr>
                         </thead>
                         <tbody>
                            @php
                               $i=1; 
                            @endphp 
                             @foreach($tmntsF as $tmnt)
                              <tr>
                                         <td>{{$i}}</td>
                                         <td>{{$tmnt->Name}}</td>
                                         <td>
                                             @if($tmnt->Gtype_Id===1)
                                                 7_Aside 
                                             @else
                                                 11_Aside
                                             @endif
                                         </td>
                                         <td>
                                             @if($tmnt->Category_Id===1)
                                                 Under 21
                                             @else
                                                 Opens
                                             @endif
                                         </td>
                                         <td>{{$tmnt->reg_fees}}</td>
                                         <td>{{$tmnt->start_date}}</td>
                                         <td>{{$tmnt->venue}}</td>
                                         <td><a href="/tournaments/{{$tmnt->id}}/info" class="btn deep-purple darken-1">Go!</a></td>
                              </tr>
                              @php
                                  $i++;
                              @endphp
                             @endforeach
                         </tbody>
                     </table>
                    @else
                     <h2>No Tournaments Yet </h2>
                    @endif
            </div>
        </div>
        <div class="container red darken-3" style="width:75%; padding-bottom:4%">
                <h1 class="white-text center">Handball Tournaments</h1>
                <div class="container red lighten-2 " style="width:85%">
                   @if(count($tmntsH)>0)
                   <table class="highlight bordered centered" id="handball">
                        <thead class="black white-text">
                            <tr>
                                <th>Sr No</th>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Category</th>
                                <th>Registration</th>
                                <th>Start Date</th>
                                <th>Venue</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                           @php
                              $i=1; 
                           @endphp 
                            @foreach($tmntsH as $tmnt)
                             <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$tmnt->Name}}</td>
                                        <td>
                                            @if($tmnt->gtype_Id===1)
                                                7_Aside
                                            @else
                                                11_Aside
                                            @endif
                                        </td>
                                        <td>
                                            @if($tmnt->category_Id===1)
                                                Under 21
                                            @else
                                                Opens
                                            @endif
                                        </td>
                                        <td>{{$tmnt->reg_fees}}</td>
                                        <td>{{$tmnt->start_date}}</td>
                                        <td>{{$tmnt->venue}}</td>
                                        <td><a href="/tournaments/{{$tmnt->id}}/info" class="btn red darken-2">Go!</a></td>
                             </tr>
                             @php
                                 $i++;
                             @endphp
                            @endforeach
                        </tbody>
                    </table>
                   @else
                    <h1>No Tournaments Yet</h1>
                   @endif
                </div>
            </div>
            <div class="container green darken-3" style="width:75%; padding-bottom:4%">
                    <h1 class="white-text center">Hockey Tournaments</h1>
                    <div class="container green lighten-2 " style="width:80%">
                        @if(count($tmntsK)>1)
                           <table class="highlight bordered centered" id="handball">
                                <thead class="black white-text">
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Name</th>
                                        <th>Type</th>
                                        <th>Category</th>
                                        <th>Registration</th>
                                        <th>Start Date</th>
                                        <th>Venue</th>
                                        <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @php
                                          $i=1; 
                                       @endphp 
                                    @foreach($tmntsK as $tmnt)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$tmnt->Name}}</td>
                                        <td>
                                            @if($tmnt->gtype_Id===1)
                                                7_Aside
                                            @else
                                                11_Aside
                                            @endif
                                        </td>
                                        <td>
                                            @if($tmnt->category_Id===1)
                                                Under 21
                                            @else
                                                Opens
                                            @endif
                                        </td>
                                        <td>{{$tmnt->reg_fees}}</td>
                                        <td>{{$tmnt->start_date}}</td>
                                        <td>{{$tmnt->venue}}</td>
                                        <td><a href="/tournaments/{{$tmnt->id}}/info" class="btn green darken-1">Go!</a></td>
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                               @else
                                <h2>No Tournaments Yet</h2>
                               @endif
                            </tbody>
                        </table>
                    </div>
                </div>
    </main>
@endsection