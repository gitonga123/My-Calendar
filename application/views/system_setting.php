<?php
require_once('header.php');

?>
</head>
<body>
    <div class=" container container-fluid">
       <a href="/page/mark/lock" class="btn btn-default"><i class="fa fa-lock"></i> Lock</a>
       	<span style="margin-left: 5%"></span>
       	<a href="/page/make" class="btn btn-warning"><i class="fa fa-home"> </i> Home</a>
       	<span style="margin-left: 5%"></span>
       	<a href="/page/make/exact_search" class="btn btn-danger"><i class="fa fa-fast-backward"> </i> Back</a>
      	<span style="margin-left: 5%"></span>
        <a href="#" id="timeClock" class="btn btn-default"></a>
        <span style="margin-left: 5%"></span>
        <div style="padding-bottom: 1%"></div>
        <div class="page-header">
		  <h1>System Settings</h1>
		  <div class="user_error">
		  	
		  </div>
		</div>

		<div class="row">
			<div class="col-md-12"> 
				<div class="col-md-7">
					<div class="form-group">
						 <div >
						    <h4 style="font-family: 'Comic Sans MS', cursive, sans-serif">Majority Count</h4> 
						    <p style="font-size: 10px">This Setting describes the counts of a certain odd given the number of the repetition.</p> 
						  </div>
					</div>
				</div>

				<div class="col-md-3">
					<?php  
						echo "<input type='text' name='field_value' value='{$most_common}' class='form-control' id='most_common'/>";
						echo "<input type='hidden' id='id' value='" . $id . "' />" ;
					?>
					
				</div>

				<div class="col-md-2">
					<button class="btn btn-primary btn-md" id='sendupdate'>
						Send
					</button>
				</div>
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
    <script type="text/javascript">
    	$(document).ready(function () {
                $("#sendupdate").click(function () {
                    
                    var id = $("#id").val();
                    var field_value = $("#most_common").val();

                    console.log(id);

                    console.log(field_value);
                    var srvRqst = $.ajax({
                        url: '/page/mark/settings_update',
                        type: 'post',
                        data: {id: id, field_value: field_value},
                        datatype: 'text',
                     });

                    srvRqst.done(function (response) {
                        location.reload();
                        $('div.user_error').html(response);
                    });   
                });
        });
    </script>
</body>
</html>