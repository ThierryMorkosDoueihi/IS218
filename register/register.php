<?php include 'view/header.php'; ?>
<body>

<div class="container">
  <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
      <form name="form_login" method="post" action="" role="form">
        <fieldset>
          <h2>Registration Form</h2>
          <hr class="colorgraph">
	  <div class="form-group">
	    <input type="hidden" name="action" value="register">
          </div>
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
            <div class="col-xs-12 col-sm-12 col-md-12">
              <input type="submit" name="Submit" value="Submit" class="btn btn-lg btn-success btn-block">
            </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>

</body>

<?php include 'view/footer.php'; ?>
