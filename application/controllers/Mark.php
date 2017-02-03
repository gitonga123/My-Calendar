<?php

defined('BASEPATH') or exit("No direct Script is Allowed");

class Mark extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("marks");
        $this->load->helper("url");
        $this->load->library("pagination");
        $this->load->helper("form");
        $this->load->library("form_validation");
    }

    public function index() {
        $data['title'] = "Entry Results";
        $data['odds'] = $this->marks->get_all_details();
        $data['count'] = count($this->marks->get_all_details());
        $this->load->view('mark', $data);
    }

    public function transafer() {
        $data = $this->marks->get_details_for_uploads();
        $query = json_decode(json_encode($data), TRUE);
        foreach ($query as $key => $value) {
            if (!empty($value['team_name'])) {
                $datas = array(
                    "team_name" => $value['team_name'],
                    "home" => $value['home'],
                    "away" => $value['away'],
                    "draw" => $value['draw'],
                    "result_ht" => $value['result_ht'],
                    "result_ft" => $value['result_ft'],
                    "results" => $value['results'],
                    "league" => $value['league'],
                    "times" => $value['times']
                );
                $this->marks->get_updates($datas);
            }
        }
    }

    public function add_result() {
        $data['title'] = "Add New Data";
        $data['error'] = "";

        if (isset($_POST['team'])) {
            $datas['team_name'] = $this->input->post('team');
            $datas['home'] = $this->input->post('home');
            $datas['away'] = $this->input->post('away');
            $datas['draw'] = $this->input->post('draw');
            $datas['result_ht'] = $this->input->post('halftime');
            $datas['result_ft'] = $this->input->post('fulltime');
            $datas['results'] = $this->input->post('results');
            $datas['league'] = $this->input->post('league');
            $datas['times'] = $this->get_time();
            $this->marks->get_updates($datas);

            // $this->testing_area();
            // if($query){
            //     $this->index();
            // }
        }
        $this->load->view('insert', $data);
    }

    public function team_suggest() {
        $team_search = $this->marks->team_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->team_name;
        }
        echo json_encode($hold);
    }

    public function home_suggest() {
        $team_search = $this->marks->home_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->home;
        }
        echo json_encode($hold);
    }

    public function draw_suggest() {
        $team_search = $this->marks->draw_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->draw;
        }
        echo json_encode($hold);
    }

    public function away_suggest() {
        $team_search = $this->marks->away_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->away;
        }
        echo json_encode($hold);
    }

    public function half_suggest() {
        $team_search = $this->marks->half_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->result_ht;
        }
        echo json_encode($hold);
    }

    public function full_suggest() {
        $team_search = $this->marks->full_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->result_ft;
        }
        echo json_encode($hold);
    }

    public function result_suggest() {
        $team_search = $this->marks->result_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->results;
        }
        echo json_encode($hold);
    }

    public function league_suggest() {
        $team_search = $this->marks->league_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->league;
        }
        echo json_encode($hold);
    }

    public function search_area() {
        $data['title'] = 'Search Area';
        $data['testing_data'] = $this->marks->select_test();
        $this->load->view('search', $data);
    }

    public function google() {

        $team_draw = $this->marks->draw_name();
        $team_home = $this->marks->home_name();
        $team_away = $this->marks->away_name();
        $hold = array();
        foreach ($team_draw as $key => $value) {
            $hold[] = $value->draw;
        }

        foreach ($team_home as $key => $value) {
            $hold[] = $value->home;
        }

        foreach ($team_away as $key => $value) {
            $hold[] = $value->away;
        }

        echo json_encode($hold);
    }

    public function search_areas() {
        $search = $this->input->post('search');
        $home_search = $this->marks->search_home($search);

        $draw_search = $this->marks->search_draw($search);

        $away_search = $this->marks->search_away($search);

        $result = count($home_search);
        $result2 = count($draw_search);
        $result3 = count($away_search);

        //echo $result . " " . $result2 . " " . $result3. "<br />";
        echo "<table class='table table-bordered table-hover' id='resultsTables'>
            <thead>
                <tr>
                    <th>Home</th>
                    <th>Draw</th>
                    <th>Away</th>
                    <th>Half Time</th>
                    <th>Full Time</th>
                    <th>Result</th>
                    <th>League</th>
                </tr>
            </thead>
        <tbody>";
        if ($result > $result2 && $result > $result3) {
            echo "<div class='alert alert-info'>{$result} Result(s) Found</div>";
            foreach ($home_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } elseif ($result2 > $result && $result2 > $result3) {
            echo "<div class='alert alert-info'>{$result2} Result(s) Found</div>";
            foreach ($draw_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } elseif ($result3 > $result && $result3 > $result2) {
            echo "<div class='alert alert-info'>{$result3} Result(s) Found</div>";
            foreach ($away_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } elseif ($result3 == $result2 && $result3 == $result) {
            $results1 = $result + $result2 + $result3;
            echo "<div class='alert alert-info'>{$results1} Result(s) Found</div>";
            foreach ($home_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }


            foreach ($draw_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }


            foreach ($away_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } elseif ($result == $result3 && $result == $result2) {
            $results2 = $result + $result2 + $result3;
            echo "<div class='alert alert-info'>{$results2} Result(s) Found</div>";
            foreach ($home_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }


            foreach ($draw_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }


            foreach ($away_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        } elseif ($result == $result3 && $result > $result2) {
            $results3 = $result + $result3;
            echo "<div class='alert alert-info'>{$results3} Result(s) Found</div>";
            foreach ($home_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }

            foreach ($away_search as $key => $value) {

                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr></";
            }
            echo "</tbody></table>";
        } elseif ($result == $result3 && $result2 > $result) {
            $results4 = $result + $result2;
            echo "<div class='alert alert-info'>{$results4} Result(s) Found</div>";
            foreach ($home_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }


            foreach ($draw_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }

            echo "</tbody></table>";
        } else {
            $results5 = $result + $result2 + $result3;
            echo "<div class='alert alert-info'>{$results5} Result(s) Found</div>";
            foreach ($home_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }


            foreach ($draw_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }


            foreach ($away_search as $key => $value) {
                echo "<tr><td>";
                echo $value->home . "</td><td>" . $value->draw;
                echo "</td><td>" . $value->away . "</td><td>";
                echo $value->result_ht . "</td><td>" . $value->result_ft . "</td><td>";
                echo $value->results . "</td><td>" . $value->league . "</td>";
                echo "</tr>";
            }
            echo "</tbody></table>";
        }

        echo "<script>
           $(document).ready(function(){
                $('#resultsTables').DataTable();
           });
           </script>";
    }

    public function update_result() {
        $data['title'] = "Update Results";
        $odds = $this->marks->get_all_details();
        $hold = array();
        foreach ($odds as $key => $value) {
            if (empty($value->result_ft)) {
                if (empty($value->results)) {

                    $hold[] = array(
                        'id' => $value->id,
                        'team_name' => $value->team_name,
                        'home' => $value->home,
                        'draw' => $value->draw,
                        'away' => $value->away,
                        'halftime' => $value->result_ht,
                        'fulltime' => $value->result_ft,
                        'results' => $value->results,
                        'league' => $value->league,
                        'times' => $value->times
                    );
                }
            }
        }


        $data['hold'] = $hold;
        $this->load->view('update', $data);
    }

    public function result_update() {
        $data = $this->input->post('id');
        $data1['result_ht'] = $this->input->post('halftime');
        $data2['result_ft'] = $this->input->post('fulltime');
        $data3['results'] = $this->input->post('results');
        $results1 = $this->marks->update_result($data, $data1);
        if ($results1) {
            $results2 = $this->marks->update_result($data, $data2);
            if ($results2) {
                $results3 = $this->marks->update_result($data, $data3);
                if ($results3) {
                    echo $results3;
                }
            }
        }
    }

    public function lock() {
        $data['title'] = "Lock Screen";
        $data['error_message'] = "";

        $this->load->view('screen', $data);
    }

    public function login() {
        $password = $this->input->post('password');
        if ($password == 'daniel123') {
            $this->index();
        } else {
            $data['title'] = "Lock Screen";
            $data['error_message'] = "<p class='alert alert-danger'>Password Mis-smatch</p>";
            $this->load->view('screen', $data);
        }
    }

    public function get_time() {
        $date = date("Y-m-d H:i:s");

        $endtime = strtotime('+120 minutes', strtotime($date));

        $mess = date('h:i:s', $endtime);

        return $mess;
    }

    public function summary() {
        $datas = $this->marks->get_all_details();

        $data['title'] = "Summary";


        foreach ($datas as $key => $value) {
            $temp_home[] = $value->home;
            $temp_draw[] = $value->draw;
            $temp_away[] = $value->away;
        }
        $count_home = array_count_values($temp_home);
        $count_draw = array_count_values($temp_draw);
        $count_away = array_count_values($temp_away);
        $data['count_home'] = $count_home;
        $data['count_draw'] = $count_draw;
        $data['count_away'] = $count_away;

        $this->load->view('summary', $data);
    }

    public function graphical_home() {
        $home = array();
        $datas = $this->marks->get_all_details();
        foreach ($datas as $key => $value) {
            $temp_home[] = $value->home;
        }
        $count_home = array_count_values($temp_home);
        foreach ($count_home as $key => $value) {
            if ($value >=50) {
                $home[$key] = $value;
            }
        }
        echo json_encode($home);
    }

    public function count_values() {
        $hommy = array();
        $total = 0;
        $datas = $this->marks->get_all_details();
        $data = json_decode(json_encode($datas), true);
        foreach ($data as $key => $value) {
            $hommy[] = $value['results'];
        }
        $hommes = array_count_values($hommy);
        arsort($hommes);
        echo "<h3>Results</h3>";
        echo "<table class='table table-hover table-condensed table-bordered' id='countScore'><thead>";
        echo "<tr><th>Results</th><th>Count</th></tr><body>";
        foreach ($hommes as $key => $value) {
            echo "<tr>";
            echo "<td>{$key}</td><td>{$value}</td></tr>";
            $total = $total + $value;
        }

        echo "</tbody><tfooter><th>Total</th><th>{$total}</th></tfooter></table>";
        echo "<script>
            $('document').ready(function(){
                $('#countScore').DataTable();
            })
        </script>";
    }

    public function count_score() {
        $score = array();
        $total = 0;
        $datas = $this->marks->get_all_details();
        $data = json_decode(json_encode($datas), true);
        foreach ($data as $key => $value) {
            $score[] = $value['result_ht'];
        }
        $hommes = array_count_values($score);
        arsort($hommes);
        echo "<h3>Results Half Time</h3>";
        echo "<table class='table table-hover table-condensed table-bordered' id='count_score'><thead>";
        echo "<tr><th>Results</th><th>Count</th></tr><body>";
        foreach ($hommes as $key => $value) {
            echo "<tr>";
            echo "<td>{$key}</td><td>{$value}</td></tr>";
            $total = $total + $value;
        }

        echo "</tbody><tfooter><th>Total</th><th>{$total}</th></tfooter></table>";
        echo "<script>
            $('document').ready(function(){
                $('#count_score').DataTable();
            })
        </script>";
    }

    public function count_score2() {
        $score = array();
        $total = 0;
        $datas = $this->marks->get_all_details();
        $data = json_decode(json_encode($datas), true);

        foreach ($data as $key => $value) {
            $score[] = $value['result_ft'];
        }
        $hommes = array_count_values($score);
        arsort($hommes);
        echo "<h3>Results Full Time</h3>";
        echo "<table class='table table-hover table-condensed table-bordered' id='count_score2'><thead>";
        echo "<tr><th>Results</th><th>Count</th></tr><body>";
        foreach ($hommes as $key => $value) {
            echo "<tr>";
            echo "<td>{$key}</td><td>{$value}</td></tr>";
            $total = $total + $value;
        }

        echo "</tbody><tfooter><th>Total</th><th>{$total}</th></tfooter></table>";
        echo "<script>
            $('document').ready(function(){
                $('#count_score2').DataTable();
            })
        </script>";
    }

    public function graphical_away() {
        $away = array();
        $datas = $this->marks->get_all_details();
        foreach ($datas as $key => $value) {
            $temp_away[] = $value->away;
        }
        $count_away = array_count_values($temp_away);
        foreach ($count_away as $key => $value) {
            if ($value >= 50) {
                $away[$key] = $value;
            }
        }
        echo json_encode($away);
    }

    public function graphical_draw() {
        $draw = array();
        $datas = $this->marks->get_all_details();
        foreach ($datas as $key => $value) {

            $temp_draw[] = $value->draw;
        }

        $count_draw = array_count_values($temp_draw);
        foreach ($count_draw as $key => $value) {
            if ($value >=50) {
                $draw[$key] = $value;
            }
        }
        echo json_encode($draw);
    }

    public function exact_search() {
        $data['title'] = "Exact Search";
        $datas2 = $this->marks->get_all_details();
        $data_search = json_decode(json_encode($datas2), TRUE);
        if (isset($_POST['home'])) {
            $value_home = $this->input->post('home');
            $value_draw = $this->input->post('draw');
            $value_away = $this->input->post('away');
            if (!empty($value_home) && !empty($value_draw) && !empty($value_away)) {
                $exacts = $this->search_return($data_search, 'home', $value_home);
                $exact = $this->search_return($exacts, 'draw', $value_draw);
                $exact_search_hold = $this->search_return($exact, 'away', $value_away);
                $exact_search = array();
                $exact_hold = array();
            } elseif (!empty($value_home) && !empty($value_draw) && empty($value_away)) {
                $exactly = $this->search_return($data_search, 'home', $value_home);
                $exact_hold = $this->search_return($exactly, 'draw', $value_draw);
                $exact_search_hold = array();
                $exact_search = array();
            } elseif (!empty($value_home) && empty($value_draw) && !empty($value_away)) {
                $exactlies = $this->search_return($data_search, 'home', $value_home);
                $exact_hold = array();
                $exact_search = array();
                $exact_search_hold = $this->search_return($exactlies, 'away', $value_away);
            } else {
                $exact_search = "<p class='alert alert-info'>No such Results</p>";
                $exact_hold = "<p class='alert alert-info'>No such Results</p>";
                $exact_search_hold = "<p class='alert alert-info'>No such Results</p>";
            }
        } else {
            $exact_search = "<p class='alert alert-warning'>Results Area</p>";
            $exact_hold = "<p class='alert alert-warning'>Results Area</p>";
            $exact_search_hold = "<p class='alert alert-warning'>Results Area</p>";
        }
        $data['exact_search_hold'] = $exact_search_hold;
        $data['hold_search'] = $exact_hold;
        $data['exact_search'] = $exact_search_hold;

        $this->load->view('exact_search', $data);
    }

    //Brief Case Draw
    public function trend_draw() {
        $datas2 = $this->marks->get_all_details();
        $data_search = json_decode(json_encode($datas2), TRUE);
        foreach ($datas2 as $key => $value) {
            $temp_draw[] = $value->draw;
        }
        $temp_draw_u = array_unique($temp_draw);
        echo "<p class='alert alert-info'><i class='fa fa-briefcase'></i> Draw</p>
        <table class='table table-hover table-condensed' id='myTable'>
        <thead>
          <th>Team Name</th>
          <th>Home</th>
          <th>Draw</th>
          <th>Away</th>
          <th>halftime</th>
          <th>fulltime</th>
          <th>Judgment</th>
          
        </thead><tbody>
      ";
        foreach ($temp_draw_u as $key => $value) {
            $exacts = $this->search_return($data_search, 'draw', $value);
            if (count($exacts) > 10) {
                foreach ($exacts as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $value['team_name'] . "</td>";
                    echo "<td>" . $value['home'] . "</td>";
                    echo "<td>" . $value['draw'] . "</td>";
                    echo "<td>" . $value['away'] . "</td>";
                    echo "<td>" . $value['result_ht'] . "</td>";
                    echo "<td>" . $value['result_ft'] . "</td>";
                    echo "<td>" . $value['results'] . "</td>";

                    echo "</tr>";
                }
            }
        }

        echo "<tbody></table>";
        echo "
        <script>
          $(document).ready(function(){
            $('#myTable').DataTable();
          });
        </script>
      ";
    }

    public function trend_draw2() {
        $hold = array();
        $datas2 = $this->marks->get_all_details();
        $data_search = json_decode(json_encode($datas2), TRUE);
        foreach ($datas2 as $key => $value) {
            $temp_home[] = $value->home;
            $temp_draw[] = $value->draw;
            $temp_away[] = $value->away;
        }
        $temp_home_u = array_unique($temp_home);
        $temp_away_u = array_unique($temp_away);
        $temp_draw_u = array_unique($temp_draw);
        echo "
        <p class='alert alert-info'><i class='fa fa-briefcase'></i>Draw 2</p>
        <table class='table table-hover table-condensed' id='myTable2'>
        <thead>
          <th>Team Name</th>
          <th>Home</th>
          <th>Draw</th>
          <th>Away</th>
          <th>Half Time</th>
          <th>fulltime</th>
          <th>Judgment</th>
        </thead><tbody>
      ";
        $homes = $this->trend_draw_2_1($data_search, $temp_draw_u);
        $draws = $this->trend_draw_2_2($homes, $temp_home_u);
        $aways = $this->trend_draw_2_3($draws, $temp_away_u);
        foreach ($aways as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['team_name'] . "</td>";
            echo "<td>" . $value['home'] . "</td>";
            echo "<td>" . $value['draw'] . "</td>";
            echo "<td>" . $value['away'] . "</td>";
            echo "<td>" . $value['result_ht'] . "</td>";
            echo "<td>" . $value['result_ft'] . "</td>";
            echo "<td>" . $value['results'] . "</td>";
            echo "</tr>";
        }


        echo "<tbody></table>";
        echo "
        <script>
          $(document).ready(function(){
            $('#myTable2').DataTable();
          });
        </script>
      ";
    }

    public function trend_draw_2_1($array, $array2) {
        $hold = array();
        foreach ($array2 as $key => $value) {
            $exacts = $this->search_return($array, 'draw', $value);
            if (count($exacts) >= 10) {
                foreach ($exacts as $keys => $values) {
                    $hold[] = array(
                        "team_name" => $values['team_name'],
                        "home" => $values['home'],
                        "draw" => $values['draw'],
                        "away" => $values['away'],
                        "result_ht" => $values['result_ht'],
                        "result_ft" => $values['result_ft'],
                        "results" => $values['results'],
                        "league" => $values['league']
                    );
                }
            }
        }
        return $hold;
    }

    public function trend_draw_2_2($array, $array2) {
        $hold = array();
        foreach ($array2 as $key => $value) {
            $exacts = $this->search_return($array, 'home', $value);
            if (count($exacts) >= 10) {
                foreach ($exacts as $keys => $values) {
                    $hold[] = array(
                        "team_name" => $values['team_name'],
                        "home" => $values['home'],
                        "draw" => $values['draw'],
                        "away" => $values['away'],
                        "result_ht" => $values['result_ht'],
                        "result_ft" => $values['result_ft'],
                        "results" => $values['results'],
                        "league" => $values['league']
                    );
                }
            }
        }
        return $hold;
    }

    public function trend_draw_2_3($array, $array2) {
        $hold = array();
        foreach ($array2 as $key => $value) {
            $exacts = $this->search_return($array, 'away', $value);
            if (count($exacts) >= 10) {
                foreach ($exacts as $keys => $values) {
                    $hold[] = array(
                        "team_name" => $values['team_name'],
                        "home" => $values['home'],
                        "draw" => $values['draw'],
                        "away" => $values['away'],
                        "result_ht" => $values['result_ht'],
                        "result_ft" => $values['result_ft'],
                        "results" => $values['results'],
                        "league" => $values['league']
                    );
                }
            }
        }
        return $hold;
    }

//Brief Case Away
    public function trend_away() {
        $datas2 = $this->marks->get_all_details();
        $data_search = json_decode(json_encode($datas2), TRUE);
        foreach ($datas2 as $key => $value) {
            $temp_away[] = $value->away;
        }
        $temp_away_u = array_unique($temp_away);
        echo "<p class='alert alert-info'><i class='fa fa-briefcase'></i>Away</p>
        <table class='table table-hover table-condensed' id='myTable'>
        <thead>
          <th>Team</th>
          <th>Home</th>
          <th>Draw</th>
          <th>Away</th>
          <th>halftime</th>
          <th>fulltime</th>
          <th>Judgment</th>
          
        </thead><tbody>
      ";
        foreach ($temp_away_u as $key => $value) {
            $exacts = $this->search_return($data_search, 'away', $value);
            if (count($exacts) > 10) {
                foreach ($exacts as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $value['team_name'] . "</td>";
                    echo "<td>" . $value['home'] . "</td>";
                    echo "<td>" . $value['draw'] . "</td>";
                    echo "<td>" . $value['away'] . "</td>";
                    echo "<td>" . $value['result_ht'] . "</td>";
                    echo "<td>" . $value['result_ft'] . "</td>";
                    echo "<td>" . $value['results'] . "</td>";

                    echo "</tr>";
                }
            }
        }

        echo "<tbody></table>";
        echo "
        <script>
          $(document).ready(function(){
            $('#myTable').DataTable();
          });
        </script>
      ";
    }

    public function trend_away_2() {
        $hold = array();
        $datas2 = $this->marks->get_all_details();
        $data_search = json_decode(json_encode($datas2), TRUE);
        foreach ($datas2 as $key => $value) {
            $temp_home[] = $value->home;
            $temp_draw[] = $value->draw;
            $temp_away[] = $value->away;
        }
        $temp_home_u = array_unique($temp_home);
        $temp_away_u = array_unique($temp_away);
        $temp_draw_u = array_unique($temp_draw);
        echo "
        <p class='alert alert-info'><i class='fa fa-briefcase'></i>Away 2</p>
        <table class='table table-hover table-condensed' id='myTable2'>
        <thead>
          <th>Team Name</th>
          <th>Home</th>
          <th>Draw</th>
          <th>Away</th>
          <th>Half Time</th>
          <th>fulltime</th>
          <th>Judgment</th>
        </thead><tbody>
      ";
        $homes = $this->trend_away_2_1($data_search, $temp_away_u);
        $draws = $this->trend_away_2_2($homes, $temp_home_u);
        $aways = $this->trend_away_2_3($draws, $temp_draw_u);
        foreach ($aways as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['team_name'] . "</td>";
            echo "<td>" . $value['home'] . "</td>";
            echo "<td>" . $value['draw'] . "</td>";
            echo "<td>" . $value['away'] . "</td>";
            echo "<td>" . $value['result_ht'] . "</td>";
            echo "<td>" . $value['result_ft'] . "</td>";
            echo "<td>" . $value['results'] . "</td>";
            echo "</tr>";
        }


        echo "<tbody></table>";
        echo "
        <script>
          $(document).ready(function(){
            $('#myTable2').DataTable();
          });
        </script>
      ";
    }

    public function trend_away_2_1($array, $array2) {
        $hold = array();
        foreach ($array2 as $key => $value) {
            $exacts = $this->search_return($array, 'away', $value);
            if (count($exacts) >= 10) {
                foreach ($exacts as $keys => $values) {
                    $hold[] = array(
                        "team_name" => $values['team_name'],
                        "home" => $values['home'],
                        "draw" => $values['draw'],
                        "away" => $values['away'],
                        "result_ht" => $values['result_ht'],
                        "result_ft" => $values['result_ft'],
                        "results" => $values['results'],
                        "league" => $values['league']
                    );
                }
            }
        }
        return $hold;
    }

    public function trend_away_2_2($array, $array2) {
        $hold = array();
        foreach ($array2 as $key => $value) {
            $exacts = $this->search_return($array, 'home', $value);
            if (count($exacts) >= 10) {
                foreach ($exacts as $keys => $values) {
                    $hold[] = array(
                        "team_name" => $values['team_name'],
                        "home" => $values['home'],
                        "draw" => $values['draw'],
                        "away" => $values['away'],
                        "result_ht" => $values['result_ht'],
                        "result_ft" => $values['result_ft'],
                        "results" => $values['results'],
                        "league" => $values['league']
                    );
                }
            }
        }
        return $hold;
    }

    public function trend_away_2_3($array, $array2) {
        $hold = array();
        foreach ($array2 as $key => $value) {
            $exacts = $this->search_return($array, 'draw', $value);
            if (count($exacts) >= 10) {
                foreach ($exacts as $keys => $values) {
                    $hold[] = array(
                        "team_name" => $values['team_name'],
                        "home" => $values['home'],
                        "draw" => $values['draw'],
                        "away" => $values['away'],
                        "result_ht" => $values['result_ht'],
                        "result_ft" => $values['result_ft'],
                        "results" => $values['results'],
                        "league" => $values['league']
                    );
                }
            }
        }
        return $hold;
    }

//Brief Case Home
    public function trend() {
        $hold = array();
        $datas2 = $this->marks->get_all_details();
        $data_search = json_decode(json_encode($datas2), TRUE);
        foreach ($datas2 as $key => $value) {
            $temp_home[] = $value->home;
        }
        $temp_home_u = array_unique($temp_home);

        echo "<p class='alert alert-info'><i class='fa fa-briefcase'></i>Home</p>
        <table class='table table-hover table-condensed' id='myTable'>
        <thead>
          <th>Team Name</th>
          <th>Home</th>
          <th>Draw</th>
          <th>Away</th>
          <th>halftime</th>
          <th>fulltime</th>
          <th>Judgment</th>
          
        </thead><tbody>
      ";
        foreach ($temp_home_u as $key => $value) {
            $exacts = $this->search_return($data_search, 'home', $value);
            if (count($exacts) > 15) {
                foreach ($exacts as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $value['team_name'] . "</td>";
                    echo "<td>" . $value['home'] . "</td>";
                    echo "<td>" . $value['draw'] . "</td>";
                    echo "<td>" . $value['away'] . "</td>";
                    echo "<td>" . $value['result_ht'] . "</td>";
                    echo "<td>" . $value['result_ft'] . "</td>";
                    echo "<td>" . $value['results'] . "</td>";

                    echo "</tr>";
                }
            }
        }


        echo "<tbody></table>";
        echo "
        <script>
          $(document).ready(function(){
            $('#myTable').DataTable();
          });
        </script>
      ";
    }

    public function trend2() {
        $hold = array();
        $datas2 = $this->marks->get_all_details();
        $data_search = json_decode(json_encode($datas2), TRUE);
        foreach ($datas2 as $key => $value) {
            $temp_home[] = $value->home;
            $temp_draw[] = $value->draw;
            $temp_away[] = $value->away;
        }
        $temp_home_u = array_unique($temp_home);
        $temp_away_u = array_unique($temp_away);
        $temp_draw_u = array_unique($temp_draw);
        echo "
        <p class='alert alert-info'><i class='fa fa-briefcase'></i>Home</p>
        <table class='table table-hover table-condensed' id='myTable2'>
        <thead>
          <th>Home</th>
          <th>Home</th>
          <th>Draw</th>
          <th>Away</th>
          <th>Half Time</th>
          <th>fulltime</th>
          <th>Judgment</th>
        </thead><tbody>
      ";
        $homes = $this->trend2_1($data_search, $temp_home_u);
        $draws = $this->trend2_2($homes, $temp_draw_u);
        $aways = $this->trend2_3($draws, $temp_away_u);

        foreach ($aways as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value['team_name'] . "</td>";
            echo "<td>" . $value['home'] . "</td>";
            echo "<td>" . $value['draw'] . "</td>";
            echo "<td>" . $value['away'] . "</td>";
            echo "<td>" . $value['result_ht'] . "</td>";
            echo "<td>" . $value['result_ft'] . "</td>";
            echo "<td>" . $value['results'] . "</td>";
            echo "</tr>";
        }


        echo "<tbody></table>";
        echo "
        <script>
          $(document).ready(function(){
            $('#myTable2').DataTable();
          });
        </script>
      ";
    }

    public function trend2_1($array, $array2) {
        $hold = array();
        foreach ($array2 as $key => $value) {
            $exacts = $this->search_return($array, 'home', $value);
            if (count($exacts) >= 10) {
                foreach ($exacts as $keys => $values) {
                    $hold[] = array(
                        "team_name" => $values['team_name'],
                        "home" => $values['home'],
                        "draw" => $values['draw'],
                        "away" => $values['away'],
                        "result_ht" => $values['result_ht'],
                        "result_ft" => $values['result_ft'],
                        "results" => $values['results'],
                        "league" => $values['league']
                    );
                }
            }
        }
        return $hold;
    }

    public function trend2_2($array, $array2) {
        $hold = array();
        foreach ($array2 as $key => $value) {
            $exacts = $this->search_return($array, 'draw', $value);
            if (count($exacts) >= 10) {
                foreach ($exacts as $keys => $values) {
                    $hold[] = array(
                        "team_name" => $values['team_name'],
                        "home" => $values['home'],
                        "draw" => $values['draw'],
                        "away" => $values['away'],
                        "result_ht" => $values['result_ht'],
                        "result_ft" => $values['result_ft'],
                        "results" => $values['results'],
                        "league" => $values['league']
                    );
                }
            }
        }
        return $hold;
    }

    public function trend2_3($array, $array2) {
        $hold = array();
        foreach ($array2 as $key => $value) {
            $exacts = $this->search_return($array, 'away', $value);
            if (count($exacts) >= 10) {
                foreach ($exacts as $keys => $values) {
                    $hold[] = array(
                        "team_name" => $values['team_name'],
                        "home" => $values['home'],
                        "draw" => $values['draw'],
                        "away" => $values['away'],
                        "result_ht" => $values['result_ht'],
                        "result_ft" => $values['result_ft'],
                        "results" => $values['results'],
                        "league" => $values['league']
                    );
                }
            }
        }
        return $hold;
    }

    public function search_return($array, $key, $value) {
        $results = array();

        if (is_array($array)) {
            if (isset($array[$key]) && $array[$key] == $value) {
                $results[] = $array;
            }

            foreach ($array as $subarray) {
                $results = array_merge($results, $this->search_return($subarray, $key, $value));
            }
        }

        return $results;
    }

    public function testing_area() {

        $table = $this->marks->select_last();
        unset($table['league']);
        unset($table['times']);
        unset($table['team_name']);
        unset($table['result_ht']);
        unset($table['result_ft']);
        $query = $this->marks->insert_last($table);
        if ($query) {
            
        } else {
            echo "Insertion could not be performed";
        }
    }

    public function test_area() {
        $data["title"] = "Testing Module";
        $data['tested'] = $this->marks->select_test();
        $data['matching'] = $this->marks->select_matching_id();

        $this->load->view("testing", $data);
    }

    public function mark_okay() {
        $id = $this->input->post('id');
        $this->marks->mark_okay($id);
    }

    public function mark_down() {
        $id = $this->input->post('id');

        $this->marks->mark_down($id);
    }

    public function correct_tested() {
        $total = 0;
        $query = $this->marks->correct_tested();
        $count2 = count($this->marks->select_test());

        $count = count($query);

        $total = ($count / $count2) * 100;

        echo $total . "%";
    }

    public function wrong_tested() {
        $total = 0;
        $count2 = count($this->marks->select_test());
        $query = $this->marks->wrong_tested();
        $count = count($query);
        $total = ($count / $count2) * 100;

        echo $total . "%";
    }

    public function test_update() {
        $id = $this->input->post('id');
        $result_ht = $this->input->post('halftime');
        $result_ft = $this->input->post('fulltime');
        $results = $this->input->post('results');
        echo $id;
        echo $result_ht;
        echo $result_ft;
        echo $results;

        $data1['result_ht'] = $this->input->post('halftime');
        $data2['result_ft'] = $this->input->post('fulltime');
        $data3['results'] = $this->input->post('results');
        $data4['others'] = $this->input->post('others');
        $this->marks->test_update($id, $data1);
        $this->marks->test_update($id, $data2);
        $this->marks->test_update($id, $data3);
        $this->marks->test_update($id, $data4);
    }

    public function test() {

       $strings = $this->marks->get_string_analysis();
       foreach ($strings as $key => $value) {
           if ($value->results === 'x') {
               echo $value->id . "<br />" . $value->results . "<br />";
           }
       }
        // $data['title'] = "JQUERY TESTING";
        // $this->load->view('test.php', $data);
    }

    public function post() {
        $hold = array();
        $pasto = array();
        $strings = $this->marks->get_string_analysis();

        foreach ($strings as $key => $value) {
            if ($value->results === 'P') {
                $pasto = array(
                    'id' => $value->id,
                    'name' => $value->team_name,
                    'home' => $value->home,
                    'draw' => $value->draw,
                    'away' => $value->away,
                    'half' => $value->result_ht,
                    'full' => $value->result_ft,
                    'result' => $value->results,
                    'league' => $value->league
                );
                $hold[] = $pasto;
            }
        }
        $data['hold'] = $hold;
        $data['title'] = "Postponed Matches";
        $this->load->view('show', $data);
    }

    public function change_value() {
        $data = $this->marks->get_all_details();
        foreach ($data as $key => $value) {
            if ($value->result_ft === '10_0') {
                $this->marks->update_half_result($value->id, '10-0');
            }
        }
    }

//    public function files() {
//        $this->load->helper('file');
//
//        $string = fopen("/home/danmutwiri/Desktop/file.sql", "a+") or exit("Unable to open the file");
//        // $datas3 = $this->marks->get_fee_details();
//        $datas2 = $this->marks->get_fee_range_table();
//        echo "File writing..";
//
//        foreach ($datas2 as $key => $value) {
//            if ($value->fee_type === "fixed") {
//                if ($value->description === "Change of Use Site Board Fees") {
//                    fwrite($string, "UPDATE fee SET fee_id = 374 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Change of Use Site Inspection" or $value->description === "Extension of Lease Site Inspection" or $value->description === "Site inspection") {
//                    fwrite($string, "UPDATE fee SET fee_id = 2370 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Change of Use PPA1 Form" or $value->description === "Extension of Lease PPA1 Form" or $value->description === "Amalgamation  PPA1 Form") {
//                    fwrite($string, "UPDATE fee SET fee_id = 207 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Sub Division PPA1 Form" or $value->description === "Extension of Use PPA1 Form" or $value->description === "Regularization for Change of Use PPA1 Form") {
//                    fwrite($string, "UPDATE fee SET fee_id = 207 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Sub Division Site Inspection" or $value->description === "Extension of Use Site Inspection") {
//                    fwrite($string, "UPDATE fee SET fee_id = 2370 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Building Plans Hoarding fees ") {
//                    fwrite($string, "UPDATE fee SET fee_id = 374 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Application for Hoarding " or $value->description === "Application for Hoarding") {
//                    fwrite($string, "UPDATE fee SET fee_id = 372 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Site inspection " or $value->description === "Extension of Lease Site Board Fees" or $value->description === "Amalgamation Site Inspection") {
//                    fwrite($string, "UPDATE fee SET fee_id = 2370 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Architectural (Building Plans) Application Form" or $value->description === "Architectural Plans Application Top-Up") {
//                    fwrite($string, "UPDATE fee SET fee_id = 209 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Structural Application Form" or $value->description === "Civil Application Form") {
//                    fwrite($string, "UPDATE fee SET fee_id = 210 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Site Construction Board Application fees" or $value->description === "Building Plans Hoarding fees") {
//                    fwrite($string, "UPDATE fee SET fee_id = 374 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Site Construction Board Permit (1200x2000)mm") {
//                    fwrite($string, "UPDATE fee SET fee_id = 375 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Regularization for Change of Use Site Board Fees") {
//                    fwrite($string, "UPDATE fee SET fee_id = 372 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Extension of Use Site Board Fees") {
//                    fwrite($string, "UPDATE fee SET fee_id = 372 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Regularization for Change of Use Site Inspection") {
//                    fwrite($string, "UPDATE fee SET fee_id = 2370 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Admnistrative Change of Use Site Board Fees") {
//                    fwrite($string, "UPDATE fee SET fee_id = 257 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Administrative Change of Use PPA1 Form" or $value->description === "Renewal for Administrative Change of Use PPA1 Form") {
//                    fwrite($string, "UPDATE fee SET fee_id = 207 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Renewal for Admnistrative Change of Use Site Board Fees") {
//                    fwrite($string, "UPDATE fee SET fee_id = 260 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Renewal for Administrative Change of Use Site Inspection") {
//                    fwrite($string, "UPDATE fee SET fee_id = 2370 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Renewal of Lease PPA1 Form") {
//                    fwrite($string, "UPDATE fee SET fee_id = 207 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Renewal of Lease Site Board Fees") {
//                    fwrite($string, "UPDATE fee SET fee_id = 2370 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Renewal of Lease Site Inspection") {
//                    fwrite($string, "UPDATE fee SET fee_id = 2370 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Regularization for Extension of Use PPA1 Form") {
//                    fwrite($string, "UPDATE fee SET fee_id = 207 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Regularization for Extension of Use Site Board Fees") {
//                    fwrite($string, "UPDATE fee SET fee_id = 372 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Regularization for Extension of Use Site Inspection") {
//                    fwrite($string, "UPDATE fee SET fee_id = 2370 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Penalty charged on regularization on compliant buildings ") {
//                    fwrite($string, "UPDATE fee SET fee_id = 207 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Fees for  Occupation Permits") {
//                    fwrite($string, "UPDATE fee SET fee_id = 2510 WHERE id = " . $value->id . ";\n");
//                } else {
//                    
//                }
//            }
//            echo "...";
//        }
//
//        print_r($datas2);
//    }
//
// //    //fclose($string); 
//    public function merge() {
//        $forms = $this->marks->new_users();
       
//        $this->load->helper('file');

//        $string = fopen("/home/danmutwiri/Desktop/file.sql", "a+") or exit("Unable to open the file");
//        foreach ($forms as $keys => $values) {
//         if($values->bill_no === 'INV-EXTL-0001'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='1934-47809', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0002' ){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0003'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0004'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0005'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0006'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0007'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-14000', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0008'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0009'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0010' ){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0011'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0012'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0013'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0014'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0015'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }
        
//         if($values->bill_no === 'INV-EXTL-0016'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }
//         if($values->bill_no === 'INV-EXTL-0017'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0018' ){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0019'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0020'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0021'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0022'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0023'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='2370-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }
        
//         if($values->bill_no === 'INV-EXTL-0024'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }if($values->bill_no === 'INV-EXTL-0025'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0026' ){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0027'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0028'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0029'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0030'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0031'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }
        
//         if($values->bill_no === 'INV-EXTL-0032'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }if($values->bill_no === 'INV-EXTL-0033'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0034' ){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0035'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0036'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0037'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

//         if($values->bill_no === 'INV-EXTL-0038'){
//            fwrite($string, "UPDATE `countypro_crontab` SET `schedule_id` = '', `part_id` = '',`sub_part_id` = '', `fee_id` = '', `ward_id` = '', `response` = '', `fees` ='207-7500', `bill_amount` = $values->bill_amount WHERE`countypro_crontab`.`id` = $values->id;\n\n");
//         }

       
       
//         }
//         fclose($string); 
//        print_r($forms);
//     }
// //
//    public function files2() {
//        $datas2 = $this->marks->get_fee_table();

//        print_r($datas2);
//    /}

}
