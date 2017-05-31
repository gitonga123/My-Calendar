<?php
	require_once "vendor/autoload.php";
 
	$fileName = "output.xlsx";
	 
	/** automatically detect the correct reader to load for this file type */
	$excelReader = PHPExcel_IOFactory::createReaderForFile($fileName);
	 
	/** Create a reader by explicitly setting the file type.
	// $inputFileType = 'Excel5';
	// $inputFileType = 'Excel2007';
	// $inputFileType = 'Excel2003XML';
	// $inputFileType = 'OOCalc';
	// $inputFileType = 'SYLK';
	// $inputFileType = 'Gnumeric';
	// $inputFileType = 'CSV';
	$excelReader = PHPExcel_IOFactory::createReader($inputFileType);
	*/

	$file = './output.xlsx';
 
//load the excel library
$this->load->library('excel');
 
//read file from path
$objPHPExcel = PHPExcel_IOFactory::load($file);
 
//get only the Cell Collection
$cell_collection = $objPHPExcel->getActiveSheet()->getCellCollection();
 
//extract to a PHP readable array format
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
- See more at: https://arjunphp.com/how-to-use-phpexcel-with-codeigniter/#sthash.jpYEiO1i.dpuf
?>