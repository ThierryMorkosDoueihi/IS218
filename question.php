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
	  <?php
		include("connect.php");
		$user = $_GET['userID'];
		$query="SELECT * FROM is_users WHERE username LIKE '$user'";
		$result = $conn->query($query);
		if($result->num_rows > 0){
			$row = $result->fetch_assoc();
			$pageHeader = "<h2>" . $row["firstName"] . " " . $row["lastName"] . "'s Questions </h2>";
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
				echo '<h3>Title: ' . $row['questionName'] . '</h3><h5>Body: ' . $row['questionBody'] . '</h5><p>Skills: ' . $row['questionSkills'] . '</p>';
				echo '<hr class="colorgraph">';
			}
		}
		else{
			echo "Please enter a new question";
			echo '<hr class="colorgraph">';
		}
	?>
	 
          <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
              <a href="newQuestion.php?userID=<?php echo $_GET['userID'] ?>" class="btn btn-lg btn-success btn-block" style="width:100%">Add a new question</a> 
            </div>
</div>
	  <hr class="colorgraph">
	  <div class="row">
	    <div class="col-xs-6 col-sm-6 col-md-6"> <a href="edit.php?userID=<?php echo $_GET['userID'] ?>" class="btn btn-lg btn-primary btn-block">Edit A Question</a> </div>
	    <div class="col-xs-6 col-sm-6 col-md-6"> <a href="remove.php?userID=<?php echo $_GET['userID'] ?>" class="btn btn-lg btn-primary btn-block" style="background-color:#e8440d;">Remove A Question</a> </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>

</body>
</html>
