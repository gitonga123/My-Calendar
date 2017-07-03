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
        <a href="/page/mark/inner_details" class="btn btn-default"><i class="fa fa-database"> </i> Outer Inter</a>
        <div style="padding-bottom: 1%"></div>
        <div class="page-header">
		  <h1>System Settings</h1>

		  <div class="user_error" id="entry_error">
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
						echo "<input type='hidden' id='id_common' value='" . $id_common . "' />" ;
					?>
					
				</div>

				<div class="col-md-2">
					<button class="btn btn-primary btn-md" id='sendupdate'>
						Send
					</button>
				</div>
			</div>
            <hr>
            <div class="col-md-12"> 
                <div class="col-md-7">
                    <div class="form-group">
                         <div >
                            <h4 style="font-family: 'Comic Sans MS', cursive, sans-serif">Table + Inner Details</h4> 
                            <p style="font-size: 10px">The Major Table Linked With the inner Details of a match</p> 
                          </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <?php  
                        echo "<input type='text' name='field_value' value='{$table_choice}' class='form-control' id='table_choice'/>";
                        echo "<input type='hidden' id='id_table' value='" . $id_table . "' />" ;
                    ?>
                    
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary btn-md" id='tableupdate'>
                        Send
                    </button>
                </div>
            </div>

            <hr>
            <div class="col-md-12"> 
                <div class="col-md-7">
                    <div class="form-group">
                         <div >
                            <h4 style="font-family: 'Comic Sans MS', cursive, sans-serif">Date of Choice</h4> 
                            <p style="font-size: 10px">The Preferred Date of Choice to match Major Table Details with Inner Details</p> 
                          </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <?php  
                        echo "<input type='text' name='field_value' value='{$date_choice}' class='form-control' id='date_choice'/>";
                        echo "<input type='hidden' id='id_date' value='" . $id_date . "' />" ;
                    ?>
                    
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary btn-md" id='dateupdate'>
                        Send
                    </button>
                </div>
            </div>

            <hr>
            <div class="col-md-12"> 
                <div class="col-md-7">
                    <div class="form-group">
                         <div >
                            <h4 style="font-family: 'Comic Sans MS', cursive, sans-serif">Todays Date</h4> 
                            <p style="font-size: 10px">The Date To which updates are being made</p> 
                          </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <?php  
                        echo "<input type='text' name='field_value' value='{$date2_choice}' class='form-control' id='date2_choice'/>";
                        echo "<input type='hidden' id='id_date2' value='" . $id_date2 . "' />" ;
                    ?>
                    
                </div>

                <div class="col-md-2">
                    <button class="btn btn-primary btn-md" id='date2update'>
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
                
                var id = $("#id_common").val();
                var field_value = $("#most_common").val();

                if(Number.isInteger(parseInt(field_value))){
                    var srvRqst = $.ajax({
                    url: '/page/mark/settings_update',
                    type: 'post',
                    data: {id: id, field_value: field_value},
                    datatype: 'text',
                    });

                    srvRqst.done(function (response) { 
                        $('div.user_error').html(response);
                        location.reload();
                    }); 
                }else{
                    $("#most_common").css('border','solid 1px red');
                    document.getElementById("entry_error").innerHTML="The Value Should Be An Integer 1-10";
                }

                // console.log(field_value);
                  
            });

            $("#tableupdate").click(function () {
                
                var id = $("#id_table").val();
                var field_value = $("#table_choice").val();
                if(field_value ==="TABLE2" || field_value ==="TABLE3"){
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
                }else{
                    $("#table_choice").css('border','solid 1px red');
                    document.getElementById("entry_error").innerHTML="There Only Two Major Tables";
                }     
            });

            $("#dateupdate").click(function () {
                
                var id = $("#id_date").val();
                var field_value = $("#date_choice").val();

                if(field_value.includes("/")){
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
                }else{
                    $("#date_choice").css('border','solid 1px red');
                    document.getElementById("entry_error").innerHTML="Date Format 01/01/2001 or 01/01/01";  
                }   
            });

            $("#date2update").click(function () {
                
                var id = $("#id_date2").val();
                var field_value = $("#date2_choice").val();

                if(field_value.includes("/")){
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
                }else{
                    $("#date_choice").css('border','solid 1px red');
                    document.getElementById("entry_error").innerHTML="Date Format 01/01/2001 or 01/01/01";  
                }   
            });
        });
    </script>
</body>
</html>