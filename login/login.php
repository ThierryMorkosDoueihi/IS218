<?php include 'view/header.php'; ?>
<body>

<div class="container">
  <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
      <form name="form_login" method="post" action="." role="form">
        <fieldset>
          <h2>Login</h2>
          <hr class="colorgraph">
	  <div class="form-group">
	    <input type="hidden" name="action" value="login">
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
              <input type="submit" name="Submit" value="Login" class="btn btn-lg btn-success btn-block">
            </div>
            <div class="col-xs-6 col-sm-6 col-md-6"> <a href="?action=display_registeration" class="btn btn-lg btn-primary btn-block">Register For Free!</a> </div>
          </div>
        </fieldset>
      </form>
    </div>
  </div>
</div>

</body>
<?php include 'view/footer.php'; ?>
