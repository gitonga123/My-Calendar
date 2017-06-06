<?php

defined('BASEPATH') or exit("No direct Script is Allowed");

class Make extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model("makes");
        $this->load->helper("url");
        $this->load->library("pagination");
        $this->load->helper("form");
        $this->load->library("form_validation");
    }

    public function index() {
        $data['title'] = "Entry Results";
        $data['odds'] = $this->makes->get_all_details2();
        $data['count'] = count($this->makes->get_all_details());
        $this->load->view('mark2', $data);
    }

    public function get_database(){
        $data['title'] = "All Records";
        $data['records'] =$this->makes->get_all_details3();
        $this->load->view('records',$data);
    }

    public function excels(){
        // $inputs = $this->post->($value);
        $time = $this->input->post('time');
        $this->load->library('excel');
        $file = '/home/daniel/Desktop/Learning_python/output.xlsx';
        $check = 0;
        $objPHPExcel = PHPExcel_IOFactory::load($file);
        $cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
        foreach ($cell_collection as $cell) {
            $column = $objPHPExcel->getActiveSheet()->getCell($cell)->getColumn();
            $row = $objPHPExcel->getActiveSheet()->getCell($cell)->getRow();
            $data_value = $objPHPExcel->getActiveSheet()->getCell($cell)->getValue();
         
            //header will/should be in row 1 only. of course this can be modified to suit your need.
            if ($row == 1) {
                $header[$row][$column] = $data_value;
            } else {
                $arr_data[$row][$column] = $data_value;
            }
        }
         
        //send the data in an array format
        $data['header'] = $header;
        $data['values'] = $arr_data;

        $value_key = 12;
        $upload_data = array();
        foreach ($arr_data as $key => $value) {
            if ($key == $value_key) {
                if(!empty($value['B'])){
                    if($value['B'] == $time){
                     $upload_data[] = array( 
                      "`DATE`"=>$value['A'],
                      "`TIME`"=>$value['B'],
                      "`HOMETEAM`"=>$value['D'],
                      "`HOME`"=>$this->is_decimal($value['E']),
                      "`DRAW`"=>$this->is_decimal($value['F']),
                      "`VISITINGTEAM`"=>$value['G'],
                      "`AWAY`"=>$this->is_decimal($value['H']),
                      "`LEAGUE`"=>$tempral,
                      
                      );    
                    }
                    
                }else{
                    $tempral = $value['A'];

                }             

              $value_key++;
            }  
           
        }
        // print_r($upload_data);
        for ($i=0; $i < count($upload_data); $i++) { 
            $check = $this->makes->insert_table_2($upload_data[$i]);
        }

        if ($check) {
             $this->transafer($time);
           // echo "am doing";
        }else{
            echo "<p class='alert alert-danger'>Data With Time" . $time . " can not be found</p>" ;
        }
    }

        
        // print_r($arr_data);
        // echo print_r($arr_data);
    //Database Back up
    public function backup(){
       // $this->load->dbutil();
       // $this->load->helper('file');
       // $this->load->helper('download');
       // $check =0;
       // // if ($this->dbutil->optimize_table('TABLE3')){
       // //      echo 'Success!';
       // //  }

       //  // $backup = $this->dbutil->backup();

       //  // // Load the file helper and write the file to your server
       //  // write_file('/home/daniel/Desktop', $backup);

       //  // // Load the download helper and send the file to your desktop
        
       //  // $check = force_download('mybackup.gz', $backup);
       //  $prefs = array(
       //  // 'tables'        => array('TABLE3', 'TABLE2'),   // Array of tables to backup.
       //  // 'ignore'        => array('testing','table_2'),                     // List of tables to omit from the backup
       //  'format'        => 'txt',                       // gzip, zip, txt
       //  'filename'      => 'mybackup.sql',              // File name - NEEDED ONLY WITH ZIP FILES
       //  // 'add_drop'      => TRUE,                        // Whether to add DROP TABLE statements to backup file
       //  // 'add_insert'    => TRUE,                        // Whether to add INSERT data to backup file
       //  // 'newline'       => "\n"                         // Newline character used in backup file
       //  );

       //  $backup = $this->dbutil->backup($prefs);

       //  $db_name = 'backup-on-'.date("Y-m-d-H-i-s").'.zip';
       //  $save = '/home/daniel/Desktop/books/'.$db_name;
       //  write_file($save, $backup); 
       //  force_download($db_name, $backup); 
       //  // if($check){
       //  //     echo "Successfully Backed";
       //  // }else{
       //  //     echo "An Error exeprienced";
       //  // }
        // $this->load->dbutil();

        // $prefs = array(     
        //         'format'      => 'zip',             
        //         'filename'    => 'my_db_backup.sql'
        //       );


        // $backup =& $this->dbutil->backup($prefs); 

        // $db_name = 'backup-on-'. date("Y-m-d-H-i-s") .'.zip';
        // $save = 'home/daniel/Desktop/books/'.$db_name;

        // $this->load->helper('file');
        // write_file($save, $backup); 


        // $this->load->helper('download');
        // force_download($db_name, $backup);
        echo "<p class='alert alert-default'>Am Not Currently in service am Under Development</p>";
    }
    public function transafer($time) {
        $table_name = "table_2";
        $data = $this->makes->get_details_for_uploads($table_name);
        if ($data) {
            $query = json_decode(json_encode($data), TRUE);
            foreach ($query as $key => $value) {
                if (!empty($value['HOMETEAM']) && $value['TIME'] == $time) {
                    $datas = array(
                        "team_name" => ucwords(strtolower($value['HOMETEAM'])),
                        "home" => $this->is_decimal($value['HOME']),
                        "away" => $this->is_decimal($value['AWAY']),
                        "draw" => $this->is_decimal($value['DRAW']),
                        "league" => ucwords(strtolower($value['LEAGUE'])),
                        "times" => $value['TIME'],
                        "date" => $value['DATE']
                    );
                    // print_r($datas);
                    $this->makes->get_updates($datas);
                }
            }
            echo "<p class='alert alert-info'>Data Upload complete:  Go to <a href='/page/make/update_result' class='btn btn-sm btn-info'>Uploads to add update result</a> OR GO TO => <a href='/page/make/search_area' class='btn btn-sm btn-danger'> Mass Search</a></p>";
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
            $datas['team_name'] = ucwords(strtolower($this->input->post('team')));
            $datas['home'] = $this->input->post('home');
            $datas['away'] = $this->input->post('away');
            $datas['draw'] = $this->input->post('draw');
            $datas['result_ht'] = $this->input->post('halftime');
            $datas['result_ft'] = $this->input->post('fulltime');
            $datas['results'] = $this->input->post('results');
            $datas['league'] = ucwords(strtolower($this->input->post('league')));
            $datas['times'] = $this->get_time();
            $datas['date'] = $this->get_date();
            $this->makes->get_updates($datas);

            // $this->testing_area();
            // if($query){
            //     $this->index();
            // }
        }
        $this->load->view('insert2', $data);
    }

    public function delete_postpone() {
        $odds = $this->makes->get_all_details();

        foreach ($odds as $key => $value) {
            if ($value->result_ft === 'P') {
                echo "deleting...";
                $this->makes->delete_postpone($value->id);
            }
        }
    }

    public function team_suggest() {
        $team_search = $this->makes->team_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->team_name;
        }
        echo json_encode($hold);
    }

    public function home_suggest() {
        $team_search = $this->makes->home_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->home;
        }
        echo json_encode($hold);
    }

    public function draw_suggest() {
        $team_search = $this->makes->draw_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->draw;
        }
        echo json_encode($hold);
    }

    public function away_suggest() {
        $team_search = $this->makes->away_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->away;
        }
        echo json_encode($hold);
    }

    public function half_suggest() {
        $team_search = $this->makes->half_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->result_ht;
        }
        echo json_encode($hold);
    }

    public function full_suggest() {
        $team_search = $this->makes->full_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->result_ft;
        }
        echo json_encode($hold);
    }

    public function result_suggest() {
        $team_search = $this->makes->result_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->results;
        }
        echo json_encode($hold);
    }

    public function league_suggest() {
        $team_search = $this->makes->league_name();
        $hold = array();
        foreach ($team_search as $key => $value) {
            $hold[] = $value->league;
        }
        echo json_encode($hold);
    }

    public function search_area() {
        $data['title'] = 'Search Area';
        $data['testing_data'] = $this->makes->select_test();
        $this->load->view('search2', $data);
    }

    public function google() {

        $team_draw = $this->makes->draw_name();
        $team_home = $this->makes->home_name();
        $team_away = $this->makes->away_name();
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
        $home_search = $this->makes->search_home($search);

        $draw_search = $this->makes->search_draw($search);

        $away_search = $this->makes->search_away($search);

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
        $this->delete_uploaded();
        $data['title'] = "Update Results";
        $odds = $this->makes->get_all_details();
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
        $this->load->view('update2', $data);
    }

    public function result_update() {
        $data = $this->input->post('id');
        $data1['result_ht'] = $this->input->post('halftime');
        $data2['result_ft'] = $this->input->post('fulltime');
        $data3['results'] = $this->input->post('results');
        $results1 = $this->makes->update_result($data, $data1);
        if ($results1) {
            $results2 = $this->makes->update_result($data, $data2);
            if ($results2) {
                $results3 = $this->makes->update_result($data, $data3);
                if ($results3) {
                    echo $results3;
                }
            }
        }
    }

    public function lock() {
        $data['title'] = "Lock Screen";
        $data['error_message'] = "";

        $this->load->view('screen2', $data);
    }

    public function login() {
        $password = $this->input->post('password');
        if ($password == 'daniel123') {
            $this->index();
        } else {
            $data['title'] = "Lock Screen";
            $data['error_message'] = "<p class='alert alert-danger'>Password Mis-smatch</p>";
            $this->load->view('screen2', $data);
        }
    }

    public function get_time() {
        $date = date("Y-m-d H:i:s");

        $endtime = strtotime('+0 minutes', strtotime($date));

        $mess = date('H:i', $endtime);

        return $mess;
    }

    public function get_date() {
        $date = date('d/m/Y');

        return $date;
    }

    public function summary() {
        $datas = $this->makes->get_all_details();

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

        $this->load->view('summary2', $data);
    }

    public function graphical_home() {
        $home = array();
        $datas = $this->makes->get_all_details();
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
        $datas = $this->makes->get_all_details();
        $data = json_decode(json_encode($datas), true);
        foreach ($data as $key => $value) {
            if(!empty($value['results']))
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
        $datas = $this->makes->get_all_details();
        $data = json_decode(json_encode($datas), true);
        foreach ($data as $key => $value) {
            if(!empty($value['result_ht']))
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
        $datas = $this->makes->get_all_details();
        $data = json_decode(json_encode($datas), true);

        foreach ($data as $key => $value) {
            if(!empty($value['result_ht']))
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
        $datas = $this->makes->get_all_details();
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
        $datas = $this->makes->get_all_details();
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
        $datas2 = $this->makes->get_all_details();
        $data_search = json_decode(json_encode($datas2), TRUE);
        if (isset($_POST['home'])) {
            $value_home = $this->input->post('home');
            $value_draw = $this->input->post('draw');
            $value_away = $this->input->post('away');

            $push_db = array('home' => $value_home,
                'draw' => $value_draw,
                'away' => $value_away);

            $data['exact_search'] = $this->makes->get_all_details_search($value_home, $value_draw, $value_away);
            $exact_search = "<p class='alert alert-warning'>Results Area</p>";
            $exact_hold = "<p class='alert alert-warning'>Results Area</p>";
            $exact_search_hold = "<p class='alert alert-warning'>Results Area</p>";
            $data['exact_search_hold'] = $exact_search_hold;
            $data['hold_search'] = $exact_hold;
        }
        if (!empty($push_db)) {
            $this->makes->insert_search($push_db);
            $this->load->view('exact_search2', $data);
        } else {
            $exact_search_hold = "<p class='alert alert-warning'>Results Area</p>";
            $data['exact_search_hold'] = $exact_search_hold;
            $exact_search = "<p class='alert alert-warning'>Results Area</p>";
            $data['exact_search'] = $exact_search;
            $this->load->view('exact_search2', $data);
        }
    }

    //Brief Case Draw
    public function trend_draw() {
        $datas2 = $this->makes->get_all_details();
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
        $datas2 = $this->makes->get_all_details();
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
        $datas2 = $this->makes->get_all_details();
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
            $query = $this->makes->get_all_details_search2($value['home'], $value['draw'], $value['away']);
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
        $datas2 = $this->makes->get_all_details();
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
        $actual_link = base_url(uri_string());
        $settings = $this->makes->load_settings();
        $result_with = $this->makes->get_frequent_home($settings[0]->field_value);
        $data_search = json_decode(json_encode($result_with), TRUE);
       
        echo "<p class='alert alert-info'><i class='fa fa-briefcase'></i> Most Repetitive with a value of :
        {$settings[0]->field_value}. Go to System Settings To Change <bold><a href='/page/mark/setting' target='_blank'> Settings</a></bold></p>
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
          <th>Time</th>
          <th>Learn More</th>
          
        </thead><tbody>
      ";
      foreach ($data_search as $key => $value) {
        $result_searched = $this->makes->get_all_details_search($value['home'], $value['draw'], $value['away']);
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
            echo "<td>" . $value->times . "</td>";
            echo "<td> 
                    <a class='btn btn-danger btn-sm' href='/page/mark/call_function/{$value->home}/{$value->draw}/{$value->away}' target='_blank'>
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
        $datas2 = $this->makes->get_all_details();
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

        $table = $this->makes->select_last();
        unset($table['league']);
        unset($table['times']);
        unset($table['team_name']);
        unset($table['result_ht']);
        unset($table['result_ft']);
        $query = $this->makes->insert_last($table);
        if ($query) {
            
        } else {
            echo "Insertion could not be performed";
        }
    }

    public function test_area() {
        $data["title"] = "Testing Module";
        $data['tested'] = $this->makes->select_test();
        $data['matching'] = $this->makes->select_matching_id();

        $this->load->view("testing", $data);
    }

    public function mark_okay() {
        $id = $this->input->post('id');
        $this->makes->mark_okay($id);
    }

    public function mark_down() {
        $id = $this->input->post('id');

        $this->makes->mark_down($id);
    }

    public function correct_tested() {
        $total = 0;
        $query = $this->makes->correct_tested();
        $count2 = count($this->makes->select_test());

        $count = count($query);

        $total = ($count / $count2) * 100;

        echo $total . "%";
    }

    public function wrong_tested() {
        $total = 0;
        $count2 = count($this->makes->select_test());
        $query = $this->makes->wrong_tested();
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
        $this->makes->test_update($id, $data1);
        $this->makes->test_update($id, $data2);
        $this->makes->test_update($id, $data3);
        $this->makes->test_update($id, $data4);
    }

    public function test() {

        $strings = $this->makes->get_string_analysis();
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
        $strings = $this->makes->get_string_analysis();

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
        $this->load->view('show2', $data);
    }

    public function change_value() {
        $data = $this->makes->get_all_details();
        foreach ($data as $key => $value) {
            if ($value->results === 'x') {
                $this->makes->update_half_result($value->id, 'X');
            }
        }
    }

    public function update_team() {
        $datas = $this->makes->get_exact_search_data();

        if (empty($datas)) {
            $data['title'] = 'Update Team';
            $data['upload'] = '';
            $this->load->view('update_team2', $data);
        } else {
            $data['title'] = 'Update Team | League';
            $data['upload'] = $this->makes->get_exact_search_data();
            $this->load->view('update_team2', $data);
        }
    }

    public function update_team_league() {
        $team_name = $this->input->post('teamname');
        $league = $this->input->post('league');
        $id = $this->input->post('id');

        $this->makes->update_teams($league, $id);
        $this->makes->update_leagues($team_name, $id);
    }

    public function update_holdon() {
        $data = $this->makes->get_updated_teams();
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
                $query = $this->makes->transfer_exact_team($hold);
                if ($query) {
                    echo "<p class='alert alert-info'>Details Updated</p>";
                } else {
                    echo "<p class='alert alert-danger'>Details Not Uploaded</p>";
                }
            }
        }
    }

    public function delete_updated() {
        $odds = $this->makes->get_updated_teams();
        foreach ($odds as $key => $value) {
            $query = $this->makes->delete_updated($value->id);
            if ($query) {
                echo "<p class='alert alert-info'>Details Deleted</p>";
            } else {
                echo "<p class='alert alert-danger'>Details Not Deleted</p>";
            }
        }
    }

    public function delete_uploaded() {
        $odds = $this->makes->get_details_for_uploads2();
        foreach ($odds as $key => $value) {
            $query = $this->makes->delete_uploaded($value->id);
            // if ($query) {
            //     echo "<p class='alert alert-info'>Details Deleted</p>";
            // } else {
            //     echo "<p class='alert alert-danger'>Details Not Deleted</p>";
            // }
        }
    }

    // public function get_prediction() {
    //     $resultsbf = array();
    //     $resultsbt = array();
    //     $reesultsaf = array();
    //     $resultsat = array();
    //     $hold = array();
    //     $search = $this->makes->get_details_for_uploads2();

    //     // echo "<table class='table table-bordered' id='predict_table'>
        //         <thead>
        //             <tr class='active'>
        //                 <th>Team Name</th>
        //                 <th>Home</th>
        //                 <th>Draw</th>
        //                 <th>Away</th>
        //                 <th>Half Time</th>
        //                 <th>Full Time</th>
        //                 <th>Results</th>
        //                 <th>League</th>
        //                 <th>ID</th>
        //             </tr>
        //         </thead><tbody>";
        // foreach ($search as $keys => $values) {
        //     $query = $this->makes->get_all_details_search($values->HOME, $values->DRAW, $values->AWAY);
        //     $hold[] = $query;
        // }
        // if (!empty($hold)) {
        //         if (count($hold) < 5) {
        //             for ($i=0; $i < sizeof($hold); $i++) { 
        //                 foreach ($hold[$i] as $key => $value) {
        //                     if (!empty($value->results)) {
        //                         echo "<tr class='danger'>
        //                             <td>{$value->team_name}</td>
        //                             <td>{$value->home}</td> 
        //                             <td>{$value->draw}</td>
        //                             <td>{$value->away}</td>
        //                             <td>{$value->result_ht}</td>
        //                             <td>{$value->result_ft}</td>
        //                             <td>{$value->results}</td>
        //                             <td>{$value->league}</td>
        //                             <td>{$value->id}</td>
        //                         </tr>";
        //                         $resultsbf[] = $value->result_ft;
        //                         $resultsbt[] = $value->result_ht;
        //                     }
        //                 }
        //             }
        //         } else {
        //             for ($i=0; $i < sizeof($hold); $i++) { 
        //                 foreach ($query as $key => $value) {
        //                     if (!empty($value->results)) {
        //                         echo "<tr class='success'>
        //                             <td>{$value->team_name}</td>
        //                             <td>{$value->home}</td> 
        //                             <td>{$value->draw}</td>
        //                             <td>{$value->away}</td>
        //                             <td>{$value->result_ht}</td>
        //                             <td>{$value->result_ft}</td>
        //                             <td>{$value->results}</td>
        //                             <td>{$value->league}</td>
        //                             <td>{$value->id}</td>
        //                         </tr>";
        //                         $resultsat[] = $value->result_ht;
        //                         $reesultsaf[] = $value->result_ft;
        //                     }
        //                 }
        //             }
        //         }
        // }else{
        //     echo "No Data is Uploaded to Analyse";
        // }

        // echo "</tbody>";

        // echo "<script>
        //    $(document).ready(function(){
        //         $('#predict_table').DataTable();
        //    });
        //    </script>";
        // $num = $this->information("Half",$resultsat);
        // echo $num;
//        echo "<div class='col-lg-3'>";
//            $this->information($resultsbf);
//        echo "</div>";
//        echo "<div class='col-lg-3'>";
//        $this->information("daniel");
//        echo "</div>";
//        echo "<div>";
//            echo "<p class='alert alert-info'>Full Time Over/Under Analysis</p>";
//            $this->information("full",$resultsbf);
//        echo "</div>";
//        echo "<div>";
//            echo "<p class='alert alert-info'>Half Time Over/Under Analysis</p>";
//            $this->information("half",$resultsbt);
//        echo "</div>";
//         print_r($resultsaf);
//         print_r($resultsbt);
//         print_r($resultsbf);
    // }
        public function get_prediction() {
        $resultsbf = array();
        $resultsbt = array();
        $reesultsaf = array();
        $resultsat = array();
        $check = array();
        $search = $this->makes->get_details_for_uploads2();
        echo "<table class='table table-bordered' id='predict_table'>
                <thead>
                    <tr class='active'>
                        <th>ID</th>
                        <th>Team Name</th>
                        <th>Home</th>
                        <th>Draw</th>
                        <th>Away</th>
                        <th>Half Time </th>
                        <th>Full Time</th>
                        <th>Results</th>
                        <th>League</th>
                        <th>Learn more</th>

                    </tr>
                </thead><tbody>";
        foreach ($search as $keys => $values) {
            $query = $this->makes->get_all_details_search($values->HOME, $values->DRAW, $values->AWAY);
            if (!empty($query)) {
                if (count($query) < 5) {
                    foreach ($query as $key => $value) {
                        $check[] = $query;
                        if (!empty($value->results)) {
                            echo "<tr class='danger'>
                                <td>{$value->id}</td>
                                <td>{$value->team_name}</td>
                                <td>{$value->home}</td> 
                                <td>{$value->draw}</td>
                                <td>{$value->away}</td>
                                <td>{$value->result_ht}</td>
                                <td>{$value->result_ft}</td>
                                <td>{$value->results}</td>
                                <td>{$value->league}</td>
                            ";
                            echo "
                                <td> 
                                <a class='btn btn-danger btn-sm' href='/page/mark/call_function/{$value->home}/{$value->draw}/{$value->away}' target='_blank'>
                                <i class='fa fa-share'></i> Learn More</a>
                             </td>
                            </tr>";
                            $result1ft[] = $value->result_ft;
                            $result1ht[] = $value->result_ht;
                        }
                    }
                } else {
                    foreach ($query as $key => $value) {
                        if (!empty($value->results)) {
                            echo "<tr class='success'>
                                <td>{$value->id}</td>
                                <td>{$value->team_name}</td>
                                <td>{$value->home}</td> 
                                <td>{$value->draw}</td>
                                <td>{$value->away}</td>
                                <td>{$value->result_ht}</td>
                                <td>{$value->result_ft}</td>
                                <td>{$value->results}</td>
                                <td>{$value->league}</td>
                                ";
                            echo "
                                <td> 
                                <a class='btn btn-danger btn-sm' href='/page/mark/call_function/{$value->home}/{$value->draw}/{$value->away}' target='_blank'>
                                <i class='fa fa-share'></i> Learn More</a>
                             </td>
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
        // $num = $this->information("Half",$result1ft);
        // echo $num;
    }

    public function information($strings,$results) {
//        $holds = array();
//        $num = array();
//        $delimiter = '-';
        $number = count($results);
        
        return $number;
        
////        echo "<table class='table table-condensed'>";
////        echo "<thead><th>Count: </th><th>Number</th></thead>";
//        if (is_array($results)) {
//            echo "<tr>";
//            echo "<td>Results</td>";
//            echo "<td>{$number}</td>";
//            echo "</tr>";
//            foreach ($results as $key => $value) {
//                $hold = explode($delimiter, $value);
//                $holds[] = array(
//                    'one' => $hold[0],
//                    'two' => $hold[1]
//                );
//            }
//            if (empty($holds)) {
//                echo "No Results Returned and the Explode Level";
//            } else {
//                foreach ($holds as $key => $values) {
////                    Check for Over 2.5
//                    $num[] = $values['one'] + $values['two'] . "<br />";
//                }
//            }
//            $this->get_over($strings,$num);
//            
//        } else {
//            echo "<p class='alert alert-danger'>No Results. Work Harder<p><br />";
//        }
    }

//    public function get_over($strings,$num) {
//        $verdict = array();
//        $number1 = 0;
//        $number2 = 0;
//        if($strings === 'full'){
//            $control = 2;
//        }else{
//            $control = 1;
//        }
//        echo "<tr>";
//        if (is_array($num)) {
//            $number = array_count_values($num);
//            foreach ($number as $key => $value) {
//                if ($key > $control) {
//                    $verdict[] = "Over";
//                    $number1 =$number1 + 1;
//                } else {
//                    $verdict[] = "Under";
//                    $number2 = $number2 + 1;
//                }
//            }
//            $over = array_search("Over", $verdict);
//            $under = array_search("Over", $verdict);
//            echo "</tr><tr><td> Over</td><td>{$number1}</td>";
//            echo "</tr><tr><td> Under</td><td>{$number2}</td>";
//            echo "</tr><tr><th class='alert-danger'>VERDICT</th>";
//            if (!empty($over) && !empty($under)) {
//                echo "<th class='alert-danger'>Over / Under Not Possible</th>";
//            } else if (!empty($over) && !empty($under)) {
//                echo "<th class='alert-danger'>Over Is Possible</th>";
//            } else if (!empty($over) && !empty($under)) {
//                echo "<th class='alert-danger'>Under is Possible</th>";
//            }
//            echo "</tr></table></div>";
//        } else {
//            echo "Send the right kind of results";
//        }
//    }

    public function team_search() {
        $team_name = $this->input->post('team_name');
        echo $team_name;
        $search = $this->makes->get_team_name_history($team_name);
        echo "<table class='table table-bordered' id='team_table'>
                <thead>
                    <tr class='active'>
                         <th>ID</th>
                        <th>Team Name</th>
                        <th>Home</th>
                        <th>Draw</th>
                        <th>Away</th>
                        <th>Half Time</th>
                        <th>Full Time</th>
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

//    public function files() {
//        $this->load->helper('file');
//
//        $string = fopen("/home/danmutwiri/Desktop/file.sql", "a+") or exit("Unable to open the file");
//        // $datas3 = $this->makes->get_fee_details();
//        $datas2 = $this->makes->get_fee_range_table();
//        echo "File writing..";
//
//        foreach ($datas2 as $key => $value) {
//            if ($value->fee_type === "fixed") {
//                if ($value->description === "Change of Use Site Board Fees") {
//                    fwrite($string, "UPDATE fee SET fee_id = 374 WHERE id = " . $value->id . ";\n");
//                } else if ($value->description === "Change of Use Site Inspection" or $value->description === "Extension 
}
