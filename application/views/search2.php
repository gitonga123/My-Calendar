<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type = "text/css" href="/page/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/page/assets/css/jquery-ui.min.css"></link>
        <link rel="stylesheet" href="/page/assets/css/jquery-ui.theme.min.css"></link> 
        <link rel="stylesheet" type="text/css" href="/page/assets/font-awesome/css/font-awesome.css"></link>
        <link rel="stylesheet" type="text/css" href="/page/assets/css/mystyle.css"></link>
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
            <a href="/page/make" class="btn btn-info"><i class="fa fa-home"></i> Home </a>
            <span style="margin-left: 5%"></span>
            <a href="/page/make/add_result" class="btn btn-danger"><i class="fa fa-fast-forward"></i> Add / Ongeza</a>
            <span style="margin-left: 5%"></span>
            <a href="/page/make/test_area" class="btn btn-info"><i class="fa fa-google"></i> Search</a>
            <span style="margin-left: 5%"></span>
            <a href="/page/make/update_result" class="btn btn-success"><i class="fa fa-database"> </i> Update Result</a>

            <span style="margin-left: 5%"></span>
            <a href="/page/make/summary" class="btn btn-info"><i class="fa fa-line-chart"> </i> Summary</a>

            <span style="margin-left: 5%"></span>
            <a href="/page/make/exact_search" class="btn btn-warning"><i class="fa fa-search"> </i> Exact Search</a>
            <span style="margin-left: 5%"></span>

            <a href="#" class="btn btn-default" id="testing"><i class="fa fa-terminal"> </i> Testing</a>
            <span style="margin-left: 5%"></span>
            <div style="padding-bottom: 2%"></div>
            <a href="#" id="timeClock" class="btn btn-default"></a>
            <span style="margin-left: 5%"></span>
            <a href="/page/make/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>

            <span style="margin-left: 5%"></span>
            <a href="#" class="btn btn-success" id="update_teams"><i class="fa fa-search"></i> Mass Search</a>

            <span style="margin-left: 5%"></span>
            <a href="#" class="btn btn-danger" id="team_search"><i class="fa fa-search"></i> Team Search</a>
            <div style="padding-bottom: 2%"></div>
            <div class="search_form_result">
                <div class="row">
                    <div class="col-lg-6">
                        <form class="form-horizontal" method="post" action="#" id="submitResults">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="team">
                                        Search
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="search" id="search" class="form-control" required = "required" />
                                    </div>
                                </div>   
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" class="btn btn-warning col-sm-6" id="send">
                                        <i class="fa fa-search"></i>    Search points</button>
                                </div>
                            </div>

                        </form>
                    </div>
                    <div class="col-lg-6">
                        <form class="form-horizontal" method="#" action="#" id="submitTeamName">
                            <div class="form-group">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="team">
                                        Search
                                    </label>
                                    <div class="col-sm-6">
                                        <input type="text" name="team_name" id="search_team" class="form-control" required = "required" />
                                    </div>
                                </div>   
                            </div>

                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-6">
                                    <button type="submit" class="btn btn-success col-sm-6" id="send_team">
                                        <i class="fa fa-search"></i>    Search Team</button>
                                </div>
                            </div>

                        </form>
                    </div> 
                </div>
            </div>
            <div class="resultsearch">
                <div class="rows">
                    <div class="col-lg-12">
                        <div class="search_result">

                        </div>
                    </div>
                    <div class="col-lg-12">
                        <?php if (!empty($testing_data)) { ?>
                            <table class="table table-hover table-bordered table-condensed">
                                <thead>
                                    <tr>
                                        <th>Home</th>
                                        <th>Draw</th>
                                        <th>Away</th>
                                        <th>Half</th>
                                        <th>Full</th>
                                        <th>Results</th>
                                        <th>Others</th>
                                        <th>Submit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($testing_data as $key => $value) {
                                        if (empty($value->result_ht) or empty($value->result_ft) or empty($value->results)) {
                                            echo "<tr><td>" . $value->home . "</td>";
                                            echo "<td>" . $value->draw . "</td>";
                                            echo "<td>" . $value->away . "</td>";
                                            echo "<td>" . "<input  type='text' id='half_test' class='form-control' value='" . $value->result_ht . "'>" . "</td>";
                                            echo "<td>" . "<input type='text' id='full_test' class='form-control' value='" . $value->result_ft . "'>" . "</td>";
                                            echo "<td>" . "<input type='text' id='result_test' class='form-control' value='" . $value->results . "'>" . "</td>";
                                            echo "<td>" . "<input type='text' id='others' class='form-control' value='" . $value->others . "'>" . "</td>";
                                            echo "<td>" . "<input type='button' id='update_test' class='btn btn-primary' value='submit'>" . "</td>";
                                            echo "<td style='display:none;'>" . "<input type='text' id='teamid' value='" . $value->id . "' />" . "</td>";
                                            echo "</td>";
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        <?php } ?>
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
        <script src="/page/assets/js/customer.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                var srvRqst = $.ajax({
                    url: '/page/make/google',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);

                    $("#search").autocomplete({
                        source: dataSource
                    });
                });

                $('form#submitResults').on('submit', function (form) {
                    form.preventDefault();
                    $.post('/page/make/search_areas', $('form#submitResults').serialize(), function (data) {
                        $('div.search_result').html(data);
                    });
                });
            });

            $(document).ready(function () {
                var srvRqst = $.ajax({
                    url: '/page/make/team_suggest',
                    data: {},
                    type: 'post',
                    datatype: 'json'
                }
                );
                srvRqst.done(function (response) {
                    var dataSource = $.parseJSON(response);

                    $("#search_team").autocomplete({
                        source: dataSource
                    });
                });

            })

            $("#update_test").click(function () {

                var id = $("#teamid").val();
                var halftime = $("#half_test").val();
                var fulltime = $("#full_test").val();
                var result = $("#result_test").val();
                var others = $("#others").val();
                var srvRqst = $.ajax({
                    url: '/page/make/test_update',
                    type: 'post',
                    data: {halftime: halftime, fulltime: fulltime, results: result, id: id, others: others},
                    datatype: 'text',

                });

                srvRqst.done(function (response) {
                    //$('div.search_result').html(response);
                    location.reload();
                });
            });
            $("#testing").click(function () {
                var servRqst = $.ajax({
                    url: '/page/make/test',
                    type: 'post',
                    data: {},
                    datatype: 'text'
                });

                servRqst.done(function (response) {
                    $('div.search_result').html(response);
                });
            });

            $("#update_teams").click(function () {
                var serverRqst = $.ajax({
                    url: '/page/make/get_prediction',
                    data: {},
                    type: 'post'
                });

                serverRqst.done(function (response) {
                    $('div.search_result').html(response);
                });
            });

            $("#send_team").click(function () {
                $('form#submitTeamName').on('submit', function (form) {
                    form.preventDefault();
                    $.post('/page/make/team_search', $('form#submitTeamName').serialize(), function (data) {
                        $('div.search_result').html(data);
                    });
                });
            });

        </script>
    </body>
</html>
