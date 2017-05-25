<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type = "text/css" href="/page/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/page/assets/css/jquery-ui.min.css"></link>
        <link rel="stylesheet" href="/page/assets/css/jquery-ui.theme.min.css"></link> 
        <link rel="stylesheet" type="text/css" href="/page/assets/font-awesome/css/font-awesome.css"></link>
        <style>
            body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
            .myLink {display: none}
        </style>
    </head>
    <body id='update_table'>

        <div class="container container-fluid">
        <div style="padding-bottom: 2%"></div>
            <div class="row">
                <div class="col-md-2">
                    <a href="/page/mark" class="btn btn-info"><i class="fa fa-home"></i> Home </a>
                </div>
                <div class="col-md-2">
                    <a href="/page/mark/add_result" class="btn btn-danger"><i class="fa fa-fast-forward"></i> Add / Ongeza</a>
                </div>
                <div class="col-md-2">
                    <a href="/page/mark/search_area" class="btn btn-warning"><i class="fa fa-search"></i> Search</a>
                </div>
                <div class="col-md-2">
                    <a href="/page/mark/update_result" class="btn btn-success"><i class="fa fa-database"> </i> Update Result</a>
                </div>
                <div class="col-md-2">
                    <a href="/page/mark/summary" class="btn btn-info"><i class="fa fa-line-chart"> </i> Summary</a>
                </div>
                <div class="col-md-2">
                    <a href="/page/mark/exact_search" class="btn btn-warning"><i class="fa fa-search"> </i> Exact Search</a>
                </div>
                <div style="padding-bottom: 5%"></div>
                <div class="col-md-4">
                     <a href="/page/mark/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>
                </div>
                <div class="col-md-4">
                     <a href="/page/mark/files" class="btn btn-danger"> Files Testing</a>
                </div>
                 <div class="col-md-4">
                    <a href="#" class="btn btn-danger" id="upload_data"><i class="fa fa-upload"> </i> Advanced Uploads</a>
                </div>
            </div>
            <div style="padding-bottom: 1%"></div>
            <div class="user_error">

            </div>
            <p style="color: blue;" id="entry_error" class="alert alert-danger">Error Section</p>
            <table class="table table-hover table-condensed" id='resultsTables'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Team Name</th>
                        <th>Home</th>
                        <th>Draw</th>
                        <th>Away</th>
                        <th>Result Half Time</th>
                        <th>Result Full Time</th>
                        <th>Results</th>
                        <th>League</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    foreach ($hold as $key => $value) {
                        echo "<tr>";
                        echo "<td>" . $value['id'] . "</td>";
                        echo "<td>" . $value['team_name'] . "</td>";
                        echo "<td>" . $value['home'] . "</td>";
                        echo "<td>" . $value['draw'] . "</td>";
                        echo "<td>" . $value['away'] . "</td>";
                        echo "<td>" . "<input type='text' id='halftime' placeholder ='half time' class='form-control'/>" . "</td>";
                        echo "<td>" . "<input type='text' id='fulltime' placeholder ='full time' class='form-control'/>" . "</td>";
                        echo "<td>" . $value['league'] . "</td>";
                        echo "<td style='display:none;'>" . "<input type='text' id='teamid' value='" . $value['id'] . "' />" . "</td>";
                        echo "<td>" . $value['times'] . "</td>";
                        echo "<td><button class='btn btn-info' id='sendupdate'>Send</button></td>";

                        echo "</tr>";
                    }
                    ?> 
                </tbody>
            </table>
        </div>
        <script src="/page/assets/js/jquery-1.12.3.js"></script>
        <script type="text/javascript" src="/page/assets/jqueryui/jquery-ui.min.js"></script> 
        <script type="text/javascript" src='/page/assets/js/plugins/slimscroll/jquery.slimscroll.min.js'></script>
        <script type= "text/javascript" src="/page/assets/js/jquery.dataTables.min.js"></script>
        <script src="/page/assets/jqueryui/jquery-ui.min.js"></script>
        <script src="/page/assets/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#sendupdate").click(function () {
                    console.log("Daniel");
                    
                    var id = $("#teamid").val();
                    var halftime = $("#halftime").val();
                    var fulltime = $("#fulltime").val();

                    var pattern='^[0-9]*\-[0-9]*\$';
                    var fulltimes = fulltime.match(pattern);
                    var halftimes = halftime.match(pattern);
                    if(fulltimes != null || fulltime === 'P'){
                        if(halftime.length >= 1 && halftimes != null ||halftime ==='P'){
                            var compare1 = halftime.split("-");
                            var compare2 = fulltime.split("-");
                            if(compare1.constructor === Array && compare2.constructor === Array){
                                var total = 0;
                                var total2 = 0;
                                var resultss = '';
                                for(var i = 0; i < compare1.length; i++){
                                    total = total + Number(compare1[i]);
                                }

                                for(var i = 0; i < compare2.length; i++){
                                    total2 = total2 + Number(compare2[i]);
                                }
                                if(total2 < total){
                                    
                                    // if(compare1[0] > compare2[0] || compare1[1] > compare2[1]){
                                        $("#halftime").css('border','solid 1px red');
                                        $("#fulltime").css('border','solid 1px red');
                                        document.getElementById("entry_error").innerHTML=" Check your Half and Fulltime Result";
                                    // }
                                }else{
                                    var res1 = compare2[0];
                                    var res2 = compare2[1];
                                    if(isNaN(res1) && isNaN(res2)){
                                        var srvRqst = $.ajax({
                                            url: '/page/mark/result_update',
                                            type: 'post',
                                            data: {halftime: halftime, fulltime: fulltime, results: fulltime, id: id},
                                            datatype: 'text',
                                         });

                                        srvRqst.done(function (response) {
                                            $('div.user_error').html(response);
                                            location.reload();
                                        });
                                    }else{
                                        if(halftime === 'P' || halftime =='P'){
                                            halftime = ' '
                                        }
                                        if(res1 > res2){
                                            resultss = '1'
                                        }else if(res1 == res2){
                                            resultss = 'X'
                                        }else if(res1 < res2){
                                            resultss = '2'
                                        }
                                        var srvRqst = $.ajax({
                                            url: '/page/mark/result_update',
                                            type: 'post',
                                            data: {halftime: halftime, fulltime: fulltime, results: resultss, id: id},
                                            datatype: 'text',
                                         });

                                        srvRqst.done(function (response) {
                                            $('div.user_error').html(response);
                                            location.reload();
                                        });
                                    }   
                                }      
                            }    
                      }else{
                        $("#halftime").css('border','solid 1px red');
                        document.getElementById("entry_error").innerHTML="Content Missing || Wrong Entry";

                      } 
                    }else{
                        $("#fulltime").css('border','solid 1px red'); 
                        document.getElementById("entry_error").innerHTML="Content Missing || Wrong Entry";   
                    }
                    
                     });

                });

                $('#upload_data').click(function(){
                
                var time = prompt("Please enter the time");

                var srvRqst = $.ajax({
                    url: '/page/mark/transafer',
                    type: 'post',
                    data: {time: time},
                    datatype: 'text',

                 });

                srvRqst.done(function (response) {
                    document.getElementById("upload_data").className = "btn btn-danger";
                    $('div.user_error').html(response);
                }); 
            });

                
        </script>
    </body>

</html>