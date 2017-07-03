<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type = "text/css" href="/page/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/page/assets/css/jquery-ui.min.css"></link>
        <link rel="stylesheet" href="/page/assets/css/jquery-ui.theme.min.css"></link> 
        <link rel="stylesheet" type="text/css" href="/page/assets/font-awesome/css/font-awesome.css"></link>
        <link rel="stylesheet" type="text/css" href="/page/assets/css/mystyle.css"></link>
        <link rel="shortcut icon" href="/page/assets/img/favicon.ico" type="image/x-icon"/>
        <style>
            body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
            .myLink {display: none}
        </style>
    </head>
    <body>

        <div class="container container-fluid">
            <div class="user_error">

            </div>
            <div style="padding-bottom: 2%"></div>
            <a href="/page/mark" class="btn btn-info"><i class="fa fa-home"></i> Home </a>
            <span style="margin-left: 5%"></span>
            <a href="/page/mark/add_result" class="btn btn-danger"><i class="fa fa-fast-forward"></i> Add / Ongeza</a>
            <span style="margin-left: 5%"></span>
            <a href="/page/mark/test_area" class="btn btn-info"><i class="fa fa-google"></i> Search</a>
            <span style="margin-left: 5%"></span>
            <a href="/page/mark/update_result" class="btn btn-success"><i class="fa fa-database"> </i> Update Result</a>

            <span style="margin-left: 5%"></span>
            <a href="/page/mark/summary" class="btn btn-info"><i class="fa fa-line-chart"> </i> Summary</a>

            <span style="margin-left: 5%"></span>
            <a href="/page/mark/exact_search" class="btn btn-warning"><i class="fa fa-search"> </i> Exact Search</a>
            <span style="margin-left: 5%"></span>

            <a href="#" class="btn btn-default" id="testing"><i class="fa fa-terminal"> </i> Testing</a>
            <span style="margin-left: 5%"></span>
            <div style="padding-bottom: 2%"></div>
            <a href="#" id="timeClock" class="btn btn-default"></a>
            <span style="margin-left: 5%"></span>
            <a href="/page/mark/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>
            <span style="margin-left: 5%"></span>
            <a href="/page/mark/inner_details" class="btn btn-default"><i class="fa fa-database"> </i> Outer Inter</a>
            <span style="margin-left: 5%"></span>
            <a href="/page/mark/update_halftime" class="btn btn-success"><i class="fa fa-bullhorn"> </i> Outer + Inner</a>
            <div style="padding-bottom: 2%"></div>

            <div class="search_form_result">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="form form-inline" method="post" action="#" id="submitResults">
                            
                            <div class="form-group">
                                <label for="team">
                                    OV2.5
                                </label>
                                
                                <input type="text" name="over" id="over" class="form-control" required = "required" />
                                
                            </div> 
                            
                            <div class="form-group">
                                <label for="team">
                                    GG
                                </label>
                                <input type="text" name="gg" id="gg" class="form-control" required = "required" />
                            </div> 
                            <div class="form-group">
                                <label for="team">
                                    HTO
                                </label>
                                <input type="text" name="half" id="half" class="form-control" required = "required" />
                                
                            </div>  
                                <button type="submit" class="btn btn-warning" id="send">
                                    <i class="fa fa-search"></i>    Search points
                                </button>
                        </form>
                    </div> 
                </div>
            </div>
            <span style="padding-bottom: 2%"></span>
            <div class="resultsearch">
            </div>
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
                    url: '/page/mark/gg_name',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);

                    $("#gg").autocomplete({
                        source: dataSource
                    });
                });

            });

            $(document).ready(function () {
                var srvRqst = $.ajax({
                    url: '/page/mark/over_name',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);

                    $("#over").autocomplete({
                        source: dataSource
                    });
                });

            });

            $(document).ready(function () {
                var srvRqst = $.ajax({
                    url: '/page/mark/half_name',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);

                    $("#half").autocomplete({
                        source: dataSource
                    });
                });

            });

            $("#send").click(function () {
                $('form#submitResults').on('submit', function (form) {
                    form.preventDefault();
                    $.post('/page/mark/get_inner', $('form#submitResults').serialize(), function (data) {
                        $('div.resultsearch').html(data);
                    });
                });
            });

        </script>
    </body>
</html>
