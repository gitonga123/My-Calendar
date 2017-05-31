<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require_once ("vendor/phpoffice/phpexcel/Classes/PHPExcel.php");
require_once APPPATH."third_party/PHPExcel.php";

/**
* Excel Library
*/
class Excel extends PHPExcel
{
	
	function __construct()
	{
		parent::__construct();
	}
}

?>