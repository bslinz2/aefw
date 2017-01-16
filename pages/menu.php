<?php
$menu = [
	'search' => 'Suche',
	'insert-drama' => 'Stück erfassen',
];
?>

<nav class="navbar navbar-default">
	<div class="container">
		<div class="navbar-header">
	      	<a class="navbar-brand" href="?page=index">
		        Frederic Köberl
	      	</a>
	    </div>
		<div class="navbar-collapse">
			<ul class="nav navbar-nav">
				<?php foreach($menu as $slug => $name): ?>
					<li>
						<a href="?page=<?php echo $slug ?>">
							<?php echo $name ?>
						</a>
					</li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</nav>

<style type="text/css">
	.navbar {
		border-radius: 0 !important;
	}
</style>