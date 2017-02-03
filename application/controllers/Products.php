<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

class Products extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
                $this->load->helper('form');
		$this->load->model("product_model");
		$this->load->library('pagination');
                $this->load->library('table');


	}
	public function index(){
            $this->load->view("dynamic_forms");
	}
	public function product_display($offset = 0){
		$config['base_url'] = 'product_display';
		$config['total_rows'] = $this->product_model->count_product();

		$maximum = 10;
		$config['per_page'] = $maximum;
		$config['uri_segment'] = 3;
		$choice = $config['total_rows'] / $config['per_page'];
		$config['num_links'] = round($choice);
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class = "pagination">';
		$config['full_tag_close'] = "</ul>";
		$config['prev_link'] = 'Previous';
                $config['prev_tag_open']='<li>';
                $config['prev_tag_close']='</li>';
                $config['next_link']='Next';
                $config['next_tag_open']='<li>';
                $config['next_tag_close']='</li>';
                $config['cur_tag_open']='<li class="activate"><a href="#">';
                $config['cur_tag_close']='</a></li>';
                $config['num_tag_open']='<li>';
                $config['num_tag_close']='</li>';
		$this->pagination->initialize($config);
		//$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
		$data['products'] = $this->db->get('product_details', $config['per_page'],$offset);
                $tmpl = array ( 'table_open' => '<table class="table table-bordered table-striped table-condensed">' );
		$header = array('Id', 'Product Name','Product Description'); 
                $this->table->set_template($tmpl);
                $this->table->set_heading($header);
                

		$this->load->view('product',$data);
	}
}

?>