<?php $pageTitle = 'Startseite'; ?>

<h1>Index</h1>
<h2>last 20 tracks</h2>
<?php

$tracks = DB::query('SELECT * FROM tracks WHERE id IN(?, ?, ?) ORDER BY id DESC LIMIT 20', 'iii', 1000, 2000, 3000);

?>

<div class="table-responsive">
	<table class="table table-striped">
	<thead>
			<tr>
				<td>id</td>
				<td>artist</td>
				<td>title</td>
				<td>station_id</td>
				<td>created_at</td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($tracks as $track): ?>
				<tr>
					<td><?php echo e($track->id) ?></td>
					<td><?php echo e($track->artist) ?></td>
					<td><?php echo e($track->title) ?></td>
					<td><?php echo e($track->station_id) ?></td>
					<td><?php echo e($track->created_at) ?></td>
				</tr>
			<?php endforeach ?>
			
		</tbody>
	</table>
</div>