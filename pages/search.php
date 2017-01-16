<h1>Suche</h1>

<?php

$title = isset($_GET['title']) ? $_GET['title'] : '';
$sqlTitle = '%' . $title . '%';


$sql = 'SELECT
			drama.dra_name as name,
			genre.gen_name as genre,
			person.per_vorname as firstname,
			person.per_nachname as surname,
		    tmp.eve_termin as firstDate
		FROM drama
			INNER JOIN person ON drama.author_id = person.per_id
			INNER JOIN genre ON drama.gen_id = genre.gen_id
		    INNER JOIN (
		    	SELECT dra_id, eve_termin FROM event
				ORDER BY eve_termin ASC
		    ) as tmp ON tmp.dra_id = drama.dra_id
		WHERE drama.dra_name LIKE ?';
$stmt = $connection->prepare($sql);
if(!$stmt) {
	throw new Exception('Ein Fehler bei der Suche aufgetreten!');
}

$stmt->bind_param('s', $sqlTitle);
$stmt->execute();

$result = $stmt->get_result();
$rows = $result->fetch_all(MYSQLI_ASSOC);

?>

<form method="GET">
	<div class="form-group">
		<label for="title">Title des gesuchten Stückes</label>

		<input type="text" class="form-control" name="title" value="<?php echo htmlentities($title) ?>" />
	</div>

	<button type="submit" class="btn btn-primary btn-block">
		Suche starten
	</button>
	<input type="hidden" value="search" name="page" />
</form>

<hr />

<h2>Ergebnisse</h2>

<?php if(count($rows) < 1): ?>
	<div class="alert alert-danger" role="alert">
		Es wurde keine Suchergebnisse gefunden!
	</div>
<?php else: ?>
	<table class="table">
		<thead>
			<tr>
				<th>Drama</th>
				<th>Genre</th>
				<th>Author</th>
				<th>Erstaufführungsdatum</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($rows as $row): ?>
				<tr>
					<td><?php echo htmlentities($row['name']) ?></td>
					<td><?php echo htmlentities($row['genre']) ?></td>
					<td>
						<?php echo htmlentities($row['firstname']) ?>
						<?php echo htmlentities($row['surname']) ?>
					</td>
					<td>
						<?php echo date('d.m.Y', strtotime($row['firstDate'])) ?>
					</td>
				</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
<?php endif; ?>