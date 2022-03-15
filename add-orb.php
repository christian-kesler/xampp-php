<?php 

	include('config/db_connect.php');

	$email = $title = $spells = '';
	$errors = array('email' => '', 'title' => '', 'spells' => '');

	if(isset($_POST['submit'])){

		// check email
		if(empty($_POST['email'])){
			$errors['email'] = 'An email is required <br />';
		} else{
			$email = $_POST['email'];
			if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
				$errors['email'] = 'Email must be a valid email address <br />';
			}
		}

		// check title
		if(empty($_POST['title'])){
			$errors['title'] = 'A title is required <br />';
		} else{
			$title = $_POST['title'];
			if(!preg_match('/^[a-zA-Z\s]+$/', $title)){
				$errors['title'] =  'Title must be letters and spaces only <br />';
			}
		}

		// check spells
		if(empty($_POST['spells'])){
			$errors['spells'] = 'At least one spell is required <br />';
		} else{
			$spells = $_POST['spells'];
			if(!preg_match('/^([a-zA-Z\s]+)(,\s*[a-zA-Z\s]*)*$/', $spells)){
				$errors['spells'] =  'Spells must be a comma separated list <br />';
			}
		}

		if(array_filter($errors)) {
			// echo 'there are errors in the form';
		} else {

			$email = mysqli_real_escape_string($conn, $_POST['email']);
			$title = mysqli_real_escape_string($conn, $_POST['title']);
			$spells = mysqli_real_escape_string($conn, $_POST['spells']);

			// sql
			$sql = "INSERT INTO orbs(title,email,spells) VALUES('$title', '$email', '$spells')";

			// save to db and check
			if(mysqli_query($conn, $sql)) {
				// success
			} else {
				// error
				echo 'query error: ' . mysqli_error($conn);
			}

			// echo 'form is valid';
			header('Location: index.php');

		}

	} // end of POST check
?>

<!DOCTYPE html>
<html>
	
	<?php include('resources\populated-header.php'); ?>

	<section class="container grey-text">
		<h4 class="center">Add an Orb</h4>
		<form class="white" action="add-orb.php" method="POST">
			<label>Your Email:</label>
			<input type="text" name="email" value="<?php echo htmlspecialchars($email) ?>">
			<div class="red-text"><?php echo $errors['email']; ?></div>

			<label>Orb Title:</label>
			<input type="text" name="title" value="<?php echo htmlspecialchars($title) ?>">
			<div class="red-text"><?php echo $errors['title']; ?></div>

			<label>Known Spells:</label>
			<input type="text" name="spells" value="<?php echo htmlspecialchars($spells) ?>">
			<div class="red-text"><?php echo $errors['spells']; ?></div>

			<div class="center">
				<input type="submit" name="submit" value="Submit" class="btn brand z-depth-0">
			</div>
		</form>
	</section>

	<?php include('resources\populated-footer.php'); ?>

</html>
