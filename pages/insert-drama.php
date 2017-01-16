<h1>Stück erfassen</h1>

<?php

$query = 'SELECT DISTINCT per_id as id, per_vorname as firstname, per_nachname as surname FROM person INNER JOIN drama ON person.per_id = drama.author_id'; 
$stmt = $connection->prepare($query); 
if(!$stmt) {
	throw new Exception('Ein Fehler beim Schauspieler der Gernes ist aufgetreten!');
}
$stmt->execute();
$result = $stmt->get_result();
$authors = $result->fetch_all(MYSQLI_ASSOC);


$query = 'SELECT gen_id as id, gen_name as name FROM genre'; 
$stmt = $connection->prepare($query); 
if(!$stmt) {
	throw new Exception('Ein Fehler beim Holen der Gernes ist aufgetreten!');
}
$stmt->execute();
$result = $stmt->get_result();
$gernes = $result->fetch_all(MYSQLI_ASSOC);


$executed = false;
if(isset($_POST['save'])) {
	$executed = true;
	$sql = 'INSERT INTO drama (dra_name, gen_id, author_id) VALUES (?, ?, ?);';
    $stmt = $connection->prepare($sql);
    if(!$stmt) {
    	throw new Exception('Ein Fehler beim Speichern des Dramas ist aufgetreten!');
    }
    $stmt->bind_param('sii',
        $_POST['dra_name'],
        $_POST['gen_id'],
        $_POST['author_id']
    );

    $stmt->execute();
    $draId = $stmt->insert_id;

    if($draId > 0) {
    	$sql = 'INSERT INTO event (eve_termin, dra_id) VALUES (?, ?);';
	    $stmt = $connection->prepare($sql);
	    if(!$stmt) {
	    	throw new Exception('Ein Fehler beim Speichern des ersten Events ist aufgetreten!');
	    }
	    $stmt->bind_param('si',
	        $_POST['eve_termin'],
	       	$draId
	    );
	    $stmt->execute();
    }    
}

?>

<?php if($executed && $draId < 1): ?>
	<div class="alert alert-danger">
		Das hinufügen der Daten in die Datenbank war nicht erfolgereich. Der Titel muss eindeutig sein!
	</div>
<?php endif; ?>

<?php if($executed && $draId > 1): ?>
	<div class="alert alert-success">
		Das hinufügen der Daten in die Datenbank war erfolgereich!
	</div>
<?php endif; ?>

<form method="POST">

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="dra_name">Titel</label>

				<input type="text" name="dra_name" class="form-control" required />
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="author_id">Author</label>

				<select name="author_id" class="form-control" required>
					<?php foreach($authors as $author): ?>
						<option value="<?php echo htmlentities($author['id']) ?>">
							<?php echo htmlentities($author['firstname']) ?>
							<?php echo htmlentities($author['surname']) ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-sm-6">
			<div class="form-group">
				<label for="gen_id">Gerne</label>

				<select name="gen_id" class="form-control" required>
					<?php foreach($gernes as $gerne): ?>
						<option value="<?php echo htmlentities($gerne['id']) ?>">
							<?php echo htmlentities($gerne['name']) ?>
						</option>
					<?php endforeach; ?>
				</select>
			</div>
		</div>
		<div class="col-sm-6">
			<div class="form-group">
				<label for="eve_termin">Erstaufführung</label>
				
				<input type="date" name="eve_termin" class="form-control" required />
			</div>
		</div>
	</div>

	<button type="submit" name="save" class="btn btn-primary btn-lg btn-block">Speichern</button>

</form>