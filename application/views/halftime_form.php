<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- VENDOR -->
        <link rel="stylesheet" href="/page/assets/styles/jqueryui.min.css">
        <link rel="stylesheet" href="/page/assets/styles/bootstrap.min.css">
        <link rel="stylesheet" href="/page/assets/css/jquery-ui.min.css"></link>
        <link rel="stylesheet" href="/page/assets/css/jquery-ui.theme.min.css"></link> 
        <!-- END VENDOR -->
        
        <!-- WRAPKIT -->
       <!--  <link rel="stylesheet" href="/page/assets/styles/wrapkit.min.css">
        <link rel="stylesheet" href="/page/assets/styles/wrapkit-skins-all.min.css">
        --> <!-- END WRAPKIT -->

        <!-- !IMPORTANT DEPENDENCIES -->
        <link rel="stylesheet" type="text/css" href="/page/assets/font-awesome/css/font-awesome.css"></link>
        <link rel="stylesheet" href="/page/assets/styles/switchery.min.css">
        <link rel="stylesheet" href="/page/assets/styles/toastr.min.css">
        <link rel="stylesheet" href="/page/assets/styles/prettify.min.css">
        <!-- END !IMPORTANT DEPENDENCIES -->

        <!-- DEPENDENCIES -->
        <link rel="stylesheet" href="/page/assets/styles/select2.min.css">
        <link rel="stylesheet" href="/page/assets/styles/wizard.min.css">
        <!-- END DEPENDENCIES -->



        <!-- JUST DEMO: Remove this css in your project -->
        <link rel="stylesheet" href="/page/assets/styles/demo.min.css">


        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
        <title><?php echo $title; ?></title>
    </head>

    <body>
        <main id="wrapper" class="container">
            <section class="content-wrapper">
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
                <span style="margin-left: 5%"></span>
                <a href="/page/mark/update_halftime" class="btn btn-success"><i class="fa fa-bullhorn"> </i> Outer + Inner</a>
                <div style="padding-bottom: 2%"></div>
                <div class="row">

                <div class="col-md-2">
                </div>
                <div class="col-md-8">
            
                   <div class="content">

                        <!-- WIZARD
                        ================================================== -->
                        <div class="panel panel-default">
                            <div class="panel-body">
                                <div class="wizard" id="rootwizard">
                                    <ul>
                                        <li>
                                            <a href="#wizard1" data-toggle="tab">
                                                <span class="number">1</span>
                                                <span class="desc">Match Details</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#wizard2" data-toggle="tab">
                                                <span class="number">2</span>
                                                <span class="desc">Over/Under</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#wizard3" data-toggle="tab">
                                                <span class="number">3</span>
                                                <span class="desc">Goal/No Goal</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="#wizard4" data-toggle="tab">
                                                <span class="number">4</span>
                                                <span class="desc">HTO/HTU</spn>
                                            </a>
                                        </li>
                                    </ul><!-- /wizard-nav -->

                                    <div class="progress progress-striped">
                                        <div class="progress-bar"></div>
                                    </div><!-- /.progressbar -->

                                    <form class="form-horizontal" method="post" action="/page/mark/added_halftime" id="submitResults" role="form">
                                    <div class="tab-content">
                                        <div class="tab-pane" id="wizard1">
                                            <h3 class="lead">Match Details: Team Name</h3>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="team name">Team Name <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <div class="input-group input-group-in">

                                                        <input class="form-control" id="team_name" name="team_name" required="required">
                                                        <span class="input-group-addon"><i class="fa fa-user text-muted"></i></span>
                                                    </div>
                                                </div>
                                            </div><!-- /form-group -->

                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="home">Home <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <div class="input-group input-group-in">
                                                    <?php echo '
                                                        <input class="form-control" id="home" name="home" type="text" pattern="^[0-9]*\.[0-9]{2}$" required="required" value="'.$value1.'">'; ?>
                                                        <span class="input-group-addon"><i class="fa fa-home text-muted"></i></span>
                                                    </div>
                                                </div>
                                            </div><!-- /form-group -->

                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="away">Draw <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <div class="input-group input-group-in">
                                                    <?php echo '
                                                        <input class="form-control" id="draw" name="draw" type="text" pattern="^[0-9]*\.[0-9]{2}$" required="required" value="'.$value2.'">'; ?>
                                                        <span class="input-group-addon"><i class="fa fa-bookmark text-muted"></i></span>
                                                    </div>
                                                </div>
                                            </div><!-- /form-group -->

                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="away">Away <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <div class="input-group input-group-in">
                                                         <?php echo '
                                                        <input class="form-control" id="away" name="away" type="text" pattern="^[0-9]*\.[0-9]{2}$" required="required" value="'.$value3.'">'; ?>
                                                        <span class="input-group-addon"><i class="fa fa-bus text-muted"></i></span>
                                                    </div>
                                                </div>
                                            </div><!-- /form-group -->
                                        </div><!-- /.tab-pane -->

                                        <div class="tab-pane" id="wizard2">
                                            <h3 class="lead">Over / Under 2.5</h3>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="over">Over 2.5 <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input class="form-control" id="over" name="over" type="text" pattern="^[0-9]*\.[0-9]{2}$" required="required">
                                                </div>
                                            </div><!-- /form-group -->
                                            
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="under">Under 2.5 <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input class="form-control" id="under" name="under" type="text" pattern="^[0-9]*\.[0-9]{2}$" required="required">
                                                </div>
                                            </div><!-- /form-group -->
                                        </div><!-- /.tab-pane -->
                                        <div class="tab-pane" id="wizard3">
                                            <h3 class="lead">Goal / No Goal</h3>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="gg">GG <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input class="form-control" id="gg" name="gg" type="text" pattern="^[0-9]*\.[0-9]{2}$" required="required">
                                                </div>
                                            </div><!-- /form-group -->

                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="ng">No Goal <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input class="form-control" id="ng" name="ng" type="text" pattern="^[0-9]*\.[0-9]{2}$" required="required">
                                                </div>
                                            </div><!-- /form-group -->
                                        </div><!-- /.tab-pane -->
                                        <div class="tab-pane" id="wizard4">
                                            <h3 class="lead">Halftime HTO/HTU</h3>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="hto">HTO <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input class="form-control" id="hto" name="hfo" type="text" pattern="^[0-9]*\.[0-9]{2}$" required="required">
                                                </div>
                                            </div><!-- /form-group -->

                                            <div class="form-group">
                                                <label class="col-md-3 control-label" for="htu">HTU <span class="text-danger">*</span></label>
                                                <div class="col-md-5">
                                                    <input class="form-control" id="htu" name="hfu" type="text" pattern="^[0-9]*\.[0-9]{2}$" required="required">
                                                </div>
                                            </div><!-- /form-group -->
                                        </div><!-- /.tab-pane -->

                                        <div class="wizard-actions">
                                            <div class="form-group">
                                                <div class="col-md-5 col-md-offset-3">
                                                    <button type="button" class="btn btn-silc wizard-prev"><i class="fa fa-arrow-circle-o-left"></i> Back</button>
                                                    <button type="button" class="btn btn-primary wizard-next">Continue <i class="fa fa-arrow-circle-o-right"></i></button>
                                                    <button type="submit" class="btn btn-primary finish">Submit</button>
                                                </div><!-- /.cols -->
                                            </div><!-- /form-group -->
                                        </div><!-- /.wizard-actions -->

                                    </div><!-- /.tab-content -->
                                    </form><!-- /form -->
                                </div><!-- /#rootwizard -->
                            </div><!-- /.panel-body -->
                        </div><!-- /.panel -->
                    </div><!-- /.content -->
                </section><!--/.content-wrapper-->
            </main><!--/#wrapper-->
                
        </div>
    </div>
    <div class="col-md-4">
    </div>
       

        <!-- VENDOR -->
        <script src="/page/assets/scripts/jquery.min.js"></script>
        <script src="/page/assets/scripts/bootstrap.min.js"></script>
        <script src="/page/assets/scripts/jquery-ui.min.js"></script>
        <!-- END VENDOR -->

        
        <!-- !IMPORTANT DEPENDENCIES -->
        <script src="/page/assets/scripts/jquery.ui.touch-punch.min.js"></script>
        <script src="/page/assets/scripts/jquery.cookie.min.js"></script>
        <script src="/page/assets/scripts/screenfull.min.js"></script>
        <script src="/page/assets/scripts/jquery.autogrowtextarea.min.js"></script>
        <script src="/page/assets/scripts/jquery.nicescroll.min.js"></script>
        <script src="/page/assets/scripts/bootbox.min.js"></script>
        <script src="/page/assets/scripts/switchery.min.js"></script>
        <script src="/page/assets/scripts/toastr.min.js"></script>
        <script src="/page/assets/scripts/components-setup.min.js"></script>
        <!-- END !IMPORTANT DEPENDENCIES -->

        
        <!-- WRAPKIT -->
        <script src="/page/assets/scripts/wrapkit-utils.min.js"></script>
        <script src="/page/assets/scripts/wrapkit-layout.min.js"></script>
        <script src="/page/assets/scripts/wrapkit-header.min.js"></script>
        <script src="/page/assets/scripts/wrapkit-sidebar.min.js"></script>
        <script src="/page/assets/scripts/wrapkit-content.min.js"></script>
        <script src="/page/assets/scripts/wrapkit-footer.min.js"></script>
        <script src="/page/assets/scripts/wrapkit-panel.min.js"></script>
        <script src="/page/assets/scripts/wrapkit-setup.min.js"></script>
        <!-- END WRAPKIT -->

        
        <!-- DEPENDENCIES -->
        <script src="/page/assets/scripts/select2.min.js"></script>
        <script src="/page/assets/scripts/jquery.bootstrap.wizard.min.js"></script>
        <!-- END DEPENDENCIES -->

        
        <!-- Dummy script -->
        <script type="text/javascript" src="/page/assets/scripts/demo/form-wizard-demo.js"></script>

        <script type="text/javascript" src='/page/assets/js/plugins/slimscroll/jquery.slimscroll.min.js'></script>
        
         <script src="/page/assets/js/customer.js"></script>
        <!-- Google Analytics: change UA-48454066-1 to be your site's ID. Or remove it if you want -->
        <script>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-48454066-1');ga('send','pageview');
        </script>
        <!-- <script type="text/javascript">
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
                    url: '/page/mark/team_suggest',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);
                  
                    $("#team_name").autocomplete({
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

                var srvRqst = $.ajax({
                    url: '/page/mark/gg_name',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);
                   
                    $("#ng").autocomplete({
                        source: dataSource
                    });
                }); 

                 var srvRqst = $.ajax({
                    url: '/page/mark/over_name',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);
                   
                    $("#under").autocomplete({
                        source: dataSource
                    });
                }); 

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
        </script> -->
    </body>
</html>