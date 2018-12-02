<?php include 'view/header.php'; ?>
<body>

<div class="container">
  <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
      <form name="form_login" method="post" action="" role="form">
        <fieldset>
          <h2>Post A Question</h2>
          <hr class="colorgraph">
	  <div class="form-group">
	    <input type="hidden" name="action" value="create_new_question">
          </div>
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
	<div class="col-xs-6 col-sm-6 col-md-6"> <a href="?action=display_questions&userID=<?php echo $user; ?>" class="btn btn-lg btn-primary btn-block">Go To Questions</a> </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>

</body>

<?php include 'view/footer.php'; ?>
