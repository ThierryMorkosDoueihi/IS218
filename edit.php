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
<title>Update A Question</title>
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
          <h2>Update Questions</h2>
          <hr class="colorgraph">
          <?php
		include("connect.php");
		$user = $_GET['userID'];
		$query="SELECT * FROM is_users WHERE username LIKE '$user'";
		$result = $conn->query($query);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$pageHeader = "<h2>" . $row["firstName"] . " " . $row["lastName"] . "'s Questions: </h2>";
          		echo $pageHeader;
		}
	  ?>
	  <hr class="colorgraph">
	  <?php
		include("connect.php");
		$user = $_GET['userID'];
		$query="SELECT * FROM is_questions WHERE username LIKE '$user' ORDER BY num ASC";
		$result = $conn->query($query);
		if($result){
			while ($row = $result->fetch_assoc()) {
				echo '<h3>#' . $row['num'] . ' Title: ' . $row['questionName'] . '</h3><h5>Body: ' . $row['questionBody'] . '</h5><p>Skills: ' . $row['questionSkills'] . '</p>';
				echo '<hr class="colorgraph">';
			}
		}
		else{
			echo "No Questions To Delete";
			echo '<hr class="colorgraph">';
		}
	?>
	  
          <div class="form-group">
            <input type="number" name="number" id="number" class="form-control input-lg" placeholder="Enter The Number of Question You Wish to Update">
          </div>
	  <div class="form-group">
            <input name="questionname" type="text" id="questionName" class="form-control input-lg" placeholder="New Title (optional)">
          </div>
	  <div class="form-group">
            <input name="content" type="text" id="questionBody" class="form-control input-lg" placeholder="New question... (optional)">
          </div>
	  <div class="form-group">
            <input name="skills" type="text" id="questionSkills" class="form-control input-lg" placeholder="New skills seperated by a coma... (optional)">
          </div>
          <hr class="colorgraph">
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <input type="submit" name="Submit" value="Update" class="btn btn-lg btn-success btn-block">
            </div>
	    <div class="col-xs-6 col-sm-6 col-md-6"> <a href="question.php?userID=<?php echo $_GET['userID'] ?>" class="btn btn-lg btn-primary btn-block">Go To Questions</a> </div>
	  </div>

	  
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
      $user = $_GET['userID'];
	
      if($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = $_POST['questionname'];
	$body = $_POST['content'];
	$skills = $_POST['skills'];
	$number = $_POST['number'];
	if (strlen($skills) > 0) 
		$skills1 = explode(",", $skills);
        $input = validateNewQuestion($name, $body, $skills1);
	
      if($input == 'all'){
		$sql = "UPDATE is_questions SET questionName='$name', questionBody='$body', questionSkills='$skills'  WHERE num=$number";
		$result = $conn->query($sql);
      		if ($result) {
		    header("Location: question.php?userID=$user");
		    die();
		}
		else{
		    echo "OOPS! This is embarassing! We could not process your question. Please try again.";
		}
      }
      else{
		if($input == 'skills')
			$sql = "UPDATE is_questions SET questionSkills='$skills' WHERE num=$number";
		else if($input == 'body')
			$sql = "UPDATE is_questions SET questionBody='$body' WHERE num=$number";
		else if($input == 'name')
			$sql = "UPDATE is_questions SET questionName='$name' WHERE num=$number";
		else if($input == 'name and body')
			$sql = "UPDATE is_questions SET questionName='$name', questionBody='$body'  WHERE num=$number";
		else if($input == 'name and skills')
			$sql = "UPDATE is_questions SET questionName='$name', questionSkills='$skills'  WHERE num=$number";
		else if($input == 'body and skills')
			$sql = "UPDATE is_questions SET questionBody='$body', questionSkills='$skills'  WHERE num=$number";
		else
			echo "Make sure you enter at least one field to update, using the proper format";
		$result = $conn->query($sql);
      		if ($result) {
		    header("Location: question.php?userID=$user");
		    die();
		}
      }
    }
		
?>
