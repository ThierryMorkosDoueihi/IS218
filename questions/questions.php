<?php include 'view/header.php'; ?>
<body>
<form action="." method="post"><input type="hidden" name="action" value="logout">'
  <label class="logoutLblPos">
  <input name="submit2" type="submit" id="submit2" style="background-color:#e8440d; border-color:#e8440d; color:white;" value="Logout">
  </label>
</form>
<div class="container">
  <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
	<ul class="nav nav-tabs">
	    <li class="active"><a data-toggle="tab" href="#home">My Questions</a></li>
	    <li><a data-toggle="tab" href="#all">All Questions</a></li>
	</ul>
	<div class="tab-content">
	<div id="home" class="tab-pane fade in active">
      <form name="form_login" method="post" action="" role="form">
        <fieldset>
	  <?php echo "<h2>"; echo $userInfo->getFirst(); echo " "; echo $userInfo->getLast(); echo "'s Questions:</h2>";?>
	  <hr class="colorgraph">
	  <?php 
		if($questions == false){
			echo "<h3>Please enter a new question</h3>";
			echo '<hr class="colorgraph">';
		} else{
			foreach($questions as $q){
				echo '<h3 style="text-align:center;">Title: '; echo $q->getName(); echo "</h3>";
				echo '<h4 style="text-align:center;">Body: '; echo $q->getBody(); echo "</h4>";
				echo '<h5 style="text-align:center;">Skills: '; echo $q->getSkills(); echo "</h5>";
				echo '<div class="row"><div class="col-xs-6 col-sm-6 col-md-6"> <a href="?action=display_edit_question&questionID=';
				echo $q->getID();
				echo '"';
				echo 'class="btn btn-lg btn-primary btn-block">Edit</a> </div>';

				echo '<form action="." method="post"><input type="hidden" name="action" value="delete_question">';
				echo '<input type="hidden" name="username" value="';
				echo $user;
				echo '">';
                    		echo '<input type="hidden" name="question_id" value="';
				echo $q->getID();
				echo '"><div class="col-xs-6 col-sm-6 col-md-6"><input type="submit" class="btn btn-lg btn-primary btn-block" style="background-color:#e8440d; border-color:#e8440d;" value="Delete"></div></form>';
				echo '<br><br><hr class="colorgraph">';
			}
		}	
	  ?>
	    <div class="col-xs-12 col-sm-12 col-md-12">
              <a href="?action=display_new_question" class="btn btn-lg btn-success btn-block" style="width:100%">Add a new question</a>
            </div>
        </fieldset>
      </form>
	</div>
	<div id="all" class="tab-pane fade">
	<form name="form_login" method="post" action="" role="form">
        <fieldset>
	<hr class="colorgraph">
	  <?php 
		if($allquestions == false){
			echo "<h3>No Questions Yet. Be The First To Add One</h3>";
			echo '<hr class="colorgraph">';
		} else{
			foreach($allquestions as $q){
				echo '<h3 style="text-align:center;">Title: '; echo $q->getName(); echo "</h3>";
				echo '<h4 style="text-align:center;">Body: '; echo $q->getBody(); echo "</h4>";
				echo '<h5 style="text-align:center;">Skills: '; echo $q->getSkills(); echo "</h5>";
				echo '<div class="col-xs-12 col-sm-12 col-md-12"><a href="?action=answer_question&questionID=';
				echo $q->getID();
				echo '" class="btn btn-lg btn-success btn-block" style="width:100%">View Answers or Answer</a></div>';
				echo '<hr class="colorgraph">';
			}
		}	
	  ?>
	</fieldset>
      </form>
	</div></div>
    </div>
  </div>
</div>



<script>
$(function(){
  var hash = window.location.hash;
  hash && $('ul.nav a[href="' + hash + '"]').tab('show');

  $('.nav-tabs a').click(function (e) {
    $(this).tab('show');
    var scrollmem = $('body').scrollTop();
    window.location.hash = this.hash;
    $('html,body').scrollTop(scrollmem);
  });
});
</script>

</body>

<?php include 'view/footer.php'; ?>

