<?php 

	// connect to database
	$conn = mysqli_connect('localhost', 'root', '', 'orb-catalog');

	if(!$conn) {
		echo 'Connection error: ' . mysqli_connect_error();
	}

?>