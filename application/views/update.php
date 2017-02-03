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
            <div class="user_error">

            </div>
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
            <a href="/page/mark/exact_search" class="btn btn-warning"><i class="fa fa-search"> </i> Exact Search</a>
            <span style="margin-left: 5%"></span>

            <a href="/page/mark/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>
            <span style="margin-left: 5%"></span>
            <div style="padding-bottom: 2%"></div>
            <a href="/page/mark/files" class="btn btn-danger"> Files Testing</a>
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
                        echo "<td>" . "<input type='text' id='results' placeholder ='Results' class='form-control'/>" . "</td>";
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
                    var result = $("#results").val();

                    var srvRqst = $.ajax({
                        url: '/page/mark/result_update',
                        type: 'post',
                        data: {halftime: halftime, fulltime: fulltime, results: result, id: id},
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