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
<title>Questions</title>
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
          <h2>Post A Question</h2>
          <hr class="colorgraph">
	  <div class="form-group">
            <input name="questionname" type="text" id="questionName" class="form-control input-lg" placeholder="Title">
          </div>
	  <div class="form-group">
            <input name="content" type="text" id="questionBody" class="form-control input-lg" placeholder="Write your question...">
          </div>
	  <div class="form-group">
            <input name="skills" type="text" id="questionSkills" class="form-control input-lg" placeholder="Write skills seperated by a coma...">
          </div>
          <hr class="colorgraph">
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <input type="submit" name="Submit" value="Submit" class="btn btn-lg btn-success btn-block">
            </div>
	<div class="col-xs-6 col-sm-6 col-md-6"> <a href="question.php?userID=<?php echo $_GET['userID'] ?>" class="btn btn-lg btn-primary btn-block">Go To Questions</a> </div>
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
      $user = $_GET['userID'];
      if($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST['questionname'];
	$body = $_POST['content'];
	$skills = $_POST['skills'];
	if (strlen($skills) > 0) 
		$skills1 = explode(",", $skills);
        $input = validateQuestion($name, $body, $skills1);
      if($input == "correct"){
		$query="SELECT * FROM is_questions WHERE username LIKE '$user'";
		$result = $conn->query($query);
		$num = mysqli_num_rows($result) + 1;
		$query="SELECT * FROM is_questions WHERE username LIKE '$user' AND num='$num'";
		$result = $conn->query($query);
		if(mysqli_num_rows($result) > 0)
			$num = $num - 1;
		$sql = "INSERT INTO is_questions (num, username, questionName, questionBody, questionSkills) VALUES('$num','$user', '$name', '$body', '$skills')";
		$result = $conn->query($sql);
      		if ($result) {
		    header("Location: question.php?userID=$user&num=$num");
		    die();
		}
		else{
		    echo "OOPS! This is embarassing! We could not process your question. Please try again.";
		}
   	}
	else{
		echo $input;
	}
   }
?>
