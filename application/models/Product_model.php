<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class Product_model  extends CI_Model{
		function __construct()
		{
			parent::__construct();
		}
		public function count_product(){
			return $this->db->count_all('product_details');
		}
		public function select_products($maximum, $minmum){
			$this->db->limit($maximum,$minmum);
			$query=$this->db->get("product_details");
			if ($query->num_rows() > 0) {
				foreach($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
			return false;
		}
	}
?>
