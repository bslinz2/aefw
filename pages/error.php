<?php if(isset($exeption)): ?>
	<h1>Es ist ein Fehler aufgereten!</h1>
	<p><?php echo $exeption->getMessage(); ?></p>
<?php else: ?>
	<h1>Seite wurde nicht gefunden!</h1>
<?php endif; ?>