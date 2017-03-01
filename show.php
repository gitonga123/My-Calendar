<?php
require_once('header.php');
?>
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
        <a href="/page/mark/exact_search" class="btn btn-warning"><i class="fa fa-search"> </i> Exact Search</a>
        <span style="margin-left: 5%"></span>

        <a href="/page/mark/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>
        <div style="padding-bottom: 2%"></div>
        <a href="#" id="delete_all" class="btn btn-danger">Delete All</a>
         <div style="padding-bottom: 2%"></div>
        <?php $count = count($hold)?>
        <?php echo "<p style='font-weight: bold; color: red'>Total Records=: " . $count . "</p>"; ?>
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
                foreach ($hold as $key => $value):
                    echo '<tr>';
                    echo '<td>' . $value["name"] . '</td><td>' . $value["home"]. '</td><td>'
                    . $value["draw"] . '</td><td>' . $value["away"] . '</td><td>' . $value["half"]. '</td>'
                    . '</td><td>' . $value["full"]. '</td>' . '</td><td>' . $value["result"]
                    . '</td><td>' . $value["league"] . '</td>';
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

        $("#delete_all").click(function(){
            var srvRqst = $.ajax({
                url: '/page/mark/delete_postpone',
                data: {},
                type: 'post'
            });
            
            srvRqst.done(function(response){
                var result = "Deleted";
                location.reload();
                $('div.user_error').html(result);
            });
        });
        
    </script>
</body>
</html>