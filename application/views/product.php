<!DOCTYPE html>
<html>
<head>
	<script src="http://localhost/page/assets/js/jquery-1.12.3.js"></script>
    <script src="http://localhost/page/assets/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type = "text/css" href="http://localhost/page/assets/css/bootstrap.min.css">
</head>
<body>
	<div class="containter">
		<div class="row">
			<div class="col-sm-8">	
                            <div id="body">
                            <h3>Product Pagination</h3>
					
                                    <?php echo $this->table->generate($products); ?>
                            <?php echo $this->pagination->create_links();?>
                            </div>  
                            <p class="footer">Page Rendered in <strong>{elapsed_time} seconds</strong></p>
			</div>
		</div>
	</div>
</body>
</html>