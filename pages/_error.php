<?php

// Definierung der Fehlermeldungen
$errorTypes = [
	404 => 'Seite wurde nicht gefunden!',
	500 => 'Es ist ein Fehler aufgereten!',
];

// Die globale Variable $showErrorMessages wird in den jetzigen Scope geholt 
global $showErrorMessages;

?>

<?php if (isset($exeption)): ?>


	<?php $pageTitle = $errorTypes[500]; ?>
	<h1>
		<?php echo $errorTypes[500] ?>
	</h1>
	<?php if ($showErrorMessages): ?>
		<p>
			<?php echo $exeption->getMessage(); ?>
		</p>
	<?php endif; ?>


<?php else: ?>


	<?php $pageTitle = $errorTypes[404]; ?>
	<h1>
		<?php echo $errorTypes[404]; ?>
	</h1>


<?php endif; ?>