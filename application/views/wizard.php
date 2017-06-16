<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title; ?></title>
        <link rel="stylesheet" type = "text/css" href="/page/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/page/assets/css/jquery-ui.min.css"></link>
        <link rel="stylesheet" href="/page/assets/css/jquery-ui.theme.min.css"></link> 
        <link rel="stylesheet" type="text/css" href="/page/assets/font-awesome/css/font-awesome.css"></link>
        <style>
            body,h1,h2,h3,h4,h5,h6 {font-family: "Raleway", Arial, Helvetica, sans-serif}
            .myLink {display: none}
        </style>

    </head>
    <body>
    	<div class="container container-fluid">
			<form id="example-advanced-form" action="#">
			    <h3>Account</h3>
			    <fieldset>
			        <legend>Account Information</legend>
			 
			        <label for="userName-2">User name *</label>
			        <input id="userName-2" name="userName" type="text" class="required">
			        <label for="password-2">Password *</label>
			        <input id="password-2" name="password" type="text" class="required">
			        <label for="confirm-2">Confirm Password *</label>
			        <input id="confirm-2" name="confirm" type="text" class="required">
			        <p>(*) Mandatory</p>
			    </fieldset>
			 
			    <h3>Profile</h3>
			    <fieldset>
			        <legend>Profile Information</legend>
			 
			        <label for="name-2">First name *</label>
			        <input id="name-2" name="name" type="text" class="required">
			        <label for="surname-2">Last name *</label>
			        <input id="surname-2" name="surname" type="text" class="required">
			        <label for="email-2">Email *</label>
			        <input id="email-2" name="email" type="text" class="required email">
			        <label for="address-2">Address</label>
			        <input id="address-2" name="address" type="text">
			        <label for="age-2">Age (The warning step will show up if age is less than 18) *</label>
			        <input id="age-2" name="age" type="text" class="required number">
			        <p>(*) Mandatory</p>
			    </fieldset>
			 
			    <h3>Warning</h3>
			    <fieldset>
			        <legend>You are to young</legend>
			 
			        <p>Please go away ;-)</p>
			    </fieldset>
			 
			    <h3>Finish</h3>
			    <fieldset>
			        <legend>Terms and Conditions</legend>
			 
			        <input id="acceptTerms-2" name="acceptTerms" type="checkbox" class="required"> <label for="acceptTerms-2">I agree with the Terms and Conditions.</label>
			    </fieldset>
			</form>
		</div>
		<script src="/page/assets/js/jquery-1.12.3.js"></script>
        <script type="text/javascript" src="/page/assets/jqueryui/jquery-ui.min.js"></script> 
        <script type="text/javascript" src="/page/assets/js/jquery.steps.js"></script>
        <script type="text/javascript" src='/page/assets/js/plugins/slimscroll/jquery.slimscroll.min.js'></script>
        <script type= "text/javascript" src="/page/assets/js/jquery.dataTables.min.js"></script>

        <script src="/page/assets/jqueryui/jquery-ui.min.js"></script>
        <script src="/page/assets/js/bootstrap.min.js"></script>
        <script src="/page/assets/js/customer.js"></script>
        <script type="text/javascript" src="/page/assets/js/wizard.js"></script>
	</body>
</html>

mail.machakosinvest.com