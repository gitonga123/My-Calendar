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
    <body>

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
            <a href="#" id="timeClock" class="btn btn-default"></a>
            <span style="margin-left: 5%"></span>
            <div style="padding-bottom: 1%"></div>
            <a href="/page/mark/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>
            <span style="margin-left: 5%"></span>
            <div style="padding-bottom: 2%"></div>

            <form class="form-horizontal" method="post" action="/page/mark/added_halftime" id="submitResults">
                <div class="form-group">
                	<div class="form-group">
                        <label class="control-label col-sm-2" for="team">
                            Team Name
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="team_name" id="teamname" class="form-control" required = "required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="team">
                            Home
                        </label>
                        <div class="col-sm-5">
                        	<?php 
                            echo '<input type="text" name="home" id="home" class="form-control" value="'.$value1.'" required = "required"/>';
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="home">
                            Draw
                        </label>
                        <div class="col-sm-5">
                           <?php 
                            echo '<input type="text" name="draw" id="draw" class="form-control" pattern="^[0-9]*\.[0-9]{2}$" value = "'.$value2.'" required = "required" />';
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="draw">
                            Away
                        </label>
                        <div class="col-sm-5">
                        	<?php 
                            echo '
                            <input type="text" name="away" id="away" class="form-control" pattern="^[0-9]*\.[0-9]{2}$" value = "'.$value3.'" required = "required"/>';
                            ?>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="away">
                            Over 2.5
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="over" id="home" class="form-control" pattern="^[0-9]*\.[0-9]{2}$" required = "required" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="resultHt">
                            Under 2.5
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="under" id="home" class="form-control" pattern="^[0-9]*\.[0-9]{2}$" required = "required"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="away">
                            GG
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="gg" id="home" class="form-control" pattern="^[0-9]*\.[0-9]{2}$" required = "required" />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="away">
                            NG
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="ng" id="home" class="form-control" pattern="^[0-9]*\.[0-9]{2}$" required = "required" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="resultFt">
                            Over HT
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="hfo" id="home" class="form-control" pattern="^[0-9]*\.[0-9]{2}$" required = "required"/>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="result">
                            Under HT
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="hfu" id="home" class="form-control" pattern="^[0-9]*\.[0-9]{2}$" required = "required"/>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-5">
                            <input type="submit" class="btn btn-success" id="send" value="Submit">
                        </div>
                    </div>
            </form>
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

                var srvRqst = $.ajax({
                    url: '/page/mark/home_suggest',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);
                  
                    $("#home").autocomplete({
                        source: dataSource
                    });
                });


                var srvRqst = $.ajax({
                    url: '/page/mark/away_suggest',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);
                   
                    $("#away").autocomplete({
                        source: dataSource
                    });
                });

                var srvRqst = $.ajax({
                    url: '/page/mark/draw_suggest',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);
                   
                    $("#draw").autocomplete({
                        source: dataSource
                    });
                });  
            });
        </script>
    </body>
</html>
