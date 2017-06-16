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
           
            <a href="/page/mark/inner_details" class="btn btn-default"><i class="fa fa-database"> </i> Outer Inter</a>
            <div style="padding-bottom: 2%"></div>

            <form class="form-horizontal" method="post" action="/page/mark/add_result" id="submitResults">
                <div class="form-group">
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="team">
                            Team Name
                        </label>
                        <div class="col-sm-10">
                            <input type="text" name="team" id="teamname" class="form-control" required = "required" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="home">
                            Home
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="home" id="home" class="form-control" pattern="^[0-9]*\.[0-9]{2}$" required = "required" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="draw">
                            Draw
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="draw" id="draw" class="form-control" pattern="^[0-9]*\.[0-9]{2}$" required = "required" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="away">
                            Away 
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="away" id="away" class="form-control" pattern="^[0-9]*\.[0-9]{2}$" required = "required" />
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-sm-2" for="resultHt">
                            Half Time Result
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="halftime" id="result_ht" class="form-control"  />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="resultFt">
                            Full Time Result
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="fulltime" id="result_ft" class="form-control" />
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="result">
                            Result
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="results" id="results" class="form-control"  />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="league">
                            League
                        </label>
                        <div class="col-sm-5">
                            <input type="text" name="league" id="league" class="form-control" required = "required" />
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
        <script src="/page/assets/js/jquery.validate.min.js"></script>
        <script src="/page/assets/js/bootstrap.min.js"></script>
         <script src="/page/assets/js/customer.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {

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

                var srvRqst = $.ajax({
                    url: '/page/mark/half_suggest',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);
                    
                    $("#result_ht").autocomplete({
                        source: dataSource
                    });
                });

                var srvRqst = $.ajax({
                    url: '/page/mark/full_suggest',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);
                  
                    $("#result_ft").autocomplete({
                        source: dataSource
                    });
                });

                var srvRqst = $.ajax({
                    url: '/page/mark/result_suggest',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);
                   
                    $("#results").autocomplete({
                        source: dataSource
                    });
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
            });
        </script>
    </body>
</html>
