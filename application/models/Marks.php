<?php

defined('BASEPATH') or exit("No direct Access is allowed");

class Marks extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function get_all_details() {
        $table_name = "TABLE2";
        $this->db->select();
        $query = $this->db->get($table_name);

        return $query->result();
    }

    public function get_details_for_uploads() {
        $table_name = "TABLE3";
        $this->db->select();
        $query = $this->db->get($table_name);

        return $query->result();
    }

    public function insert_details($data) {
        $table_name = "TABLE2";
        return $this->db->insert($table_name, $data);
    }

    public function get_updates($data) {
        $this->db->insert("TABLE2", $data);
    }

    public function team_name() {
        $this->db->distinct();
        $this->db->select('team_name');
        $query = $this->db->get('TABLE2');
        return $query->result();
    }

    public function home_name() {
        $this->db->distinct();
        $this->db->select('home');
        $query = $this->db->get('TABLE2');
        return $query->result();
    }

    public function away_name() {
        $this->db->distinct();
        $this->db->select('away');
        $query = $this->db->get('TABLE2');
        return $query->result();
    }

    public function draw_name() {
        $this->db->distinct();
        $this->db->select('draw');
        $query = $this->db->get('TABLE2');
        return $query->result();
    }

    public function half_name() {
        $this->db->distinct();
        $this->db->select('result_ht');
        $query = $this->db->get('TABLE2');
        return $query->result();
    }

    public function full_name() {
        $this->db->distinct();
        $this->db->select('result_ft');
        $query = $this->db->get('TABLE2');
        return $query->result();
    }

    public function result_name() {
        $this->db->distinct();
        $this->db->select('results');
        $query = $this->db->get('TABLE2');
        return $query->result();
    }

    public function league_name() {
        $this->db->distinct();
        $this->db->select('league');
        $query = $this->db->get('TABLE2');
        return $query->result();
    }

    public function search_home($data) {

        $query = $this->db->get_where('TABLE2', array('home' => $data));

        return $query->result();
    }

    public function search_draw($data) {

        $query = $this->db->get_where('TABLE2', array('draw' => $data));

        return $query->result();
    }

    public function search_away($data) {

        $query = $this->db->get_where('TABLE2', array('away' => $data));

        return $query->result();
    }

    public function update_result($data, $data1) {
        $this->db->where('id', $data);
        return $this->db->update('TABLE2', $data1);
    }

    public function select_last() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('TABLE2');
        return $query->row_array();
    }

    public function insert_last($data) {
        return $this->db->insert('testing', $data);
    }

    public function select_test() {
        $query = $this->db->get('testing');
        return $query->result();
    }

    public function select_matching_id() {
        $hold = array();
        $result = $this->select_all_id();
        foreach ($result as $key => $value) {
            $this->db->where('id', $value->id);
            $query = $this->db->get('TABLE2');
            $hold[] = $query->row_array();
        }
        return $hold;
    }

    public function select_all_id() {
        $this->db->select('id');
        $query = $this->db->get('testing');
        return $query->result();
    }

    public function mark_okay($param) {
        $data['okay'] = 1;
        $this->db->where('id', $param);
        return $this->db->update('testing', $data);
    }

    public function mark_down($param) {
        $data['okay'] = 0;
        echo $param;
        $this->db->where('id', $param);
        return $this->db->update('testing', $data);
    }

    public function correct_tested() {
        $this->db->select('okay');
        $this->db->where('okay', 1);
        $query = $this->db->get('testing');
        return $query->result();
    }

    public function wrong_tested() {
        $this->db->select('okay');
        $this->db->where('okay', 0);
        $queyr = $this->db->get('testing');
        return $queyr->result();
    }

    public function test_update($data, $data1) {
        $this->db->where('id', $data);
        return $this->db->update('testing', $data1);
    }

    public function get_string_analysis() {
        $this->db->select();
        $query = $this->db->get('TABLE2');
        return $query->result();
    }

    public function update_half_result($id, $value){
        $data['result_ft'] = $value;
        $this->db->where('id', $id);
        return $this->db->update('TABLE2', $data);
    }
    
    public function get_fee_range_details(){
        $this->db->select();
        $query = $this->db->get('TABLE3');
        
        return $query->result();
    }
    
//    public function get_fee_range_table(){
//        $this->db->select();
//        $query = $this->db->get('fee');
//        
//        return $query->result();
//    }
    
    public function new_users(){
        $this->db->select();
        $query =  $this->db->get('countypro_crontab');
        
        return $query->result();
    }
    
//    public function get_form(){
//        $this->db->select();
//        $query = $this->db->get('ap_form_28697');
//        
//        return $query->result();
//    }
//    
//    public function insert_inds($data){
//        return $this->db->insert('arch',$data);
//    }
//    
//    public function insert_firms($data){
//        return $this->db->insert('arch', $data);
//    }
}
