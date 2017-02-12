<!DOCTYPE html>
<html>
<head>
	<title><?php echo $layoutPageTitle ?></title>
	<link rel="stylesheet" href="css/bootstrap.min.css" />
	<link rel="stylesheet" href="css/bootstrap-flatty.min.css" />
	<link rel="stylesheet" href="style.css">
</head>
<body>
	<?php include $menuPagePath; ?>
	<div class="container">
		<?php echo $content ?>
	</div>
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>