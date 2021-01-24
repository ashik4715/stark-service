<?php 
  session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/x-png" href="https://www.stark-service.de/wp-content/themes/stark/images/favicon.ico">
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
	<link rel="stylesheet" href="css/style.css">
	<script href="js/main.js"></script>
	<title>Stark Service</title>
</head>
<body>
	<?php 
		if(isset($_SESSION['email']) && !empty($_SESSION['email'])) 
		{
			echo '<div class="alert alert-info">Welcome '. $_SESSION['email'] .' Gebruikersregistratie succesvol.</div>';
			echo '<br> <a class="btn btn-danger" href="logout.php">Abmeldung</a>';
		}else{
			echo '<div class="alert alert-info">Sie sind nicht eingeloggt. <a class="btn btn-info" href="login.php">Anmelden</a> </div>';
		}
	?>
</body>
</html>