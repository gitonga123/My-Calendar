<?php
require_once('header.php');
?>
</head>
<body>
    <div class=" container container-fluid">
        <div style="padding-bottom: 2%"></div>
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
        <a href="#" class="btn btn-danger" id="upload_data"><i class="fa fa-upload"> </i> Uploads</a>

        <div style="padding-bottom: 2%"></div>
        
        <a href="/page/mark/post" class="btn btn-default" ><i class="fa fa-lock"></i> Postponed</a>
        <span style="margin-left: 5%"></span>  
        <a href="#" id="timeClock" class="btn btn-default"></a>
      
       <span> <?php echo "<p style='font-weight: bold; color: red'>Total Records=: " . $count . "</p>"; ?></span>
       <div class="user_error"></div>

        <table class="table table-hover table-condensed" id='resultsTables'>
            <thead>
                <tr>
                    <th>Team Name</th>
                    <th>Home</th>
                    <th>Draw</th>
                    <th>Away</th>
                    <th>Half Time</th>
                    <th>Full Time</th>
                    <th>Results</th>
                    <th>League</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($odds as $value_odd):
                    echo '<tr>';
                    echo '<td>' . $value_odd->team_name . '</td><td>' . $value_odd->home . '</td><td>'
                    . $value_odd->draw . '</td><td>' . $value_odd->away . '</td><td>' . $value_odd->result_ht . '</td>'
                    . '</td><td>' . $value_odd->result_ft . '</td>' . '</td><td>' . $value_odd->results
                    . '</td><td>' . $value_odd->league . '</td>';
                    echo '</tr>';
                endforeach;
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
     <script src="/page/assets/js/customer.js"></script>

    <script type="text/javascript">
        $(document).ready(function () {
            $('#resultsTables').DataTable();
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
                document.getElementById("upload_data").className = "btn btn-danger disabled";
                $('div.user_error').html(response);
            }); 
        });
 
    </script>
</body>
</html>