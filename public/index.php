<?php /*
	von Frederic Köberl
	4aITI - 11.01.2017
*/ ?>
<!DOCTYPE html>
<html>
<head>
	<title>Frederic Köberl's yolo swag</title>
	<link href="css/style.css" rel="stylesheet" />
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap-flatty.min.css" rel="stylesheet" />
</head>
<body>
	<?php include '../pages/menu.php' ?>
	<div class="container">
		<?php
		$errorPagePath = '../pages/error.php';

		try {
			include '../database.php'; 
			
			$page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 'index';
			$pagePath = '../pages/' . $page . '.php';
			
			if(file_exists($pagePath)) {
				include $pagePath;
			} else {
				include $errorPagePath;
			}
		} catch(Exception $exeption) {
			include $errorPagePath;
		}
		?>
	</div>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
