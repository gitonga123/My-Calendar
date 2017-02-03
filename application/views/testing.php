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
        <span style="margin-left: 5%"></span>
        <span style="margin-left: 30%"></span>
        <div style="padding-bottom: 1%"></div>
        <button class="btn btn-default" id="briefhome"><i class="fa fa-hand-o-up"></i> Correctly Identified</button>
        <span style="margin-left: 5%"></span>
        <button class="btn btn-info" id="briefdraw"><i class="fa fa-thumbs-down"></i> Wrongly Identified</button>

        <div style="padding-bottom: 1%"></div>
        <div class="rows">
            <div class="col-lg-6">
                <p class="alert alert-info">To Be Confirmed...</p>
                <table class="table table-condensed table-hover table-bordered" id="results1">

                    <thead>
                        <tr>
                            <th>Home</th>
                            <th>Draw</th>
                            <th>Away</th>
                            <th>Half</th>
                            <th>Full</th>
                            <th>Result</th>
                            <th>Other Result</th>
                            <th>Action</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($tested as $key => $value) {
                            echo "<tr>";
                            echo '<td>' . $value->home . "</td>";
                            echo '<td>' . $value->draw . "</td>";
                            echo '<td>' . $value->away . "</td>";
                            echo '<td>' . $value->result_ht . "</td>";
                            echo '<td>' . $value->result_ft . "</td>";
                            echo '<td>' . $value->results . "</td>";
                            echo '<td>' . $value->others . "</td>";
                            if ($value->okay == 1) {
                                echo "<td id='thumbs_down'><a href='#' class='btn btn-danger bt-xs' onclick='diactivates({$value->id})'><i class='fa fa-thumbs-down'></i></td>";
                                echo '<td>Activated</td>';
                            } else {
                                echo "<td id='thumbs_down'><a href='#' class='btn btn-info bt-xs' onclick='actives({$value->id})'><i class='fa fa-thumbs-up'></i></td>";
                                echo "<td>Diactivated</td>";
                            }


                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <p class="alert alert-success">Confirmed</p>
                <table class="table table-condensed table-hover table-bordered" id="results2">

                    <thead>
                        <tr>
                            <th>Home</th>
                            <th>Draw</th>
                            <th>Away</th>
                            <th>Half</th>
                            <th>Full</th>
                            <th>Result</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($matching as $key => $value) {
                            echo "<tr>";
                            echo '<td>' . $value['home'] . "</td>";
                            echo '<td>' . $value['draw'] . "</td>";
                            echo '<td>' . $value['away'] . "</td>";
                            echo '<td>' . $value['result_ht'] . "</td>";
                            echo '<td>' . $value['result_ft'] . "</td>";
                            echo '<td>' . $value['results'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal fade" id="myModal2" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title alert alert-info" >Percentage of Correctly Identified</h4>
                    </div>

                    <div class="modal-body" id="correct_case"> 

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="myModal3" role="dialog">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">×</button>
                        <h4 class="modal-title alert alert-danger">Percentage of Wrongly Identified</h4>
                    </div>

                    <div class="modal-body" id="wrong_case"> 

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="/page/assets/js/jquery-1.12.3.js"></script>
    <script type="text/javascript" src="/page/assets/jqueryui/jquery-ui.min.js"></script> 
    <script type="text/javascript" src='/page/assets/js/plugins/slimscroll/jquery.slimscroll.min.js'></script>
    <script type= "text/javascript" src="/page/assets/js/jquery.dataTables.min.js"></script>

    <script src="/page/assets/jqueryui/jquery-ui.min.js"></script>
    <script src="/page/assets/js/bootstrap.min.js"></script>
    <script src="/page/assets/js/chart.min.js"></script>
    <script>
        $("#results1").DataTable();
        $("#results2").DataTable();
        
        $("#briefhome").click(function () {
            $("#myModal2").modal({backdrop: false});

        });

        $("#briefdraw").click(function () {
            $("#myModal3").modal({backdrop: false});
        })
        function actives(data) {
            srvRqst = $.ajax({
                url: '/page/mark/mark_okay',
                type: 'post',
                data: {id: data},
                datatype: {},

            });
            srvRqst.done(function (response) {
                location.reload();
            });
        }

        function diactivates(data) {
            $('.loader').show();
            var srvRqst = $.ajax({
                url: '/page/mark/mark_down',
                data: {id: data},
                type: 'post',
                datatype: 'json'

            }
            );
            srvRqst.done(function (response) {
                location.reload();
            });
        }

        $(document).ready(function () {
            var srvRqst = $.ajax({
                url: '/page/mark/correct_tested',
                type: 'post',
                data: {},
                datatype: {}
            });

            srvRqst.done(function (response) {
                $('div#correct_case').html(response);
            });

            var srvRqsts = $.ajax({
                url: '/page/mark/wrong_tested',
                type: 'post',
                data: {},
                datatype: {}
            });

            srvRqsts.done(function (response) {
                $('div#wrong_case').html(response);
            });
        });
    </script>
</body>
</html>