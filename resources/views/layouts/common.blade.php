<html>
<head>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!--Import Google Icon Font-->
        <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
        <link type="text/css" rel="stylesheet" href="/css/material-icons.css">
        
  <!--<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
        <!--Import materialize.css-->
         <!-- Compiled and minified CSS -->
  <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/css/materialize.min.css">-->
        <link type="text/css" rel="stylesheet" href="/css/materialize.min.css"  media="screen,projection"/>
        <link rel="stylesheet" type="text/css" href="/css/jquery.bracket.min.css" />
        
        <script type="text/javascript" src="/js/jquery.min.js"></script>
        <script type="text/javascript" src="/js/jquery.bracket.min.js"></script>
        {{-- <script type="text/javascript" src="/js/jquery-2.1.1.min.js') }}"></script> --}}
        <script type="text/javascript" src="/js/materialize.min.js"></script>
</head>
<body class="grey darken-4">
    
    @yield('content')


      <footer class="page-footer black">
           <div class="container">
             <div class="row">
               <div class="col l6 ">
                 <h5 class="white-text">About US <i class="material-icons" style="font-size: 50px; vertical-align:middle;">chevron_right</i></h5>
                 <p class="grey-text text-lighten-4">We made this website to automate the Rigours of Sport Management</p>
               </div>
               <div class="col 10 offset-l2">
                 <h5 class="white-text">Contact Us</h5>
                 <ul>
                   <li><a class="grey-text text-lighten-3" href="#!">Phone: (+91) 8767609797</a></li>
                   <li><a class="grey-text text-lighten-3" href="#!">Email: contactus.org@gmail.com</a></li>
                 </ul>
               </div>
             </div>
           </div>
           <div class="footer-copyright">
             <div class="container">
             © 2018 Copyright Text
             <a class="grey-text text-lighten-4 right" href="www.google.com">Sponsers</a>
             </div>
           </div>
         </footer>
         <!--JavaScript at end of body for optimized loading-->
            <!--Import jQuery before materialize.js-->
           
  <!-- Compiled and minified JavaScript -->
  <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.100.2/js/materialize.min.js"></script>-->
  {{-- <script type = "text/javascript"
  src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>        --}}
         
            @if(Session::has('message'))
            <script type="text/javascript">
                Materialize.toast("{{ Session::get('message')['msg'] }}", 4000, "{{ Session::get('message')['class'] }}");
            </script>
            @endif
            
            <script>
              function checkTeamName(t_id){

                //alert(t_id + " " + typeof(t_id));
                
                var team=document.getElementById('team_name').value;

                if(team!="") {

                    var t_id = parseInt(t_id);

                    $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                      });
                      $.ajax({
                          type:'POST',
                          url:'{{route('team.check')}}',
                          data: {
                            id : t_id,
                            team_name : team
                          },
                          success:function(response){
                              console.log(response);
                              if(response['status']=='success') {
                                $("#players").show();
                                $("#team-id").val(response['id']);
                                Materialize.toast('Team Name Registered', 3000, 'rounded green');
                                $("label").attr("data-error","Enter Different Name");
                              } else { 
                                Materialize.toast('Try Another Name', 3000, 'rounded red');
                              }
                          },
                          error:function(response){
                              console.log(response);
                              //alert('Something went wrong !');
                              Materialize.toast('Something Went Wrong. Try Again Later ! ', 3000, 'rounded')
                          }
                    });
                }        
            }
            function addScore(match_id,id) {
              //alert(match_id);
              var team1 = document.getElementById('team1_'+match_id).innerHTML;
              var team2 = document.getElementById('team2_'+match_id).innerHTML;
              var team1_goal = document.getElementById('t1_goal-'+match_id).value;
              var team2_goal = document.getElementById('t2_goal-'+match_id).value;
              var tournament_id = id;

              //alert(team1 + " " + team2 + " " + team1_goal + " "+ team2_goal);
              alert(tournament_id);
              $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                      });
                      $.ajax({
                          type:'POST',
                          url:'{{route('score.update')}}',
                          data: {
                            team1 : team1,
                            team2 : team2,
                            team1_goals : team1_goal,
                            team2_goals : team2_goal,
                            tournament_id : tournament_id,
                            match_id : match_id,
                          },
                          success:function(response){
                              console.log(response);
                              if(response['status']=='success') {
                                document.getElementById(match_id).innerHTML = 'Submited';
                              } else { 
                                Materialize.toast('Something Went Wrong', 3000, 'rounded red');
                              }
                          },
                          error:function(response){
                              console.log(response);
                              //alert('Something went wrong !');
                              Materialize.toast('Something Went Wrong. Try Again Later ! ', 3000, 'rounded red')
                          }
                    });
            }
            </script>
</body>
</html>
