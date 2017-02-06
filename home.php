<?php 

	$timestamp = (isset($_GET['t'])) ? $_GET['t'] : time();

	list($month,$day,$year) = explode('/', date('m/d/Y',$timestamp));
	echo $year;
	$first_day_of_month = date('w',mktime(0,0,0,$month,1,$year));
	$total_days = date('t',$timestamp);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
</head>
<body>
	<table>
		<tr>
			<th>Sun</th>
			<th>Mon</th>
			<th>Tue</th>
			<th>Wed</th>
			<th>Thur</th>
			<th>Fri</th>
			<th>Sat</th>
		</tr>
		<?php 
			$current = 1;
			while ($current <= $total_days) {
				echo "<tr>";
				for ($i=0; $i < 7; $i++) { 
						if (($current == 1 && $i < $first_day_of_month) || ($current > $total_days)) {
							echo "<td>&nbsp</td>";
							continue;
						}
						echo '<td>' . $current.'</td>';
						$current +=1;
				}
				echo "</tr>";		
			}
		?>
	</table>
</body>
</html>