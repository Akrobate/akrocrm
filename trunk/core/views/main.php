<html>
	<head>
		<meta charset="utf-8">
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">

		<!-- Optional theme -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap-theme.min.css">

	 <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

		<!-- Latest compiled and minified JavaScript -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
		 <script src="bootstrap/js/bootstrap-datepicker.js"></script>
 		<link rel="stylesheet" href="bootstrap/css/datepicker.css">
		 <script src="bootstrap/js/bootstrap-timepicker.js"></script>
 		<link rel="stylesheet" href="bootstrap/css/bootstrap-timepicker.css">
		 
		<? foreach($headers as $ress): ?>
			<script src="<?=$ress ?>"></script>
		<? endforeach; ?>
		<script>
		</script>
	</head>
	
	<body role="document">
		
		<!--?=$content->render();?-->
		<?=$contentSTR;?>
	</body>
	
</html>
