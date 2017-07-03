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

            .vr {
                width:10px;
                background-color:#000;
                position:absolute;
                top:0;
                bottom:0;
                left:150px;
            }
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
                <div class="col-md-3">
                    <a href="/page/mark/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>
                </div>
                <div class="col-md-3">
                    <a href="/page/mark/setting" class="btn btn-info" target="_blank"><i class="fa fa-database"> </i> System Settings</a>
                </div>
                <div class="col-md-3">
                    <a href="/page/mark/inner_details" class="btn btn-default"><i class="fa fa-database"> </i> Outer Inter</a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="btn btn-danger" id="upload_data"><i class="fa fa-upload"> </i> Advanced Uploads</a>
                </div>
            </div>
            <div style="padding-bottom: 1%"></div>
            <div class="user_error">

            </div>
            <p style="color: blue;" id="entry_error" class="alert alert-danger">Error Section</p>
            <div class="row">
                <div class="col-md-4">
                    <table class="table table-hover table-condensed" id='resultsTables'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Team Name</th>
                                <th>Home</th>
                                <th>Draw</th>
                                <th>Away</th>
                                <th>Time</th>
                                <th>Date</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($new_result as $key => $value) {
                                echo "<tr><td>{$value->id}</td>";
                                echo "<td>{$value->team_name}</td>";
                                echo "<td>{$value->home}</td>";
                                echo "<td>{$value->draw}</td>";
                                echo "<td>{$value->away}</td>";
                                echo "<td>{$value->date}</td>";
                                echo "<td>{$value->times}</td>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class=" col-md-1" >&nbsp;</div>
                <div class="col-md-7">
                    <table class="table table-hover table-condensed" id='resultsTables'>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Team Name</th>
                                <th>Home</th>
                                <th>Draw</th>
                                <th>Away</th>
                                <th>Time</th>
                                <th>Date</th>
                                <th>Half ID</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($result as $key => $value) {
                                echo "<tr><td>{$value->id}</td>";
                                echo "<td>{$value->team_name}</td>";
                                echo "<td>{$value->home}</td>";
                                echo "<td>{$value->draw}</td>";
                                echo "<td>{$value->away}</td>";
                                echo "<td>{$value->date}</td>";
                                echo "<td>{$value->times}</td>";
                                echo "<td>" . "<input type='text' id='fulltime' placeholder ='Team Id' class='form-control'/>" . "</td>";
                                echo "<td style='display:none;'>" . "<input type='text' id='teamid' value='" . $value->id . "' />" . "</td>";
                                echo "<td><button class='btn btn-info' id='sendupdate'>Send</button></td>";
                                echo "</tr>";
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
        <script type="text/javascript">
            $(document).ready(function () {
                $("#sendupdate").click(function () {
                    console.log("Daniel");

                    var id = $("#teamid").val();
                    var half_id = $("#fulltime").val();
                    var srvRqst = $.ajax({
                        url: '/page/mark/update_halftime_team_id',
                        type: 'post',
                        data: {id: id, half_id: half_id},
                        datatype: 'text',
                    });

                    srvRqst.done(function (response) {
                        $('div.user_error').html(response);
                        location.reload();
                    });

                });
            });
        </script>
    </body>

</html>