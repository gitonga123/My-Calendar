<?php
require_once('header.php');
?>
<link rel="stylesheet" href="/page/assets/css/jquery-ui.theme.min.css"></link> 
</head>
<body>
    <div class=" container container-fluid">
        <div style="padding-bottom: 2%"></div>
        <a href="/page/mark" class="btn btn-info"><i class="fa fa-home"></i> Home </a>
        <span style="margin-left: 5%"></span>
        <a href="/page/mark/add_result" class="btn btn-danger"><i class="fa fa-fast-forward"></i> Add / Ongeza</a>
        <span style="margin-left: 5%"></span>
        <a href="/page/mark/search_area" class="btn btn-warning"><i class="fa fa-search"></i> Search</a>
        <span style="margin-left: 5%"></span>
        <a href="/page/mark/update_result" class="btn btn-success"><i class="fa fa-database"> </i> Update Result</a>

        <span style="margin-left: 5%"></span>
        <a href="/page/mark/summary" class="btn btn-info"><i class="fa fa-line-chart"> </i> Summary</a>
        <span style="margin-left: 5%"></span>
        <a href="#" id="timeClock" class="btn btn-default"></a>
        <span style="margin-left: 5%"></span>
        <a href="/page/mark/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>
        <span style="margin-left: 5%"></span>
        
        <div style="padding-bottom: 2%"></div>
        <a href="/page/mark/exact_search" class="btn btn-warning"><i class="fa fa-upload"> </i> Exact Search</a>
        <span style="margin-left: 5%"></span>
        <a href="#" class="btn btn-warning" id="update_team"><i class="fa fa-database"> </i> Update Teams</a>
         <span style="margin-left: 5%"></span>
        <a href="#" class="btn btn-default" id="delete_teams"><i class="fa fa-eraser" aria-hidden="true"> </i> Delete Updated Teams</a>
        <div style="padding-bottom: 2%"></div>
        <div class="row">
            <div class="user_error">

            </div>
            <div class="col-lg-12">
                <table class="table table-hover table-condensed" id='resultsTables'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Home</th>
                        <th>Draw</th>
                        <th>Away</th>
                        <th>Team Name</th>
                        <th>League</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    if(!empty($upload)){
                        foreach ($upload as $key => $value) {
                            if(empty($value->team_name)){
                                echo "<tr>";
                                echo "<td>" . $value->id . "</td>";
                                echo "<td>" . $value->home . "</td>";
                                echo "<td>" . $value->draw . "</td>";
                                echo "<td>" . $value->away . "</td>";

                                echo "<td>" . "<input type='text' id='teamname' placeholder ='Team Name' class='form-control'/>" . "</td>";
                                echo "<td>" . "<input type='text' id='league' placeholder ='League' class='form-control'/>" . "</td>";                        
                                echo "<td style='display:none;'>" . "<input type='text' id='teamid' value='" . $value->id . "' />" . "</td>";
                                echo "<td><button class='btn btn-info' id='sendupdate'>Send</button></td>";

                                echo "</tr>";
                            }
                        }
                    }
                    ?> 
                </tbody>
            </table>
            </div>

        </div>
    </div>

    <script src="/page/assets/js/jquery-1.12.3.js"></script>
        <script type="text/javascript" src="/page/assets/jqueryui/jquery-ui.min.js"></script> 
        <script type="text/javascript" src='/page/assets/js/plugins/slimscroll/jquery.slimscroll.min.js'></script>
        <script type= "text/javascript" src="/page/assets/js/jquery.dataTables.min.js"></script>
        <script src="/page/assets/jqueryui/jquery-ui.min.js"></script>
        <script src="/page/assets/js/bootstrap.min.js"></script>
        <script src="/page/assets/js/customer.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $("#sendupdate").click(function () {
                    
                    
                    var id = $("#teamid").val();
                    var teamname = $("#teamname").val();
                    var league = $("#league").val();
                    
                    if(teamname.length !=0 || league.length != 0){               
                        var srvRqst = $.ajax({
                            url: '/page/mark/update_team_league',
                            type: 'post',
                            data: {teamname: teamname, league: league,id: id},
                            datatype: 'text',

                         });

                        srvRqst.done(function (response) {
                            $('div.user_error').html(response);
                            location.reload();
                        });  
                    }else{
                        $("#league").css('border','solid 1px red');
                        $("#teamname").css('border','solid 1px red');  
                        console.log("Daniel");  
                    }
                    
                });

                var srvRqst = $.ajax({
                    url: '/page/mark/league_suggest',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);
                   
                    $("#league").autocomplete({
                        source: dataSource
                    });
                });

                var srvRqst = $.ajax({
                    url: '/page/mark/team_suggest',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);
                    
                    $("#teamname").autocomplete({
                        source: dataSource
                    });
                });
            });

            $("#update_team").click(function () {
                var serverRqst = $.ajax({
                    url: '/page/mark/update_holdon',
                    data: {},
                    type: 'post'
                });

                serverRqst.done(function (response) {
                    $('div.user_error').html(response);
                });
            });
   
            $("#delete_teams").click(function () {
                var serverRqst = $.ajax({
                    url: '/page/mark/delete_updated',
                    data: {},
                    type: 'post'
                });

                serverRqst.done(function (response) {
                    $('div.user_error').html(response);
                });
            });

        </script>
    </body>
</html>