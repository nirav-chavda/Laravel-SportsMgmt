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

                      <li class="tab"><a id="btn4" href="#test4">Fixtures</a></li>
                    </ul>
            </div>            
        </nav>
    </header>
    <main>
            <div class="container" id="details" style="min-height:400px">
                    <div class="container" style="height:50%">
                        <h2 class="white-text center">Venue And Date</h2>
                        @if($tmnt->venue==NULL && $tmnt->start_date==NULL)
                            <form action="{{route('add.venue',$tmnt->id)}}" method="POST">
                                    <div class="row center" style="margin-left:25%">
                                        <div class="input-field col s8 white-text">
                                            <input id="date" name="date" type="text" class="datepicker" >
                                            <label for="date">Select Date</label>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-left:25%">
                                        <div class="white-text input-field col s8 {{ $errors->has('venue') ? ' has-error' : '' }} white-text">
                                            <input id="venue" type="text" class="validate" name="venue" value="{{ old('venue') }}" required>
                                            <label for="venue">Venue</label>
                                                @if ($errors->has('venue'))
                                                    <div class="col s12">
                                                        <span class="red-text">
                                                            <strong>{{ $errors->first('venue') }}</strong>
                                                        </span>
                                                    </div>
                                                @endif
                                        </div>
                                    </div>
                                    {{csrf_field()}}
                                    <button style="margin-left:40%; margin-bottom:30px;" class=" center btn white-text black ">Submit</button>
                            </form>
                        @else
                        <div class="row">
                            <h3 class="white-text">Venue : {{$tmnt->venue}}</h3>
                        </div>
                        <div class="row">
                            <h3 class="white-text">Date : {{$tmnt->start_date}}</h3>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="container center" id="teams" style="min-height:400px">
                    @if(count($teamUS)>0 && $tmnt->new_old==1)
                    <div style="margin:30px">
                        <form action="{{ route('upload.seed',$tmnt->id) }}" method="POST">
                            <table class="centered striped">
                                <thead class="white-text black">
                                    <tr>
                                        <th>Team</th>
                                        <th>Seeding</th>
                                    </tr>
                                </thead>
                                <tbody class="grey lighten-2">
                                    @php
                                        $i=1;
                                    @endphp
                                    @foreach($teamUS as $t)
                                    <tr class="">
                                        <td>{{$t->name}}</td>
                                        {{-- <td>{{$i}}</td> --}}
                                        <td>
                                            {{$i}}
                                        </td>
                                        <input type="hidden" name="t{{$i}}" id="t{{$i}}" value="{{$t->name}}">
                                        <input type="hidden" name="s{{$i}}" id="s{{$i}}" value="{{$i}}">
                                    </tr>
                                    @php
                                        $i++;
                                    @endphp
                                    @endforeach
                                    
                                </tbody>                            
                            </table><br>
                            {{csrf_field()}}
                            <button class="btn black white-text" type="submit"> Confirm</button>
                                        {{-- <button class="btn white-text black" type="submit">Upload Seeding</button> --}}
                        </form>                            
                    </div>
                    @elseif(count($teamUS)>0 && $tmnt->new_old==2)
                    <div id="select_seed" style="margin:30px">
                            <div class="row">
                                    <div class="input-field white-text col s3 m6 {{ $errors->has('first') ? ' has-error' : '' }}">
                                        <select name="first" id="first" >
                                          <option class="black-text" value="Choose your option" disabled selected>Choose your option</option>
                                          {{-- <option class="black-text" id="s1" value="1">Football</option>
                                          <option class="black-text" id="s2" value="2">Handball</option>
                                          <option class="black-text" id="s2" value="3">Hockey</option> --}}
                                          @foreach($teamUS as $t)
                                          <option id="{{$t->name}}" value="{{$t->name}}">{{$t->name}}</option>
                                          @endforeach
                                        </select>
                                        <label for="first">Winner</label>
                                        @if ($errors->has('first'))
                                                      <div class="col s12">
                                                          <span class="red-text">
                                                              <strong>{{ $errors->first('first') }}</strong>
                                                          </span>
                                                      </div>
                                                  @endif
                                      </div>
                                  <div class="input-field white-text col s3 m6 {{ $errors->has('second') ? ' has-error' : '' }}">
                                    <select name="second" id="second">
                                      <option value="Choose your option" disabled selected>Choose your option</option>
                                      {{-- <option id="t1" value="1">7-aside</option>
                                      <option id="t2" value="2">11-aside</option> --}}
                                      @foreach($teamUS as $t)
                                      <option id="{{$t->name}}" value="{{$t->name}}">{{$t->name}}</option>
                                      @endforeach
                                    </select>
                                    <label for="second">Runners Up</label>
                                    @if ($errors->has('second'))
                                                  <div class="col s12">
                                                      <span class="red-text">
                                                          <strong>{{ $errors->first('second') }}</strong>
                                                      </span>
                                                  </div>
                                              @endif
                                  </div>
                            </div>
                            <div class="row">
                                    <div class="input-field white-text col s3 m6 {{ $errors->has('third') ? ' has-error' : '' }}">
                                        <select name="third" id="third" >
                                          <option class="black-text" value="Choose your option" disabled selected>Choose your option</option>
                                          {{-- <option class="black-text" id="s1" value="1">Football</option>
                                          <option class="black-text" id="s2" value="2">Handball</option>
                                          <option class="black-text" id="s2" value="3">Hockey</option> --}}
                                          @foreach($teamUS as $t)
                                          <option id="{{$t->name}}" value="{{$t->name}}">{{$t->name}}</option>
                                          @endforeach
                                        </select>
                                        <label for="third">Third Place</label>
                                        @if ($errors->has('third'))
                                                      <div class="col s12">
                                                          <span class="red-text">
                                                              <strong>{{ $errors->first('third') }}</strong>
                                                          </span>
                                                      </div>
                                                  @endif
                                      </div>
                                  <div class="input-field white-text col s3 m6 {{ $errors->has('fourth') ? ' has-error' : '' }}">
                                    <select name="fourth" id="fourth">
                                      <option value="Choose your option" disabled selected>Choose your option</option>
                                      {{-- <option id="t1" value="1">7-aside</option>
                                      <option id="t2" value="2">11-aside</option> --}}
                                      @foreach($teamUS as $t)
                                      <option id="{{$t->name}}" value="{{$t->name}}">{{$t->name}}</option>
                                      @endforeach
                                    </select>
                                    <label for="fourth">Fourth Place</label>
                                    @if ($errors->has('fourth'))
                                                  <div class="col s12">
                                                      <span class="red-text">
                                                          <strong>{{ $errors->first('fourth') }}</strong>
                                                      </span>
                                                  </div>
                                              @endif
                                  </div>
                            </div>
                            <div class="row center">
                                    <div class="input-field col s12 center">
                                            <button id="confirm_seed" class="black btn waves-effect waves-light"><i class="material-icons right">send</i>Confirm</button>
                                    </div>
                            </div>
                    </div>
                    <div style="margin:30px;">
                            <div class="container center" id="seeding" style="margin-top:30px">
                                {{-- <table class="centered striped">
                                    <thead class="black white-text">
                                        <tr>
                                            <th>Name</th>
                                            <th>Seeding</th>
                                        </tr>
                                    </thead>
                                    <tbody class="grey lighten-2">
                                        
                                        <tr>
                                            <td id="first_seed"></td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td id="second_seed"></td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td id="third_seed"></td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td id="fourth_seed"></td>
                                            <td>4</td>
                                        </tr>
                                    </tbody>
                                </table> --}}
                            </div>
                            <div class="container" id="form-con">
                                <form action="{{route('upload.seed',$tmnt->id)}}" method="POST">
                                    @for($i=1;$i<=count($teamUS);$i++)
                                        <input type="hidden" name="t{{$i}}" id="t{{$i}}" value="">
                                        <input type="hidden" name="s{{$i}}" id="s{{$i}}" value="{{$i}}">
                                    @endfor
                                    {{-- <input type="submit" value="SUBMIT"> --}}<br>
                                    {{csrf_field()}}
                                    <button class="btn white-text black" type="submit">Upload Seeding</button>
                                </form>
                            </div>
                    </div>
                    @elseif(count($teamS)>0)
                        <div style="margin:30px">
                            <table class="centered striped">
                                @php
                                    
                                @endphp
                                <thead class="white-text black">
                                    <tr>
                                        <th>Name</th>
                                        <th>Seeding</th>
                                    </tr>
                                </thead>
                                <tbody class="grey lighten-3">
                                    @foreach($teamS as $t)
                                    <tr>
                                        <td>{{$t->name}}</td>
                                        <td>{{$t->seeding}}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif
                </div>
                <div class="container grey darken-3" id="fixtures" style="min-height:550px;">
                    @if(count($teamS)>0)
                   <div id="displayFixture" class="grey"></div>
                   @else
                   <h2 class="white-text">Seed Teams First</h2>
                   @endif
                </div>
    </main>
    <script type="text/javascript">
        $(document).ready(function(){
            var select_array = {id1:"",id2:"",id3:"",id4:""};
            $("#form-con").hide();
            $("#details").show(1000);
            $("#teams").hide();
            $("#fixtures").hide();
            $('select').material_select();
            $('#seeding').hide();
            //$("select").children("option[value='nirav']").prop("disabled", true);
            // $("select").change(function () {
            //     //alert($(this).val());
            //     $("select option").attr("disabled", false);
            //     $("select").not($(this)).children("option[value='" + $(this).val() + "']").attr("disabled", true);
            //     $('select').material_select();
            // }); 

            $('select').change(function(){                

                $("#first").children("option[value='" + select_array.id2 + "'],[value='" + select_array.id3 + "'],[value='" + select_array.id4 + "']").attr("disabled", false);
                $("#second").children("option[value='" + select_array.id1 + "'],[value='" + select_array.id3 + "'],[value='" + select_array.id4 + "']").attr("disabled", false);
                $("#third").children("option[value='" + select_array.id1 + "'],[value='" + select_array.id2 + "'],[value='" + select_array.id4 + "']").attr("disabled", false);
                $("#fourth").children("option[value='" + select_array.id1 + "'],[value='" + select_array.id2 + "'],[value='" + select_array.id3 + "']").attr("disabled", false);

                var selected_id = $(this).attr('id');

                if(selected_id=="first") {
                    select_array.id1 = $(this).val();
                    //document.getElementById('first_seed').html=select_array.id1;    
                    $('#t1').val(select_array.id1);
                   // alert($("#t1").val());
                }
                else if(selected_id=="second") {
                    select_array.id2 = $(this).val();
                    $('#t2').val(select_array.id2);
                }
                else if(selected_id=="third") {
                    select_array.id3 = $(this).val();
                    $('#t3').val(select_array.id3);
                }
                else if(selected_id=="fourth") {
                    select_array.id4 = $(this).val();
                    $('#t4').val(select_array.id4);
                }   

                var count=5;
                var table = `<table class="centered striped"><thead class="black white-text">
                                        <tr>
                                            <th>Name</th>
                                            <th>Seeding</th>
                                        </tr>
                                    </thead>
                                    <tbody class="grey lighten-2"><tr>
                                            <td id="first_seed">`+select_array.id1+`</td>
                                            <td>1</td>
                                        </tr>
                                        <tr>
                                            <td id="second_seed">`+select_array.id2+`</td>
                                            <td>2</td>
                                        </tr>
                                        <tr>
                                            <td id="third_seed">`+select_array.id3+`</td>
                                            <td>3</td>
                                        </tr>
                                        <tr>
                                            <td id="fourth_seed">`+select_array.id4+`</td>
                                            <td>4</td>
                                        </tr>`;
                @foreach($teamUS as $team)
                    if( ("{{$team->name}}" != select_array.id1) && ("{{$team->name}}" != select_array.id2) && ("{{$team->name}}" != select_array.id3) && ("{{$team->name}}" != select_array.id4)) {
                        //alert("{{$team->name}}" + select_array.id1);
                        table += "<tr><td>"+"{{ $team->name }}" + "</td><td>"+ count +"</td></tr>";
                        $("#t"+count).val("{{$team->name}}");
                        count++;
                    }
                @endforeach
                table += "</tbody></table>";
                $("#seeding").html(table);

                $("#first").children("option[value='" + select_array.id2 + "'],[value='" + select_array.id3 + "'],[value='" + select_array.id4 + "']").attr("disabled", true);
                $("#second").children("option[value='" + select_array.id1 + "'],[value='" + select_array.id3 + "'],[value='" + select_array.id4 + "']").attr("disabled", true);
                $("#third").children("option[value='" + select_array.id1 + "'],[value='" + select_array.id2 + "'],[value='" + select_array.id4 + "']").attr("disabled", true);
                $("#fourth").children("option[value='" + select_array.id1 + "'],[value='" + select_array.id2 + "'],[value='" + select_array.id3 + "']").attr("disabled", true);

                $('select').material_select();
                    
            });
        });
            
        $('#confirm_seed').click(function(){
            var bool='';
            var c=document.getElementById('first').value;
                var s=document.getElementById('second').value;
                var g=document.getElementById('third').value;
                var t=document.getElementById('fourth').value;
                if(c=='Choose your option' || s=='Choose your option' || g=='Choose your option' || t=='Choose your option'){
                    Materialize.toast('Selection List Value Not Appropriate ! ', 3000, 'rounded red');
                    bool= false;
                }else{
            $('#confirm_seed').hide();
            $('#seeding').show();
            
            $("#form-con").show();
            }
        });
        $("#btn1").click(function(){
            $("#details").show(500);
            $("#teams").hide();
            $("#fixtures").hide();
        });
        $("#btn2").click(function(){
            $("#details").hide();
            $("#teams").show(1000);
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
            closeOnSelect: false, // Close upon selecting a date,
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
    after: function(){} //Function for after opening timepicker
  });
    </script>
    <script>

        @if(isset($fixture))

            var team_data = "";
            var flag1,flag2;

            @foreach($fixture as $obj)
                @if($obj->match_id<=8)
                    flag1='<?php echo $obj->team1_id; ?>';                      
                    flag2='<?php echo $obj->team2_id; ?>';
                    if(flag1=="") {
                        flag1=null;
                    } 
                    if(flag2=="") {
                        flag2=null;
                    } 
                    team_data.push(new Array(flag1,flag2));
                @endif
            @endforeach 

            var data= {
                teams:[

                    // ["team1",null],
                    // ["team8","team9"],
                    // ["team4",null],
                    // ["team5",null],
                    // ["team2",null],
                    // ["team3",null],
                    // ["team6",null],
                    // ["team7","team10"],
                    //team_data
                    
                ],
                 results:[
                //     [
                //         [null,null],[3,2],[null,null],[null,null],[null,null],[null,null],[null,null],[5,0],
                //     ],
                //     [
                //         [1,2],[0,2],[3,5],[1,0],
                //     ],
                //     [
                //         [3,2],[0,1],
                //     ],
                //     [
                //         [1,2],[2,5],
                //     ]
                 ]
            }
            $('#displayFixture').bracket({
                init: data
            });
        @endif
    </script>
@endsection