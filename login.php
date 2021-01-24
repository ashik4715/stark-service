<?php
  session_start();
  $servername = "localhost";
  $dbusername = "root";
  $dbpassword = "";
  $dbname = "stark";

  $errors = array();
  
  // mit der Datenbank verbinden
  $db = new mysqli($servername, $dbusername, $dbpassword, $dbname);

  // Anmelden USER
  if (isset($_POST['login_user'])) 
  {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);

    if (empty($email)) {
      array_push($errors, "Email-Adresse ist erforderlich");
    }
    if (empty($password)) {
      array_push($errors, "Passwort ist erforderlich");
    }

    if (count($errors) == 0) {
      $password = md5($password);
      $query = "SELECT * FROM `tblusers` WHERE email='$email' AND password='$password'";
      $results = mysqli_query($db, $query);
      if (mysqli_num_rows($results) == 1){
        $_SESSION["email"] = $email;
        header('location: index.php');
      }
      else{
        array_push($errors, "Falsche E-Mail- oder Passwort-Kombination!");
      }
    }
  }
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
	
  <section>
  <div class="d-flex justify-content-center align-items-center mt-3">
    <div class="card">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item text-center"> <a class="nav-link active btl" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">Anmelden</a> </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">	  
              <form method="post" action="login.php"> 
              <div class="form px-4"> 
                <input type="text" name="email" class="form-control" placeholder="E-Mail Adresse"> 
                <br>
                <input type="password" name="password" class="form-control" placeholder="Passwort"> 
                <button type="submit" class="btn btn-block btn-success" name="login_user">Anmelden</button>
                <br>
                <p>Sie haben noch kein Konto? <a href="register.php">Anmeldung</a></p> 
              </div>
              </form>
            </div>            
        </div>
    </div>
  </div>
  </section>
  <br>
  <div class="footer">
   	<div class="container">
		<?php include('errors.php') ?>
	</div>
  </div>
</body>
</html>