<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<title>Register</title>
<meta name="description" content="">
<meta name="viewport" content="width=device-width">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/main.css">


</head>
<!-- NAVBAR
================================================== -->

<body>

<div class="container">
  <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
      <form name="form_login" method="post" action="" role="form">
        <fieldset>
          <h2>Registration Form</h2>
          <hr class="colorgraph">
	  <div class="form-group">
            <input name="firstName" type="text" id="firstName" class="form-control input-lg" placeholder="First Name">
          </div>
	  <div class="form-group">
            <input name="lastName" type="text" id="lastName" class="form-control input-lg" placeholder="Last Name">
          </div>
	  <div class="form-group">
            <input name="birthday" type="text" id="birthday" class="form-control input-lg" placeholder="Birthday MM/DD/YYYY">
          </div>
          <div class="form-group">
            <input name="username" type="text" id="user_id" class="form-control input-lg" placeholder="Email Address">
          </div>
          <div class="form-group">
            <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
          </div>
          <hr class="colorgraph">
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <input type="submit" name="Submit" value="Submit" class="btn btn-lg btn-success btn-block">
            </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>

</body>
</html>


<?php
      include("connect.php");
      include("validate.php");
      session_start();
   
      if($_SERVER["REQUEST_METHOD"] == "POST") {
	$date = $_POST['birthday'];
	$fname = $_POST['firstName'];
	$lname = $_POST['lastName'];
	$username = $_POST['username'];
	$password = $_POST['password'];
        $input = validateRegistration($fname, $lname, $date, $username, $password);
      if($input == "correct"){
		$options = [
    		'cost' => 11,
		];
		$hash = password_hash($password, PASSWORD_BCRYPT, $options);

		$sql = "INSERT INTO is_users (username, password) VALUES ('$username', '$hash')";
		$result = $conn->query($sql);
      		if ($result) {
		    header("Location: newQuestion.php");
		    die();
		}
		else{
			echo "Username Already Exists. Please Choose Another One";
		}
   	}
	else{
		echo $input;
	}
   }
?>
