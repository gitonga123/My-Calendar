<?php 
	
	$con = mysqli_connect("127.0.0.1","root","pass","your_database");
	if($con){
		echo "Connection Established";
	}else{
	 	$dan = mysqli_connect("127.0.0.1", "root", "daniel123", "kiambu_edams");
		if($dan){
			echo "Connection Satisfied";
		}else{
			echo "Nothing can be done about";	
		}
	}
?>
