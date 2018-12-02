<?php include 'view/header.php'; ?>
<body>

<div class="container">
  <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
      <form name="form_login" method="post" action="" role="form">
        <fieldset>
	  <?php echo "<h2>"; echo $userInfo[2]; echo " "; echo $userInfo[3]; echo "'s Questions:</h2>";?>
	  <hr class="colorgraph">
	  <?php 
		if($questions == false){
			echo "<h3>Please enter a new question</h3>";
			echo '<hr class="colorgraph">';
		} else{
			foreach($questions as $q){
				echo '<h3 style="text-align:center;">Title: '; echo $q['questionName']; echo "</h3>";
				echo '<h4 style="text-align:center;">Body: '; echo $q['questionBody']; echo "</h4>";
				echo '<h5 style="text-align:center;">Skills: '; echo $q['questionSkills']; echo "</h5>";
				echo '<div class="row"><div class="col-xs-6 col-sm-6 col-md-6"> <a href="?action=display_edit_question&userID=';
				echo $user;
				echo '&questionID=';
				echo $q['num'];
				echo '"';
				echo 'class="btn btn-lg btn-primary btn-block">Edit</a> </div>';

				echo '<form action="." method="post"><input type="hidden" name="action" value="delete_question">';
				echo '<input type="hidden" name="username" value="';
				echo $user;
				echo '">';
                    		echo '<input type="hidden" name="question_id" value="';
				echo $q['num'];
				echo '"><div class="col-xs-6 col-sm-6 col-md-6"><input type="submit" class="btn btn-lg btn-primary btn-block" style="background-color:#e8440d; border-color:#e8440d;" value="Delete"></div></form>';
				echo '<br><br><hr class="colorgraph">';
			}
		}	
	  ?>
	    <div class="col-xs-12 col-sm-12 col-md-12">
              <a href="?action=display_new_question&userID=<?php echo $user; ?>" class="btn btn-lg btn-success btn-block" style="width:100%">Add a new question</a>
            </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>

</body>

<?php include 'view/footer.php'; ?>

