<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- VENDOR -->
        <link rel="stylesheet" href="/page/assets/styles/jqueryui.min.css">
        <link rel="stylesheet" href="/page/assets/styles/bootstrap.min.css">
        <link rel="stylesheet" href="/page/assets/css/jquery-ui.min.css"></link>
        <link rel="stylesheet" href="/page/assets/css/jquery-ui.theme.min.css"></link> 
        <!-- <link href="http://getbootstrap.com/examples/carousel/carousel.css" rel="stylesheet"> -->
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
        <style>
            .carousel-control.left, .carousel-control.right {
                background-image: none
            }
            /*.carousel-control {
                                position: absolute;
                                top: 50%;  pushes the icon in the middle of the height 
                                z-index: 5;
                                display: inline-block;
                                }*/

            .slide-prev {
                position: fixed;
                top: -15%;
                margin-left: -3.5%;
            }

            .slide-next {
                position: fixed;
                top: -15%;
                margin-right: -3.5%;
            }
        </style>
    </head>

    <body>

        <div class="container-fluid">   
            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                <h2>Carousel Example</h2>
                <div class="container">

                    <!-- Indicators -->
                    <ol class="carousel-indicators">
                        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                        <li data-target="#myCarousel" data-slide-to="1"></li>
                        <li data-target="#myCarousel" data-slide-to="2"></li>
                    </ol>

                    <!-- Wrapper for slides -->
                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="row">
                                <div class="col-md-4">
                                    <img class="img img-rounded img-responsive" src="/page/assets/img/mombasa.png" alt="Odoo - Sample 1 for three columns"/>
                                    <h3 class="mt16" style="font-family:Andale Mono, Arial; font-weight: bold;">Mombasa eConstruction Permit System</h3>
                                    <p style="font-family:Courier New Bold; font-size:18px;">
                                        Adapt these three columns to fit you design need.
                                        To duplicate, delete or move columns, select the
                                        column and use the top icons to perform your action.
                                    </p>
                                    <p><a class="btn btn-primary pull-left" href="https://econstruction.mombasa.go.ke/" role="button">View details <!-- &raquo; --></a></p>
                                    <p><a class="btn btn-warning pull-right" href="#" role="button">Report Issues <!-- &raquo; --></a></p>

                                </div>
                                <div class="col-md-4">
                                    <img class="img img-rounded img-responsive" src="/page/assets/img/nairobi.png" alt="Odoo - Sample 2 for three columns"/>
                                    <h3 class="mt16" style="font-family:Andale Mono, Arial; font-weight: bold;">Nairobi eDevelopment Permit System</h3>
                                    <p style="font-family:New Century Schoolbook, serif; font-size:18px;">
                                        Adapt these three columns to fit you design need.
                                        To duplicate, delete or move columns, select the
                                        column and use the top icons to perform your action.
                                    </p>
                                    <p><a class="btn btn-primary pull-left" href="http://www.ccn-ecp.or.ke/" role="button">View details <!-- &raquo; --></a></p>
                                    <p><a class="btn btn-success pull-right" href="#" role="button">Report Issues <!-- &raquo; --></a></p>

                                </div>
                                <div class="col-md-4">
                                    <!-- <img class="img img-rounded img-responsive" src="/website/static/src/img/china_thumb.jpg" alt="Odoo - Sample 3 for three columns"/> -->
                                    <img src="/page/assets/img/kiambu.png" class="img img-rounded img-responsive "  />
                                    <h3 class="mt16" style="font-family:Andale Mono, Arial; font-weight: bold;">Kiambu Construction Permit (e-Dams)</h3>
                                    <p style="font-family:New Century Schoolbook, serif; font-size:18px;">
                                        Delete the above image or replace it with a picture
                                        that illustrates your message. Click on the picture to
                                        change it's <em>rounded corner</em> style to perform your action.
                                    </p>
                                    <p><a class="btn btn-primary pull-left" href="https://edams.kiambu.go.ke/" role="button">View details <!-- &raquo; --></a></p>
                                    <p><a class="btn btn-danger pull-right" href="#" role="button">Report Issues <!-- &raquo; --></a></p>	
                                </div>
                            </div>
                        </div>
                        <div class="item">
                            <div class="row">
                                <div class="col-md-4">
                                    <!-- <img class="img img-rounded img-responsive" src="/website/static/src/img/china_thumb.jpg" alt="Odoo - Sample 3 for three columns"/> -->
                                    <img src="/otb_projects/static/img/rwanda.png" class="img img-rounded img-responsive "/>
                                    <h3 class="mt16" style="font-family:Andale Mono, Arial; font-weight: bold;">Kisumu Construction Permit</h3>
                                    <p style="font-family:New Century Schoolbook, serif; font-size:18px;">
                                        Delete the above image or replace it with a picture
                                        that illustrates your message. Click on the picture to
                                        change it's <em>rounded corner</em> style to perfom
                                    </p>
                                    <p><a class="btn btn-info pull-left" href="https://edams.kiambu.go.ke/" role="button">View details <!-- &raquo; --></a></p>
                                    <p><a class="btn btn-primary pull-right" href="#" role="button">Report Issues <!-- &raquo; --></a></p>

                                </div>

                                <div class="col-md-4">
                                    <!-- <img class="img img-rounded img-responsive" src="/website/static/src/img/china_thumb.jpg" alt="Odoo - Sample 3 for three columns"/> -->
                                    <img src="/otb_projects/static/img/kisumu.png" class="img img-rounded img-responsive "  />
                                    <h3 class="mt16" style="font-family:Andale Mono, Arial; font-weight: bold;">Kisumu Construction Permit</h3>
                                    <p style="font-family:New Century Schoolbook, serif; font-size:18px;">
                                        Delete the above image or replace it with a picture
                                        that illustrates your message. Click on the picture to
                                        change it's <em>rounded corner</em> style to perfom
                                    </p>
                                    <p><a class="btn btn-info pull-left" href="https://edams.kiambu.go.ke/" role="button">View details <!-- &raquo; --></a></p>
                                    <p><a class="btn btn-danger pull-right" href="#" role="button">Report Issues <!-- &raquo; --></a></p>

                                </div>
                                <!-- /otb_projects/static/img/ -->
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Left and right controls -->
                <a class="left carousel-control slide-prev" href="#myCarousel" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control slide-next" href="#myCarousel" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right"></span>
                    <span class="sr-only">Next</span>
                </a>

            </div>
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
            (function (b, o, i, l, e, r) {
                b.GoogleAnalyticsObject = l;
                b[l] || (b[l] =
                        function () {
                            (b[l].q = b[l].q || []).push(arguments)
                        });
                b[l].l = +new Date;
                e = o.createElement(i);
                r = o.getElementsByTagName(i)[0];
                e.src = '//www.google-analytics.com/analytics.js';
                r.parentNode.insertBefore(e, r)
            }(window, document, 'script', 'ga'));
            ga('create', 'UA-48454066-1');
            ga('send', 'pageview');
        </script>
    </body>
</html>