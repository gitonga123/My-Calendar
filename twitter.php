<?php 
	
	$url = "https://2a9c1eba-2138-48c7-a5b3-d926501a67c6:VbMN8883ci@cdeservice.mybluemix.net:443/api/v1/messages/search?q=msetoTamu";
	$ch = curl_init($url);
	$data = array();
	if($ch){
		curl_setopt($ch, CURLOPT_TIMEOUT, 30);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,30);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		
		$data = curl_exec($ch);
		echo $data;
		curl_close($ch);
	}

	if (!empty($data)) {
		echo"<br /><h2 style='color:red;text-decorate:underline'>Display The Users via The Api</h2>";
		echo "<link href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' rel='stylesheet'";
		echo "<script src = 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script";
		echo "<script src = 'http://code.jquery.com/jquery-1.11.3.js'></script";

		//echo $data;
		$result = json_decode($data,true);
		// print_r($result);

		// print_r($result);
		// foreach ($result as $key => $value) {
		// 	foreach ($value as $keys => $values) {
		// 		// echo $values['author'];

		// 		print_r($values);
		// 	}
		// }
	}else{
		echo "<p alert alert-info>Data with such Tweets can not be located</p>";
	}



	// 	// /echo $data;
	// 	echo"<br /><h2 style='color:red;text-decorate:underline'>Display The Users via The Api</h2>";
	// 	echo "<link href='css/bootstrap.min.css' rel='stylesheet'";
	// 	echo "<script src = 'js/bootstrap.min.js'></script";
	// 	echo "<script src = 'jquery-1.12.0.min.js'></script";
		
	// 	$result = json_decode($data, true);
	// 	if ($result) {
	// 		echo "<fieldset class='scheduler-border'>
	// 		<legend class='scheduler-border'>Displaying All users</legend>";
	// 		$total = count($result);
	// 		//echo "<div class='alert alert-info'>";
	// 		//echo "<p>Total Number of users = ";
	// 		//echo sizeof($result). "</p></div>";
	// 		echo "<div class='container'>";
	// 		echo "<div class='table'>";
	// 		echo "<table class='table table-bordered'><tr><th>Name</th><th>ID</th>
	// 		<th>HREF</th</tr><tr>";
			
			
	// 		foreach ($result as $key => $value) {
	// 			if (!is_array($value)) {
	// 				echo $key. '=>' . $value . '<br/>';
	// 			}else{
	// 				foreach ($result['users'] as $value) {
	// 					echo '<td>'. $value['name']. "</td>".
	// 					'<td>'. $value['id']. "</td>".
	// 					'<td><a href="'.$value['href'].'.json'.'">  
	// 					<button type="button" class="btn btn-default">More details</button></td></tr>';
							
	// 				}
	// 			}
				
				
	// 								}
	// 								echo "</div></div></table>";
	// 								echo "</fieldset>";
	// 	}else{
	// 		echo "Pull up your socks";
	// 	}
	// } else{
	// 	echo "Not Enable";
	// 	}
?>