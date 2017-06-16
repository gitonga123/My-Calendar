<!DOCTYPE html>
<html>
<body>

	<!-- // $halftime = array();
	// $split_results = array();
	// $results = array('1-1','1-3','1-1','0-0');
	// $gg = 0;
	// $ng = 0;
	// foreach($results as $key => $value) {
	// 	// echo $value . "<br />";
	// 	$split_results = explode('-', $value);
	// 	if(in_array(0, $split_results)){
	// 		$ng += 1;
	// 	}else{
	// 		$gg +=1;
	// 	}

	// 	$halftime= array('GG' => $gg, 'NG' => $ng);
	// }

	// if($halftime['GG'] > $halftime['NG']){
	// 	echo "Percentage Win";

	// 	$prediction = "GG";
	// 	$precentage_win = number_format((($halftime['GG']/count($results))*100),2). '%';

	// 	$halftime ['prediction']= $prediction;

	// 	$halftime ['percentage_win']= $precentage_win;
	// }elseif ($halftime['GG'] == $halftime['NG']) {
	// 	echo "Percentage Win";

	// 	$prediction = "GG/NG";
	// 	$precentage_win = number_format((($halftime['GG']/count($results))*100),2). '%';

	// 	$halftime ['prediction']= $prediction;

	// 	$halftime ['percentage_win']= $precentage_win;
	// }else{
	// 	echo "Percentage Win";

	// 	$prediction = "NG";
	// 	$precentage_win = number_format((($halftime['NG']/count($results))*100),2). '%';

	// 	$halftime ['prediction']= $prediction;

	// 	$halftime ['percentage_win']= $precentage_win;
	// }
	// print_r($halftime);

	


	#$halftime = explode('-', $resultht);


	// $halftime_counted_values =(array_count_values($halftime));

	// print_r(get_over_under($halftime_counted_values,'fulltime'));

	// function sum($array1){
	// 	$total = 0;
	// 	$array = array();
	// 	for ($i=0; $i < sizeof($array1); $i++) { 
	// 			$total = $total + $array1[$i];
	// 	}

	// 	return $total;	
	// }

	// function get_over_under($array,$period){
	// 	print_r($array);
	// 	if(is_array($array) && $period ==='halftime'){
	// 		$low = 1;
	// 		$lower = 0;
	// 		$determine_under =0;
	// 		$determine_over = 0;
	// 		$get_average_low = 0;
	// 		$get_average_high = 0;
	// 		foreach ($array as $key => $value) {
	// 			if($key <= $low){
	// 				$get_average_low += $value ;
	// 				$determine_under += $value;
	// 			}else{
	// 				$get_average_high += $value;
	// 				$determine_over += $value;
	// 			}
	// 		}

	// 		$denominator = $get_average_low + $get_average_high;
	// 		if($determine_over > $determine_under){

	// 			$precentage_win = $get_average_high / $denominator * 100;

	// 			$conclusion  = array("Over 1.5",number_format($precentage_win,2),$get_average_low, $get_average_high);
	// 			return $conclusion;
	// 		}elseif($determine_over == $determine_under){

	// 			$precentage_win = $get_average_high / $denominator * 100;

	// 			$conclusion  = array("Over 1.5/Under 1.5",number_format($precentage_win,2).'%',$get_average_low, $get_average_high);
	// 			return $conclusion;
	// 		}
	// 		else{
	// 			$precentage_win = $get_average_low / $denominator * 100;
	// 			$conclusion  = array("Under 1.5",number_format($precentage_win,2),$get_average_low, $get_average_high);
	// 			return $conclusion;
	// 		}
	// 	}

	// 	if(is_array($array) && $period ==='fulltime'){
	// 		$low = 3;
	// 		$lower = 0;
	// 		$get_average_low = 0;
	// 		$get_average_high = 0;
	// 		$determine_under =0;
	// 		$determine_over = 0;
	// 		foreach ($array as $key => $value) {
	// 			if($key >= $low){
	// 				$get_average_high += $value ;
	// 				$determine_over += $value;
	// 			}else{
	// 				$get_average_low += $value;
	// 				$determine_under += $value;
	// 			}
	// 		}

	// 		print_r(array("High" => $determine_over,"Low" => $determine_under));
	// 		$denominator = $get_average_low + $get_average_high;
	// 		if($determine_over > $determine_under){

	// 			$precentage_win = $get_average_high / $denominator * 100;

	// 			$conclusion  = array("Over 2.5",number_format($precentage_win,2).'%',$get_average_low, $get_average_high);
	// 			return $conclusion;
	// 		}elseif($determine_over == $determine_under){

	// 			$precentage_win = $get_average_high / $denominator * 100;

	// 			$conclusion  = array("Over 2.5/Under 2.5",number_format($precentage_win,2).'%',$get_average_low, $get_average_high);
	// 			return $conclusion;
	// 		}
	// 		else{
	// 			echo $get_average_low;
	// 			$precentage_win = $get_average_low / $denominator * 100;
	// 			$conclusion  = array("Under 2.5",number_format($precentage_win,2).'%',$get_average_low, $get_average_high);
	// 			return $conclusion;
	// 		}
	// 	}
	// } -->

<?php
$a=array(100,"red","10.00%","Daniel");
echo array_search("red",$a);
?>

</body>
</html>