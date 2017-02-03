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
        <a href="#" id="timeClock" class="btn btn-default"></a>
        <span style="margin-left: 5%"></span>
        <div style="padding-bottom: 1%"></div>
        <a href="/page/mark/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>
        <span style="margin-left: 5%"></span>        
        <button class="btn btn-default" id="briefhome"><i class="fa fa-briefcase"></i> Brief Home</button>
        <span style="margin-left: 5%"></span>
        <button class="btn btn-info" id="briefdraw"><i class="fa fa-book"></i> Brief Draw</button>
        <span style="margin-left: 5%"></span>
        <button class="btn btn-primary" id="briefaway"><i class="fa fa-bookmark"></i> Brief Away</button>
        <span style="margin-left: 5%"></span>
        <button class="btn btn-primary" id="highest"><i class="fa fa-bar-chart-o"></i> Highest Rep</button>
        <div style="padding-bottom: 1%"></div>
        <div class="row">

            <div class="col-lg-12 summary_details">
                <div class="col-lg-6 trend1">
                    <?php echo "<img alt='image' src='/page/assets/img/ajax-loader.gif'>"; ?>
                </div>
                <div class="col-lg-6 trend2">
                    <?php echo "<img alt='image' src='/page/assets/img/ajax-loader.gif'>"; ?>
                </div>

            </div>
            <div class="summary_default">
                <div class="col-lg-4" id="home_graph">
                    <div class="home_table">
                        <table class="table table-hover table-condensed" id='resultsTables'>
                            <thead>
                                <tr>
                                    <th>Home</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>   
                                <?php
                                foreach ($count_home as $key => $value) {
                                    echo "<tr>";
                                    echo "<td>" . $key . "</td>" . "<td>" . $value . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="home_frequency">
                        <canvas id="home_frequency" height="300px"></canvas>
                    </div>
                </div>
                <div class="col-lg-4" id="draw_graph">
                    <div class="draw_table">
                        <table class="table table-hover table-condensed" id='resultsTables2'>
                            <thead>
                                <tr>
                                    <th>Draw</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>   
                                <?php
                                foreach ($count_draw as $key => $value) {
                                    echo "<tr>";
                                    echo "<td>" . $key . "</td>" . "<td>" . $value . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="draw_frequency">
                        <canvas id="draw_frequency" height="300px"></canvas>
                    </div>
                </div>

                <div class="col-lg-4" id="away_graph">
                    <div class="away_table">
                        <table class="table table-hover table-condensed" id='resultsTables3'>
                            <thead>
                                <tr>
                                    <th>Away</th>
                                    <th>Count</th>
                                </tr>
                            </thead>
                            <tbody>   
                                <?php
                                foreach ($count_away as $key => $value) {
                                    echo "<tr>";
                                    echo "<td>" . $key . "</td>" . "<td>" . $value . "</td>";
                                    echo "</tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="away_frequency">
                        <canvas id="away_frequency" height="300px"></canvas>
                    </div>
                </div>
                <div class="col-lg-4" id="results_table">
                    
                </div>
                <div class="col-lg-4" id="results_count1">
                    
                </div>
                <div class="col-lg-4" id="results_count2">
                    
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
    <script src="/page/assets/js/customer.js"></script>
    <script type="text/javascript">
        $(document).ready(function () {
            $('#resultsTables').DataTable();
            $('#resultsTables2').DataTable();
            $('#resultsTables3').DataTable();
            $(".summary_details").hide();
            $(".home_frequency").hide();
            $(".draw_frequency").hide();
            $(".away_frequency").hide();
        });
        $("#briefhome").click(function () {
            $(".summary_default").hide();
            $(".summary_details").show();
            var srvRqst = $.ajax({
                url: '/page/mark/trend',
                data: {},
                type: 'post'
            });

            srvRqst.done(function (response) {
                $('div.trend1').html(response);
            });

            var serverRqst = $.ajax({
                url: '/page/mark/trend2',
                data: {},
                type: 'post'
            });

            serverRqst.done(function (response) {
                $('div.trend2').html(response);
            });
        });

        $("#briefdraw").click(function () {
            $(".summary_default").hide();
            $(".summary_details").show();
            var srvRqst = $.ajax({
                url: '/page/mark/trend_draw',
                data: {},
                type: 'post'
            });

            srvRqst.done(function (response) {
                $('div.trend1').html(response);
            });

            var serverRqst = $.ajax({
                url: '/page/mark/trend_draw2',
                data: {},
                type: 'post'
            });

            serverRqst.done(function (response) {
                $('div.trend2').html(response);
            });
        });

        $("#briefaway").click(function () {
            $(".summary_default").hide();
            $(".summary_details").show();
            var srvRqst = $.ajax({
                url: '/page/mark/trend_away',
                data: {},
                type: 'post'
            });

            srvRqst.done(function (response) {
                $('div.trend1').html(response);
            });

            var serverRqst = $.ajax({
                url: '/page/mark/trend_away_2',
                data: {},
                type: 'post'
            });

            serverRqst.done(function (response) {
                $('div.trend2').html(response);
            });
        });
        $("#highest").click(function () {
            $(".summary_details").hide();
            $(".home_frequency").show();
            $(".draw_frequency").show();
            $(".away_frequency").show();
            $(".home_table").hide();
            var srvRqst = $.ajax({
                url: '/page/mark/count_values',
                data: {},
                type: 'post'
            });
            
            srvRqst.done(function(response){
                $('div#results_table').html(response);
            });
        });

        $("#highest").click(function () {
            $(".summary_details").hide();
            $(".home_frequency").show();
            $(".draw_frequency").show();
            $(".away_frequency").show();
            $(".home_table").hide();
            var srvRqst = $.ajax({
                url: '/page/mark/count_score',
                data: {},
                type: 'post'
            });
            
            srvRqst.done(function(response){
                $('div#results_count1').html(response);
            });
        });
        $("#highest").click(function () {
            $(".summary_details").hide();
            $(".home_frequency").show();
            $(".draw_frequency").show();
            $(".away_frequency").show();
            $(".home_table").hide();
            var srvRqst = $.ajax({
                url: '/page/mark/count_score2',
                data: {},
                type: 'post'
            });
            
            srvRqst.done(function(response){
                $('div#results_count2').html(response);
            });
        });

        
        $("#highest").click(function () {
            $(".summary_details").hide();
            $(".home_frequency").show();
            $(".draw_frequency").show();
            $(".away_frequency").show();
            $(".home_table").hide();
            var srvRqst = $.ajax({
                url: '/page/mark/graphical_home',
                data: {},
                type: 'post'
            });

            srvRqst.done(function (responses) {
                var responseObj = $.parseJSON(responses);
                var disease_lables = Object.keys(responseObj);
                var disease_values = Object.keys(responseObj).map(function (k) {
                    return responseObj[k];
                });
                var barData = {
                    labels: disease_lables,
                    datasets: [
                        {
                            label: "Number of Times",
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1,
                            data: disease_values
                        }
                    ]
                };

                var barOption = {
                    title: {
                        display: true,
                        text: "Home Odderation"
                    },
                    scales: {
                        yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Apperance Frequency'
                                },
                                ticks: {
                                    suggestedMin: 0
                                },

                                gridLines: {
                                    display: false
                                }
                            }],
                        xAxes: [{
                                barPercentage: 1,
                                gridLines: {
                                    display: false
                                }
                            }]
                    }
                };
                var ctx = document.getElementById("home_frequency").getContext("2d");


                var myBarChat = new Chart(ctx, {
                    type: 'bar',
                    data: barData,
                    options: barOption
                });
            });
        });

        $("#highest").click(function () {
            $(".summary_details").hide();
            $(".home_frequency").show();
            $(".draw_frequency").show();
            $(".away_frequency").show();
            $(".draw_table").hide();
            var srvRqst = $.ajax({
                url: '/page/mark/graphical_draw',
                data: {},
                type: 'post'
            });
            srvRqst.done(function (responses) {
                var responseObj = $.parseJSON(responses);
                var disease_lables = Object.keys(responseObj);
                var disease_values = Object.keys(responseObj).map(function (k) {
                    return responseObj[k];
                });
                var barData = {
                    labels: disease_lables,
                    datasets: [
                        {
                            label: "Number of Times",
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1,
                            data: disease_values
                        }
                    ]
                };

                var barOption = {
                    title: {
                        display: true,
                        text: "Draw Odderation"
                    },
                    scales: {
                        yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Apperance Frequency'
                                },
                                ticks: {
                                    suggestedMin: 0
                                },

                                gridLines: {
                                    display: false
                                }
                            }],
                        xAxes: [{
                                barPercentage: 1,
                                gridLines: {
                                    display: false
                                }
                            }]
                    }
                };
                var ctx = document.getElementById("draw_frequency").getContext("2d");


                var myBarChat = new Chart(ctx, {
                    type: 'bar',
                    data: barData,
                    options: barOption
                });
            });
        });

        $("#highest").click(function () {
            $(".summary_details").hide();
            $(".away_table").hide();
            $(".home_frequency").show();
            $(".draw_frequency").show();
            $(".away_frequency").show();
            $(".away_table").hide();
            var srvRqst = $.ajax({
                url: '/page/mark/graphical_away',
                data: {},
                type: 'post'
            });
            srvRqst.done(function (responses) {
                var responseObj = $.parseJSON(responses);
                var disease_lables = Object.keys(responseObj);
                var disease_values = Object.keys(responseObj).map(function (k) {
                    return responseObj[k];
                });
                var barData = {
                    labels: disease_lables,
                    datasets: [
                        {
                            label: "Number of Times",
                            backgroundColor: [
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)',
                                'rgba(255, 99, 132, 0.2)',
                                'rgba(54, 162, 235, 0.2)',
                                'rgba(255, 206, 86, 0.2)',
                                'rgba(75, 192, 192, 0.2)',
                                'rgba(153, 102, 255, 0.2)',
                                'rgba(255, 159, 64, 0.2)'
                            ],
                            borderColor: [
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)',
                                'rgba(255,99,132,1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1,
                            data: disease_values
                        }
                    ]
                };

                var barOption = {
                    title: {
                        display: true,
                        text: "Away Odderation"
                    },
                    scales: {
                        yAxes: [{
                                scaleLabel: {
                                    display: true,
                                    labelString: 'Apperance Frequency'
                                },
                                ticks: {
                                    suggestedMin: 0
                                },

                                gridLines: {
                                    display: false
                                }
                            }],
                        xAxes: [{
                                barPercentage: 1,
                                gridLines: {
                                    display: false
                                }
                            }]
                    }
                };
                var ctx = document.getElementById("away_frequency").getContext("2d");


                var myBarChat = new Chart(ctx, {
                    type: 'bar',
                    data: barData,
                    options: barOption
                });
            });

//            var serverRqst = $.ajax({
//                url: '/page/mark/trend_away_2',
//                data: {},
//                type: 'post'
//            });
//
//            serverRqst.done(function (response) {
//                $('div.trend2').html(response);
//            });
        });
    </script>
</body>
</html>