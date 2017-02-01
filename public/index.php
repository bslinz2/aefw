<!DOCTYPE html>
<html>
<head>
	<title>Layout</title>
	<link href="css/style.css" rel="stylesheet" />
	<link href="css/bootstrap.min.css" rel="stylesheet" />
	<link href="css/bootstrap-flatty.min.css" rel="stylesheet" />
</head>
<body>
	<?php include '../pages/menu.php' ?>
	<div class="container">
		<?php
		$errorPage = '../pages/error.php';

		try {
			include '../classes/database.php';
			
			$page = isset($_GET['page']) && !empty($_GET['page']) ? $_GET['page'] : 'index';
			$page = '../pages/' . $page . '.php';
			
			if(file_exists($page)) {
				include $page;
			} else {
				include $errorPage;
			}
		} catch(Exception $exeption) {
			include $errorPage;
		}
		?>
	</div>
	<script src="js/bootstrap.min.js"></script>
</body>
</html>
