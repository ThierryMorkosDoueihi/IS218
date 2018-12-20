<?php include 'view/header.php'; ?>
<body>

<div class="container">
  <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
      <form name="form_login" method="post" action="" role="form">
        <fieldset>
          <h2>Answer Question</h2>
          <hr class="colorgraph">
	  <?php
		echo "<h3>Title: "; echo $q[0]->getName(); echo "</h3>";
		echo "<h4>Body: "; echo $q[0]->getBody(); echo "</h4>";
		echo "<h5>Skills: "; echo $q[0]->getSkills(); echo "</h5>";
	  ?>
	  <hr class="colorgraph">
	  <div class="form-group">
            <input name="answer" type="text" id="answers" class="form-control input-lg" placeholder="Write an answer...">
          </div>
          <hr class="colorgraph">
          <div class="row">
            <div class="col-xs-6 col-sm-6 col-md-6">
              <input type="submit" name="Submit" value="Submit" class="btn btn-lg btn-success btn-block">
            </div>
	<div class="col-xs-6 col-sm-6 col-md-6"> <a href="?action=display_questions#all" class="btn btn-lg btn-primary btn-block">Go To All Questions</a> </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>


</body>
<?php include 'view/footer.php'; ?>
