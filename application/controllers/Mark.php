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
        $data['odds'] = $this->marks->get_all_details2();
        $data['count'] = count($this->marks->get_all_details());
        $this->load->view('mark', $data);
    }

    public function transafer() {
        $table_name = "table_2";
        $time = $this->input->post('time');
        $data = $this->marks->get_details_for_uploads($table_name);
        if ($data) {
            $query = json_decode(json_encode($data), TRUE);
            foreach ($query as $key => $value) {
                if (!empty($value['HOME TEAM']) && $value['TIME'] == $time) {
                    $datas = array(
                        "team_name" => ucwords(strtolower($value['HOME TEAM'])),
                        "home" => $this->is_decimal($value['HOME']),
                        "away" => $this->is_decimal($value['AWAY']),
                        "draw" => $this->is_decimal($value['DRAW']),
                        "league" => ucwords(strtolower($value['LEAGUE'])),
                        "times" => $value['TIME'],
                        "date" => $value['DATE']
                    );
                    // print_r($datas);
                    $this->marks->get_updates($datas);
                }
            }
            echo "<p class='alert alert-info'>Data Upload complete:  Go to <a href='/page/mark/update_result' class='btn btn-sm btn-info'>Uploads to add update result</a></p>";
        } else {
            echo "<p class='alert alert-danger'>No Data uploads Avaialable</p>";
        }
    }

    public function is_decimal($value) {

        if (strpos($value, ".") == true) {
            $pattern = "/^[0-9]+(?:\.[0-9]{2})?$/";
            if (preg_match($pattern, $value)) {
                return $value;
            } else {
                $value = number_format($value, 2, '.', '');
                return $value;
            }
        } else {
            $value = number_format($value, 2, '.', '');
            return $value;
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
            $data['date'] = $this->get_date();
            $this->marks->get_updates($datas);

            // $this->testing_area();
            // if($query){
            //     $this->index();
            // }
        }
        $this->load->view('insert', $data);
    }

    public function delete_postpone() {
        $odds = $this->marks->get_all_details();

        foreach ($odds as $key => $value) {
            if ($value->result_ft === 'P') {
                echo "deleting...";
                $this->marks->delete_postpone($value->id);
            }
        }
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

    public function get_date() {
        $date = date('d/m/Y');

        return $date;
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
            if ($value >= 100) {
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
        //print_r($hommy);

        $hommes = array_count_values($hommy);
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
            if ($value >= 100) {
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
            if ($value >= 100) {
                $draw[$key] = $value;
            }
        }
        echo json_encode($draw);
    }

    public function exact_search() {
        $push_db = array();
        $data['title'] = "Exact Search";
        $datas2 = $this->marks->get_all_details();
        $data_search = json_decode(json_encode($datas2), TRUE);
        if (isset($_POST['home'])) {
            $value_home = $this->input->post('home');
            $value_draw = $this->input->post('draw');
            $value_away = $this->input->post('away');

            $push_db = array('home' => $value_home,
                'draw' => $value_draw,
                'away' => $value_away);

            $data['exact_search'] = $this->marks->get_all_details_search($value_home, $value_draw, $value_away);
            $exact_search = "<p class='alert alert-warning'>Results Area</p>";
            $exact_hold = "<p class='alert alert-warning'>Results Area</p>";
            $exact_search_hold = "<p class='alert alert-warning'>Results Area</p>";
            $data['exact_search_hold'] = $exact_search_hold;
            $data['hold_search'] = $exact_hold; 


            $data['button']= "<span style='margin-left: 5%'></span>
            <a href='/page/mark/call_function/{$value_home}/{$value_draw}/{$value_away}' class='btn btn-primary'><i class='fa fa-star'> </i> View Analysis</a>";

        }
        if (!empty($push_db)) {
            $this->marks->insert_search($push_db);
            $this->load->view('exact_search', $data);
        } else {
            $exact_search_hold = "<p class='alert alert-warning'>Results Area</p>";
            $data['exact_search_hold'] = $exact_search_hold;
            $exact_search = "<p class='alert alert-warning'>Results Area</p>";
            $data['exact_search'] = $exact_search;
            $data['button'] = '';
            $this->load->view('exact_search', $data);
        }
    }

    public function call_function(){
        $value1=  $this->uri->segment(3);
        $value2 =  $this->uri->segment(4);
        $value3 =  $this->uri->segment(5);
        $this->display_exact_search_results($value1,$value2,$value3);
    }

    public function display_exact_search_results($value_home,$value_draw,$value_away){
        $home = floatval($value_home);
        $draw = floatval($value_draw);
        $away = floatval($value_away);
        $data = $this->marks->get_all_details_search($home, $draw,$away);

        if(count($data) != 0){
            foreach ($data as $key => $value) {
                    
                    $split_results = explode('-', $value->result_ht);
                    $halftime[] = $this->sum($split_results);
            }
            $halftime_counted_values =(array_count_values($halftime));
            $analysis = $this->get_over_under($halftime_counted_values,'halftime');

            foreach ($data as $key => $value) {
                    
                    $split_results_fulltime = explode('-', $value->result_ft);
                    $fulltime[] = $this->sum($split_results_fulltime);
            }
            $fulltime_counted_values =(array_count_values($fulltime));
            $analysisf = $this->get_over_under($fulltime_counted_values,'fulltime');

            foreach ($data as $key => $value) {
                    $halftimes[] = $value->result_ht;
                    $fulltimes[] = $value->result_ft;
            }
            $gg_halftime = $this->goal_nogoal($halftimes); 
            $gg_fulltime = $this->goal_nogoal($fulltimes);
            $data1['home'] = $value_home;
            $data1['draw'] = $value_draw;
            $data1['away'] = $value_away;
            $data1['halftime_counted_values'] = $halftime_counted_values;
            $data1['analysis'] = $analysis;
            $data1['fulltime_counted_values'] = $fulltime_counted_values;
            $data1['analysisf'] = $analysisf;

            $data1['gg_fulltime'] = $gg_fulltime;
            $data1['gg_halftime'] = $gg_halftime;
            $data1['title'] = "Learn More";
            $this->load->view('search_result',$data1);

        }else{
            echo "<p class='alert alert-danger'>No Records TO Analyse</p>";
        }
        
    }
    public function goal_nogoal($array){
        
        if(is_array($array)){
            $halftime = array();
            $split_results = array();
            
            $gg = 0;
            $ng = 0;
            foreach($array as $key => $value) {
                // echo $value . "<br />";
                $split_results = explode('-', $value);
                if(in_array(0, $split_results)){
                    $ng += 1;
                }else{
                    $gg +=1;
                }

                $halftime= array('GG' => $gg, 'NG' => $ng);
            }

            if($halftime['GG'] > $halftime['NG']){

                $prediction = "GG";
                $precentage_win = number_format((($halftime['GG']/count($array))*100),2). '%';

                $halftime ['prediction']= $prediction;

                $halftime ['percentage_win']= $precentage_win;
            }elseif ($halftime['GG'] == $halftime['NG']) {
                echo "Percentage Win";

                $prediction = "GG/NG";
                $precentage_win = number_format((($halftime['GG']/count($array))*100),2). '%';

                $halftime ['prediction']= $prediction;

                $halftime ['percentage_win']= $precentage_win;
            }else{
                

                $prediction = "NG";
                $precentage_win = number_format((($halftime['NG']/count($array))*100),2). '%';

                $halftime ['prediction']= $prediction;

                $halftime ['percentage_win']= $precentage_win;
            }
            return ($halftime);
        }else{
            echo "<p class='alert alert-danger'>Results can not be determined at the Moment</p>";
        }

    }
    public function sum($array1){
        $total = 0;
        $array = array();
        for ($i=0; $i < sizeof($array1); $i++) { 
                $total = $total + $array1[$i];
        }

        return $total;  
    }

    public function get_over_under($array,$period){
        
        if(is_array($array) && $period ==='halftime'){
            $low = 1;
            $lower = 0;
            $determine_under =0;
            $determine_over = 0;
            $get_average_low = 0;
            $get_average_high = 0;
            foreach ($array as $key => $value) {
                if($key <= $low){
                    $get_average_low += $value ;
                    $determine_under += $value;
                }else{
                    $get_average_high += $value;
                    $determine_over += $value;
                }
            }

            $denominator = $get_average_low + $get_average_high;
            if($determine_over > $determine_under){

                $precentage_win = $get_average_high / $denominator * 100;

                $conclusion  = array("Over 1.5",number_format($precentage_win,2).'%',$get_average_low, $get_average_high);
                return $conclusion;
            }elseif($determine_over == $determine_under){

                $precentage_win = $get_average_high / $denominator * 100;

                $conclusion  = array("Over 1.5/Under 1.5",number_format($precentage_win,2).'%',$get_average_low, $get_average_high);
                return $conclusion;
            }
            else{
                $precentage_win = $get_average_low / $denominator * 100;
                $conclusion  = array("Under 1.5",number_format($precentage_win,2).'%',$get_average_low, $get_average_high);
                return $conclusion;
            }
        }

        if(is_array($array) && $period ==='fulltime'){
            $low = 3;
            $lower = 0;
            $get_average_low = 0;
            $get_average_high = 0;
            $determine_under =0;
            $determine_over = 0;
            foreach ($array as $key => $value) {
                if($key >= $low){
                    $get_average_high += $value ;
                    $determine_over += $value;
                }else{
                    $get_average_low += $value;
                    $determine_under += $value;
                }
            }

            #print_r(array("High" => $determine_over,"Low" => $determine_under));
            $denominator = $get_average_low + $get_average_high;
            if($determine_over > $determine_under){

                $precentage_win = $get_average_high / $denominator * 100;

                $conclusion  = array("Over 2.5",number_format($precentage_win,2).'%',$get_average_low, $get_average_high);
                return $conclusion;
            }elseif($determine_over == $determine_under){

                $precentage_win = $get_average_high / $denominator * 100;

                $conclusion  = array("Over 2.5/Under 2.5",number_format($precentage_win,2).'%',$get_average_low, $get_average_high);
                return $conclusion;
            }
            else{
                echo $get_average_low;
                $precentage_win = $get_average_low / $denominator * 100;
                $conclusion  = array("Under 2.5",number_format($precentage_win,2).'%',$get_average_low, $get_average_high);
                return $conclusion;
            }
        }
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
        foreach ($data_search as $key => $value) {
            $query = $this->marks->get_all_details_search2($value['home'], $value['draw'], $value['away']);
            if (count($query) > 5) {
                foreach ($query as $key => $value) {
                    echo "<tr>";
                    echo "<td>" . $value->team_name . "</td>";
                    echo "<td>" . $value->home . "</td>";
                    echo "<td>" . $value->draw . "</td>";
                    echo "<td>" . $value->away . "</td>";
                    echo "<td>" . $value->result_ht . "</td>";
                    echo "<td>" . $value->result_ft . "</td>";
                    echo "<td>" . $value->results . "</td>";

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

    public function get_frequent_home(){
        $settings = $this->marks->load_settings();
        $result = $this->marks->get_frequent_home($settings[0]->field_value);
        return $result;
    }
   
//Brief Case Home
    public function trend() {
        //Get my current 
        $actual_link = base_url(uri_string());
        $settings = $this->marks->load_settings();
        $result_with = $this->marks->get_frequent_home($settings[0]->field_value);
        $data_search = json_decode(json_encode($result_with), TRUE);
       
        echo "<p class='alert alert-info'><i class='fa fa-briefcase'></i> Most Repetitive with a value of :
        {$settings[0]->field_value}. Go to System Settings To Change <bold><a href='/page/mark/setting'> Settings</a></bold></p>
        <table class='table table-hover table-condensed' id='myTable'>
        <thead>
          <th>Team Name</th>
          <th>Home</th>
          <th>Draw</th>
          <th>Away</th>
          <th>halftime</th>
          <th>fulltime</th>
          <th>Judgment</th>
          <th>League</th>
          <th>Learn More</th>
          
        </thead><tbody>
      ";
      foreach ($data_search as $key => $value) {
        $result_searched = $this->marks->get_all_details_search($value['home'], $value['draw'], $value['away']);
        foreach ($result_searched as $key => $value) {
            echo "<tr>";
            echo "<td>" . $value->team_name . "</td>";
            echo "<td>" . $value->home . "</td>";
            echo "<td>" . $value->draw . "</td>";
            echo "<td>" . $value->away . "</td>";
            echo "<td>" . $value->result_ht. "</td>";
            echo "<td>" . $value->result_ft . "</td>";
            echo "<td>" . $value->results . "</td>";
            echo "<td>" . $value->league . "</td>";
            echo "<td> 
                    <a class='btn btn-danger btn-sm' href='/page/mark/call_function/{$value->home}/{$value->draw}/{$value->away}'>
                    <i class='fa fa-share'></i> Learn More</a>
            </td>"; 
            echo "</tr>";
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
        $value = 07.19;
        // $pattern = "/^[0-9]*\.[0-9]{2}$";
        $pattern = "/^[0-9]+(?:\.[0-9]{2})?$/";
        if (preg_match($pattern, $value)) {
            echo $value;
        } else {
            $number2 = number_format($value, 2, '.', '');
            echo $number2;
        }
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
            if ($value->results === 'x') {
                $this->marks->update_half_result($value->id, 'X');
            }
        }
    }

    public function update_team() {
        $datas = $this->marks->get_exact_search_data();

        if (empty($datas)) {
            $data['title'] = 'Update Team';
            $data['upload'] = '';
            $this->load->view('update_team', $data);
        } else {
            $data['title'] = 'Update Team | League';
            $data['upload'] = $this->marks->get_exact_search_data();
            $this->load->view('update_team', $data);
        }
    }

    public function update_team_league() {
        $team_name = $this->input->post('teamname');
        $league = $this->input->post('league');
        $id = $this->input->post('id');

        $this->marks->update_teams($league, $id);
        $this->marks->update_leagues($team_name, $id);
    }

    public function update_holdon() {
        $data = $this->marks->get_updated_teams();
        $hold = array();
        foreach ($data as $key => $value) {
            if (!empty($value->league)) {
                $hold = array(
                    'team_name' => ucwords(strtolower($value->league)),
                    'home' => $value->home,
                    'draw' => $value->draw,
                    'away' => $value->away,
                    'league' => ucwords(strtolower($value->team_name)),
                    'times' => $this->get_time(),
                    'date' => $this->get_date()
                );
                $query = $this->marks->transfer_exact_team($hold);
                if ($query) {
                    echo "<p class='alert alert-info'>Details Updated</p>";
                } else {
                    echo "<p class='alert alert-danger'>Details Not Uploaded</p>";
                }
            }
        }
    }

    public function delete_updated() {
        $odds = $this->marks->get_updated_teams();
        foreach ($odds as $key => $value) {
            $query = $this->marks->delete_updated($value->id);
            if ($query) {
                echo "<p class='alert alert-info'>Details Deleted</p>";
            } else {
                echo "<p class='alert alert-danger'>Details Not Deleted</p>";
            }
        }
    }

    public function delete_uploaded() {
        $odds = $this->marks->get_details_for_uploads2();
        foreach ($odds as $key => $value) {
            $query = $this->marks->delete_uploaded($value->id);
            if ($query) {
                echo "<p class='alert alert-info'>Details Deleted</p>";
            } else {
                echo "<p class='alert alert-danger'>Details Not Deleted</p>";
            }
        }
    }

    public function get_prediction() {
        $resultsbf = array();
        $resultsbt = array();
        $reesultsaf = array();
        $resultsat = array();
        $check = array();
        $search = $this->marks->get_details_for_uploads2();
        echo "<table class='table table-bordered' id='predict_table'>
                <thead>
                    <tr class='active'>
                        <th>Team Name</th>
                        <th>Home</th>
                        <th>Draw</th>
                        <th>Away</th>
                        <th>Result Half Time</th>
                        <th>Result FUll Time</th>
                        <th>Results</th>
                        <th>League</th>
                        <th>ID</th>
                    </tr>
                </thead><tbody>";
        foreach ($search as $keys => $values) {
            $query = $this->marks->get_all_details_search($values->HOME, $values->DRAW, $values->AWAY);
            if (!empty($query)) {
                if (count($query) < 5) {
                    foreach ($query as $key => $value) {
                        $check[] = $query;
                        if (!empty($value->results)) {
                            echo "<tr class='danger'>
                                <td>{$value->team_name}</td>
                                <td>{$value->home}</td> 
                                <td>{$value->draw}</td>
                                <td>{$value->away}</td>
                                <td>{$value->result_ht}</td>
                                <td>{$value->result_ft}</td>
                                <td>{$value->results}</td>
                                <td>{$value->league}</td>
                                <td>{$value->id}</td>
                            </tr>";
                            $result1ft[] = $value->result_ft;
                            $result1ht[] = $value->result_ht;
                        }
                    }
                } else {
                    foreach ($query as $key => $value) {
                        if (!empty($value->results)) {
                            echo "<tr class='success'>
                                <td>{$value->team_name}</td>
                                <td>{$value->home}</td> 
                                <td>{$value->draw}</td>
                                <td>{$value->away}</td>
                                <td>{$value->result_ht}</td>
                                <td>{$value->result_ft}</td>
                                <td>{$value->results}</td>
                                <td>{$value->league}</td>
                                <td>{$value->id}</td>
                            </tr>";
                            $resultsat[] = $value->result_ht;
                            $reesultsaf[] = $value->result_ft;
                        }
                    }
                }
            }
        }

        echo "</tbody></thead>";

        echo "<script>
           $(document).ready(function(){
                $('#predict_table').DataTable();
           });
           </script>";
        $num = $this->information("Half",$result1ft);
        echo $num;
    }

    public function information($strings,$results) {

        $number = count($results);
        
        return $number;
        
    }


    public function team_search() {
        $team_name = $this->input->post('team_name');
        echo $team_name;
        $search = $this->marks->get_team_name_history($team_name);
        echo "<table class='table table-bordered' id='team_table'>
                <thead>
                    <tr class='active'>
                         <th>ID</th>
                        <th>Team Name</th>
                        <th>Home</th>
                        <th>Draw</th>
                        <th>Away</th>
                        <th>Result Half Time</th>
                        <th>Result FUll Time</th>
                        <th>Results</th>
                        <th>League</th>
                        <th>Form</th>
                    </tr>
                </thead><tbody>";
        foreach ($search as $keys => $value) {
            echo "<tr>
                    <td>{$value->id}</td>
                    <td>{$value->team_name}</td>
                    <td>{$value->home}</td> 
                    <td>{$value->draw}</td>
                    <td>{$value->away}</td>
                    <td>{$value->result_ht}</td>
                    <td>{$value->result_ft}</td>
                    <td>{$value->results}</td>
                    <td>{$value->league}</td>
                    <td>";
            if ($value->results === 'X') {
                echo "<p class='alert alert-warning'>D</p>";
            } else if ($value->results == '1') {
                echo "<p class='alert alert-success'>W</p>";
            } else if ($value->results == '2') {
                echo "<p class='alert alert-danger'>L</p>";
            } else if ($value->results === 'A') {
                echo "<p class='alert alert-info'>A</p>";
            } else {
                echo "<p class='alert alert-default'>P</p>";
            }
            echo "</tr>";
        }

        echo "</tbody></thead>";

        echo "<script>
         $(document).ready(function(){
            $('#team_table').DataTable();
        });
       </script>";
    }
    public function setting(){
        $settings = $this->marks->load_settings();
        $data['title'] = 'System Settings';
        $data['most_common'] = $settings[0]->field_value;
        $data['id'] = $settings[0]->id;
        $this->load->view('system_setting',$data);
    }

    public function settings_update(){
        $data = $this->input->post('id');
        $data1['field_value'] = $this->input->post('field_value');
        $results1 = $this->marks->update_settings($data, $data1);
        if ($results1) {
            echo "success";
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
//                } else if ($value->description === "Change of Use Site Inspection" or $value->description === "Extension 
}
