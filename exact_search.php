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
        <a href="#" id="timeClock" class="btn btn-default"></a>
        <span style="margin-left: 5%"></span>
        <a href="/page/mark/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>
        <span style="margin-left: 5%"></span>
        <span style="margin-left: 30%"></span>
        <div style="padding-bottom: 2%"></div>
        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal" method="post" action="/page/mark/exact_search">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="home">
                                Home:
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="home" class="form-control" required="required">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">		
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="draw">
                                Draw:
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="draw" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">	
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="away">
                                Away:
                            </label>
                            <div class="col-sm-10">
                                <input type="text" name="away" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="form-group">
                            <div class="col-sm-10">
                                <input type="submit" class="btn btn-info" value="Search">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-12">
                <div class="col-lg-2">
                    <?php
                    if (is_array($exact_search) && is_array($hold_search) && is_array($exact_search_hold)) {
                        if (!empty($exact_search)) {
                            $hold1 = count($exact_search);
                            echo "<p class='alert alert-danger'>Result:</p>";
                            echo "<h3>{$hold1}</h1>";
                        } elseif (!empty($hold_search)) {
                            $hold2 = count($hold_search);
                            echo "<p class='alert alert-danger'>Result:</p>";
                            echo "<h3>{$hold2}</h1>";
                        } elseif (!empty($exact_search_hold)) {
                            $hold3 = count($exact_search_hold);
                            echo "<p class='alert alert-danger'>Result:</p>";
                            echo "<h3>{$hold3}</h1>";
                        } else {
                            echo "<p class='alert alert-danger'>Result:</p>";
                            echo "Nothing Much";
                        }
                    }
                    ?>
                </div>
                <div class="col-lg-8">
                    <?php
                    if (is_array($exact_search) && is_array($hold_search) && is_array($exact_search_hold)) {
                        echo "
		        				<table class='table table-hover table-bordered'>
				        			<thead>
				        				<th>Home</th>
				        				<th>Draw</th>
				        				<th>Away</th>
				        				<th>Half Time</th>
				        				<th>Full Time</th>
				        				<th>Judgement</th>
				        				<th>League</th>
				        			</thead><tbody>
		        			";
                        if (!empty($exact_search)) {
                            foreach ($exact_search as $key => $value) {
                                echo "<tr>";
                                echo "<td>{$value['home']}</td>";
                                echo "<td>{$value['draw']}</td>";
                                echo "<td>{$value['away']}</td>";
                                echo "<td>{$value['result_ht']}</td>";
                                echo "<td>{$value['result_ft']}</td>";
                                echo "<td>{$value['results']}</td>";
                                echo "<td>{$value['league']}</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                        } elseif (!empty($hold_search)) {

                            foreach ($hold_search as $key => $value) {
                                echo "<tr>";
                                echo "<td>{$value['home']}</td>";
                                echo "<td>{$value['draw']}</td>";
                                echo "<td>{$value['away']}</td>";
                                echo "<td>{$value['result_ht']}</td>";
                                echo "<td>{$value['result_ft']}</td>";
                                echo "<td>{$value['results']}</td>";
                                echo "<td>{$value['league']}</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                        } elseif (!empty($exact_search_hold)) {


                            foreach ($exact_search_hold as $key => $value) {
                                echo "<tr>";
                                echo "<td>{$value['home']}</td>";
                                echo "<td>{$value['draw']}</td>";
                                echo "<td>{$value['away']}</td>";
                                echo "<td>{$value['result_ht']}</td>";
                                echo "<td>{$value['result_ft']}</td>";
                                echo "<td>{$value['results']}</td>";
                                echo "<td>{$value['league']}</td>";
                                echo "</tr>";
                            }
                            echo "</tbody>";
                        }
                        echo "</table>";
                    } else {
                        echo $exact_search_hold;
                    }
                    ?>
                </div>
                <div class="col-lg-2">

                </div>
            </div>
        </div>
        <script src="/page/assets/js/jquery-1.12.3.js"></script>
        <script type="text/javascript" src="/page/assets/jqueryui/jquery-ui.min.js"></script> 
        <script type="text/javascript" src='/page/assets/js/plugins/slimscroll/jquery.slimscroll.min.js'></script>
        <script type= "text/javascript" src="/page/assets/js/jquery.dataTables.min.js"></script>
        <script src="/page/assets/js/bootstrap.min.js"></script>
         <script src="/page/assets/js/customer.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                // $('#resultsTables').DataTable();
                // $('#resultsTables2').DataTable();
                // $('#resultsTables3').DataTable();
            });
        </script>
</body>
</html>