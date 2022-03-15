<?php


	include('config/db_connect.php');

	// write query for all orbs
	$sql = 'SELECT title, spells, id FROM orbs ORDER BY date_created';

	// make query
	$result = mysqli_query($conn, $sql);

	// fetch resulting rows as array
	$orbs = mysqli_fetch_all($result, MYSQLI_ASSOC);

	// free result from memory
	mysqli_free_result($result);

	// close connection
	mysqli_close($conn);

	// explode(',', $orbs[3]['spells']);
	
?>

<!DOCTYPE html>
<html>
<head>
	<title>PHP Tutorials</title>
</head>
<body>

	<?php include('resources\templates\populated-header.php'); ?>

	<h4 class="center grey-text">All Orbs in Catalog</h4>

	<div class="container">
		<div class="row">

			<?php foreach($orbs as $orb): ?>

				<div class="col s6 md3">
					<div class="card z-depth-0">
						<div class="card-content center">
							<h6><?php echo htmlspecialchars($orb['title']); ?></h6>
							<ul>
								<?php foreach(explode(',', $orb['spells']) as $spell): ?>
									<li>
										<?php echo htmlspecialchars($spell); ?>
									</li>
								<?php endforeach ?>
							</ul>
						</div>
						<div class="card-action right-align">
							<a class="brand-text" href="#">more info</a>
						</div>
					</div>
				</div>

			<?php endforeach ?>

		</div>
	</div>

	<?php include('resources\templates\populated-footer.php'); ?>

</body>
</html>
