<?php
require_once('header.php');
?>
</head>
<body>
	<div class=" container container-fluid">
	 	<a href="/page/mark/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>
       	<span style="margin-left: 5%"></span>
       	<a href="/page/mark/update_team" class="btn btn-warning"><i class="fa fa-upload"> </i> Update Team Name</a>
       	<span style="margin-left: 5%"></span>
       	<a href="/page/mark/exact_search" class="btn btn-danger"><i class="fa fa-fast-backward"> </i> Back</a>
       	<div style="padding-bottom: 2%"></div>
        <div class="row">
<?php
            
            echo "
                <div style='margin-top:10px'>
                <div class='container'>
                    <div class='row'>
                    <div class='col-md-12'>
                        <p class='alert alert-success'>Over/Under Analysis of <bold>{$home}</bold>, <bold>{$draw} </bold> and <bold>{$away}</bold></p>
                    </div>
                        <div class='col-md-6'>
                        <p class='alert alert-info'>Half Time Analysis</p>
                            <div class='col-md-6'>
                                <table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>Total Score</th>
                                            <th>Count</th></tr></thead><tbody>";

                                    foreach ($halftime_counted_values as $key => $value) {
                                           echo "<tr><td>" . $key ."</td><td>" .$value."</td></tr>";
                                    }
            echo" </tbody></table></div> ";
            echo "<div class='col-md-6'>
                <table class='table table-bordered'>
                    <thead>
                        <tr>
                            <th>Desc</th>
                            <th>Conclusion</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><th>Prediction</th><td>{$analysis[0]}</td></tr>
                        <tr><th>Percentage Win</th><td>{$analysis[1]}</td></tr>
                        <tr> <th>With Under</th><td>{$analysis[2]}</td></tr>
                        <tr><th>With Over</th><td>{$analysis[3]}</td></tr>
                    </tbody>
                </table>
            </div>
            </div>
                <div class='col-md-6'>
                <p class='alert alert-danger'>Full Time Analysis</p>
                    <div class='col-md-6'>
                        <table class='table table-bordered'>
                            <thead>
                                <tr>
                                    <th>Total Score</th>
                                    <th>Count</th></tr></thead><tbody>";

                            foreach ($fulltime_counted_values as $key => $value) {
                                   echo "<tr><td>" . $key ."</td><td>" .$value."</td></tr>";
                            }
            echo" </tbody></table></div>";
                echo "

                <div class='col-md-6'>
                                <table class='table table-bordered'>
                                    <thead>
                                        <tr>
                                            <th>Desc</th>
                                            <th>Conclusion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><th>Prediction</th><td>{$analysisf[0]}</td></tr>
                                        <tr><th>Percentage Win</th><td>{$analysisf[1]}</td></tr>
                                        <tr> <th>With Under</th><td>{$analysisf[2]}</td></tr>
                                        <tr><th>With Over</th><td>{$analysisf[3]}</td></tr>
                                    </tbody>
                                </table>
                                

                            </div>
                        </div>
                        <div class='col-md-6'>
                            	<table class='table table-condensed'>
                                    <thead>
                                        <tr>
                                            <th>Desc</th>
                                            <th>Conclusion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><th>Prediction</th><td>{$gg_halftime['prediction']}</td></tr>
                                        <tr><th>Percentage Win</th><td>{$gg_halftime['percentage_win']}</td></tr>
                                        <tr><th>GG</th><td>{$gg_halftime['GG']}</td></tr>
                                        <tr><th>NG</th><td>{$gg_halftime['NG']}</td></tr>
                                    </tbody>
                                </table>
                        </div>
                        <div class='col-md-6'>
                            	<table class='table table-condensed'>
                                    <thead>
                                        <tr>
                                            <th>Desc</th>
                                            <th>Conclusion</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr><th>Prediction</th><td>{$gg_fulltime['prediction']}</td></tr>
                                        <tr><th>Percentage Win</th><td>{$gg_fulltime['percentage_win']}</td></tr>
                                        <tr><th>GG</th><td>{$gg_fulltime['GG']}</td></tr>
                                        <tr><th>NG</th><td>{$gg_fulltime['NG']}</td></tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
                </div>
            ";
            ?>
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