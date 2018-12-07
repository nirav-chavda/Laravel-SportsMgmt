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
        <h1 class="center white-text">@foreach($tmnt as $t) {{$t->Name}}[@if($t->Category_Id===1)Under21 @else Opens @endif, @if($t->Gtype_Id===1)7_Aside @else 11_Aside @endif] @endforeach</h1>
    <div class="container" style="padding:30px; width:90%">
            <ul class="collapsible popout" data-collapsible="accordion">
                    <li>
                      <div class="collapsible-header black white-text"><i class="material-icons">create</i>Registrations</div>
                      <div class="collapsible-body grey darken-3">
                            <form action="/" class="col s12">
                                <div class="row">
                                  <div class="white-text input-field col s12">
                                    <i class="material-icons prefix white-text">account_circle</i>
                                    <input type="text" id="fn" class="">
                                    <label for="fn">Team Name</label>
                                  </div>
                                </div>
                                  <div class="row ">
                                    <table>
                                      <thead class="white-text">
                                        <tr>
                                          <th class="center" style="width:10px">Sr No</th>
                                          <th class="center" style="width:100px">FirstName</th>
                                          <th class="center" style="width:100px">LastName</th>
                                          <th class="center" style="width:80px">Photo</th>
                                          <th class="center" style="width:80px">Signature</th>
                                          <th class="center" style="width:250px">Email</th>
                                        </tr>
                                      </thead>
                                      <tbody class="white-text ">
                                          @if($t->Gtype_Id===1)
                                            @for($i=1;$i<=10;$i++)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td><input type="text" placeholder="FirstName"></td>
                                                    <td><input type="text" placeholder="LastName"></td>
                                                    <td><input type="file" placeholder="Photo"></td>
                                                    <td><input type="file" placeholder="Signature"></td>
                                                    <td><input type="text" placeholder="Email"></td>
                                                 </tr>
                                            @endfor
                                         @elseif($t->Gtype_Id===2)
                                            @for($i=1;$i<=16;$i++)
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
                                  </div>
                          
                              <div class="row center">
                                <button class="center btn waves-effect waves-light grey lighten-2 black-text" type="submit" name="/staff">Make Paymentt
                                   <i class="material-icons right">receipt</i>
                                 </button>
                              </div>
                              </form>
                      </div>
                    </li>
                    <li>
                      <div class="collapsible-header black white-text"><i class="material-icons">apps</i>Pools</div>
                      <div class="collapsible-body grey lighten-3"><span>Lorem ipsum dolor sit amet.</span></div>
                    </li>
                    <li>
                      <div class="collapsible-header black white-text"><i class="material-icons">format_list_bulleted</i>Fixtures</div>
                      <div class="collapsible-body grey lighten-3"><span>Lorem ipsum dolor sit amet.</span></div>
                    </li>
                    <li>
                            <div class="collapsible-header black white-text"><i class="material-icons">import_contacts</i>Results</div>
                            <div class="collapsible-body grey lighten-3"><span>Lorem ipsum dolor sit amet.</span></div>
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
         <script type="text/javascript" src="js/jquery.min.js"></script>
            <script type="text/javascript" src="js/materialize.min.js"></script>
@endsection