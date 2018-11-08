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
<title>Remove A Question</title>
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
          <h2>Delete Questions</h2>
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
            <input type="number" name="number" id="number" class="form-control input-lg" placeholder="Enter The Number of Question You Wish to Delete">
          </div>
          <hr class="colorgraph">
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <input type="submit" name="Submit" value="Remove" class="btn btn-lg btn-success btn-block" style="background-color:#e8440d;">
            </div>
	    <div class="col-xs-6 col-sm-6 col-md-6">
              <input type="submit" name="Submit" value="Remove All" class="btn btn-lg btn-success btn-block" style="background-color:#e8440d;">
            </div>
	  </div>

	  <hr class="colorgraph">
	  <div class="row">
	    <div class="col-xs-12 col-sm-12 col-md-12"> <a href="question.php?userID=<?php echo $_GET['userID'] ?>" class="btn btn-lg btn-primary btn-block">Go To Questions</a> </div>
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
      $user = $_GET['userID'];
      if($_SERVER["REQUEST_METHOD"] == "POST") {
	if ($_POST['Submit'] == 'Remove All') {
		$sql = "DELETE FROM is_questions WHERE username LIKE '$user'";
		$result = $conn->query($sql);
      		if ($result) {
			header("Refresh:0");
		}
		else{
			echo "Could Not Process Request. Please Try Again";
		}
	}
      else{
	$number = $_POST['number'];
      if($number > 0){
		$sql = "DELETE FROM is_questions WHERE num=$number";
		$result = $conn->query($sql);
      		if ($result) {
			header("Refresh:0");
		}
		else{
			echo "Incorrect Number";
		}
   	}
	else{
		echo 'Invalid Number. Please enter a positive number';
	}
   }
   }
?>
