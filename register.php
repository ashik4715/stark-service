<?php
	$servername = "localhost";
    	$dbusername = "root";
    	$dbpassword = "";
	$dbname = "stark";
	
	/** 
	 * Variablen definieren und auf leere Werte setzen
 	*/
     $name = "";
     $age = "";
     $email = "";     
     $Newsletter = "0";
     $errors = array();

     // mit der Datenbank verbinden
	$db = new mysqli($servername, $dbusername, $dbpassword, $dbname);				

     // Anmeldung USER
     if (isset($_POST['reg_user'])) 
     {
          // alle Eingabewerte aus dem Formular empfangen
          $name = mysqli_real_escape_string($db, $_POST['name']);
          $email = mysqli_real_escape_string($db, $_POST['email']);
          $age = mysqli_real_escape_string($db, $_POST['age']);
          $password1 = mysqli_real_escape_string($db, $_POST['password1']);
          $password2 = mysqli_real_escape_string($db, $_POST['password2']);
          
          if(isset($_POST['Newsletter'])){
               $Newsletter = $_POST['Newsletter'];
          }         
          
          // Formularvalidierung: Sicherstellen, dass das Formular korrekt ausgefüllt ist ...
          // durch Hinzufügen (array_push()) entsprechender Fehler zum Array $errors
          if (empty($name)) 
          { 
               array_push($errors, "name ist erforderlich"); 
          }
          if (empty($email)) 
          { 
               array_push($errors, "Email-Adresse ist erforderlich"); 
          }
          if (empty($age)) 
          { 
               array_push($errors, "Alter ist erforderlich"); 
          }
          if (empty($password1)) 
          { 
               array_push($errors, "Passwort ist erforderlich"); 
          }
          if ($password1 != $password2) 
          {
               array_push($errors, "Die beiden Passwörter stimmen nicht überein");
          }
          
          // Überprüfen Sie zunächst die Datenbank, um sicherzustellen, dass 
          // nicht bereits ein Benutzer mit demselben Benutzernamen und/oder derselben E-Mail existiert
          $user_check_query = "SELECT * FROM `tblusers` WHERE email='$email' LIMIT 1";
          $result = mysqli_query($db, $user_check_query);
          $user = mysqli_fetch_assoc($result);
          
          if ($user) 
          { 
               // wenn Benutzer existiert
               if ($user['email'] === $email) 
               {
                    array_push($errors, "E-Mail Adresse ist bereits vorhanden!");
               }
          }
     
          // Benutzer registrieren, wenn keine Fehler aufgetreten sind
          if (count($errors) == 0) {
               //Verschlüsseln Sie das Kennwort vor dem Speichern in der Datenbank
               $password = md5($password1);
     
               $query = "INSERT INTO `tblusers`(`name`, `age`, `email`, `password`, `Newsletter`) 
                         VALUES('$name', '$age', '$email', '$password', '$Newsletter')";
               mysqli_query($db, $query);
               header('location: login.php');
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
              <form method="post" action="register.php"> 
              <div class="form px-4"> 
				<input type="text" name="name" class="form-control" placeholder="Vollständigen Namen"> 
				<input type="text" name="age" class="form-control" placeholder="Alter">
				<input type="text" name="email" class="form-control" placeholder="E-Mail Adresse">  
				<input type="password" name="password1" class="form-control" placeholder="Passwort">
				<input type="password" name="password2" class="form-control" placeholder="Passwort bestätigen">	                   
                    <div class="form-group form-check">
                         <input name="Newsletter" value="0" type="checkbox" class="form-check-input" id="exampleCheck1">
                         <label class="form-check-label" for="exampleCheck1">
                         Möchten Sie den Newsletter per E-Mail erhalten?</label>
                    </div>
                    <button type="submit" class="btn btn-block btn-warning" name="reg_user">Anmeldung</button>
                    <br>
                    <p>Sie haben bereits ein Konto? <a href="login.php">Anmelden</a></p> 
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