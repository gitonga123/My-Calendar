<?php
require_once('header.php');
?>
	</head>
	<body>
	    <div class=" container container-fluid">
	        <div style="padding-bottom: 2%"></div>
	        <a href="/page/make" class="btn btn-info"><i class="fa fa-home"></i> Home </a>
	        <span style="margin-left: 5%"></span>
	        <a href="/page/make/add_result" class="btn btn-danger"><i class="fa fa-fast-forward"></i> Add / Ongeza</a>
	        <span style="margin-left: 5%"></span>
	        <a href="/page/make/search_area" class="btn btn-warning"><i class="fa fa-search"></i> Search</a>
	        <span style="margin-left: 5%"></span>
	        <a href="/page/make/update_result" class="btn btn-success"><i class="fa fa-database"> </i> Update Result</a>

	        <span style="margin-left: 5%"></span>
	        <a href="/page/make/summary" class="btn btn-info"><i class="fa fa-line-chart"> </i> Summary</a>

	        <span style="margin-left: 5%"></span>
	        <a href="/page/make/exact_search" class="btn btn-warning"><i class="fa fa-search"> </i> Exact Search</a>
	        <span style="margin-left: 5%"></span>
	        <a href="#" id="timeClock" class="btn btn-default"></a>
	        <span style="margin-left: 5%"></span>
	        <div style="padding-bottom: 1%"></div>
	        <a href="/page/make/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>
	        <span style="margin-left: 5%"></span>
	        <a href="#" id="" class="btn btn-info"><?php echo count($records). " Records"?></a>
	       
	        <div style="padding-bottom: 1%"></div>
	        <div class="row">
	        	<div class="col-lg-12">
	        		<table class="table table-hover" id="allrecords">
	        			<thead>
	        				<tr>
		        				<th>ID</th>
		        				<th>Team Name</th>
		        				<th>Home</th>
		        				<th>Draw</th>
		        				<th>Away</th>
		        				<th>Half</th>
		        				<th>Full</th>
		        				<th>Verdict</th>
		        				<th>League</th>
		        				<th>Time</th>
		        				<th>Date</th>
		        			</tr>
	        			</thead>
	        			<tbody>
	        				<?php
	        					foreach ($records as $key => $value) {
	        						echo "<tr>";
	        						echo "<td>{$value->id}</td>";
	        						echo "<td>{$value->team_name}</td>";
	        						echo "<td>{$value->home}</td>";
	        						echo "<td>{$value->draw}</td>";
	        						echo "<td>{$value->away}</td>";
	        						echo "<td>{$value->result_ht}</td>";
	        						echo "<td>{$value->result_ft}</td>";
	        						echo "<td>{$value->results}</td>";
	        						echo "<td>{$value->league}</td>";
	        						echo "<td>{$value->times}</td>";
	        						echo "<td>{$value->date}</td>";
	        						echo "</tr>";
	        					}
	        				?>
	        			</tbody>
	        		</table>
	        		
	        	</div>
	        </div>
	    </div>
	    <script src="/page/assets/js/jquery-1.12.3.js"></script>
	    <script type="text/javascript" src="/page/assets/jqueryui/jquery-ui.min.js"></script> 
	    <script type="text/javascript" src='/page/assets/js/plugins/slimscroll/jquery.slimscroll.min.js'></script>
	    <script type= "text/javascript" src="/page/assets/js/jquery.dataTables.min.js"></script>

	    <script src="/page/assets/jqueryui/jquery-ui.min.js"></script>
	    <script src="/page/assets/js/bootstrap.min.js"></script>
	    <script src="/page/assets/js/chart.min.js"></script>
	    <script src="/page/assets/js/customer.js"></script>
	    <script>
	    	 $(document).ready(function () {
	       		 $('#allrecords').DataTable();
	   		});
	    </script>
	</body>
</html>
