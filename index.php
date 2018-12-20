<?php
require('model/database.php');
require('model/accounts_db.php');
require('model/questions_db.php');
require('model/question.php');
require('model/account.php');
session_start();
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'display_login';
    }
}
if ($action == 'display_login') {
    include('login/index.php');
} else if ($action == 'login') {
    $username = filter_input(INPUT_POST, 'username');
    $pass = filter_input(INPUT_POST, 'password');
    $res = AccountsDB::validate($username, $pass);
    if ($res == 'correct'){
	$user = AccountsDB::get_user($username);
	if (password_verify($pass, $user->getPass())){
		$_SESSION["user"] = $username;
		header("Location: .?action=display_questions");
	}else {
		include('login/index.php');
		echo '<div class="container">
  <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    <p class="copyright" style="text-align:center; color:red;">
        Username or Password Incorrect
    </p>
</div>
</div>
</div>';
	}
    } else {
	include('login/index.php');
	echo '<div class="container"><div class="row" style="margin-top:20px"><div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3"><p class="copyright" style="text-align:center; color:red;">';
	echo $res;
	echo '</p></div></div></div>';
	
    }
} else if ($action == 'display_registeration') {
    include('register/index.php');
} else if ($action == 'register') {
	$username = filter_input(INPUT_POST, 'username');
	if (AccountsDB::get_user($username)){
		include('register/index.php');
		echo '<div class="container">
  <div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
    <p class="copyright" style="text-align:center; color:red;">
        Username already exists. Please chosse another one
    </p>
</div>
</div>
</div>';
	} else {
	    	$pass = filter_input(INPUT_POST, 'password');
		$f = filter_input(INPUT_POST, 'firstName');
		$l = filter_input(INPUT_POST, 'lastName');
		$bday = filter_input(INPUT_POST, 'birthday');
		$res = AccountsDB::validateRegistration($f,$l,$bday,$username,$pass);
		if ($res == 'correct'){
			$options = [
	    		'cost' => 11,
			];
			$hash = password_hash($pass, PASSWORD_BCRYPT, $options);
			AccountsDB::create_user($username,$hash,$f,$l,$bday);
			$_SESSION["user"] = $username;
			header("Location: .?action=display_questions");
		} else {
			include('register/index.php');
			echo '<div class="container"><div class="row" style="margin-top:20px"><div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3"><p class="copyright" style="text-align:center; color:red;">';
			echo $res;
			echo '</p></div></div></div>';
		}
	}
} else if ($action == 'display_questions') {
    $user = $_SESSION["user"];
    $userInfo = AccountsDB::get_user($user);
    $questions = QuestionsDB::get_questions($user);
    $allquestions = QuestionsDB::get_all_questions();
	
    include('questions/index.php');
} else if ($action == 'display_new_question') {
    $user = $_SESSION["user"];
    include('question_form/index.php');
} else if ($action == 'create_new_question') {
    $user = $_SESSION["user"];
    $name = filter_input(INPUT_POST, 'questionname');
    $body = filter_input(INPUT_POST, 'content');
    $skills = filter_input(INPUT_POST, 'skills');
    if (strlen($skills) > 0) 
		$skills1 = explode(",", $skills);
    $res = QuestionsDB::validateQuestion($name, $body, $skills1);
    if ($res == 'correct'){
		QuestionsDB::add_question($user,$name,$body,$skills);
		header("Location: .?action=display_questions");
	} else {
		include('question_form/index.php');
		echo '<div class="container"><div class="row" style="margin-top:20px"><div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3"><p class="copyright" style="text-align:center; color:red;">';
		echo $res;
		echo '</p></div></div></div>';
    }
} else if ($action == 'display_edit_question') {
    $user = $_SESSION["user"];
    $qID = $_GET['questionID'];
    $q = QuestionsDB::get_question($qID);
    include('edit/index.php');
} else if ($action == 'edit_question') {
    $user = $_SESSION["user"];
    $qID = $_GET['questionID'];
    $name = filter_input(INPUT_POST, 'questionname');
    $body = filter_input(INPUT_POST, 'content');
    $skills = filter_input(INPUT_POST, 'skills');
    if (strlen($skills) > 0) 
		$skills1 = explode(",", $skills);
    $input = QuestionsDB::validateNewQuestion($name, $body, $skills1);
	
      if($input == 'all'){
		QuestionsDB::edit_question($qID, $user, $name, $body, $skills);
		header("Location: .?action=display_questions");
      }
      else{
		$original = QuestionsDB::get_question($qID);
		$flag = 0;
		if($input == 'skills'){
			QuestionsDB::edit_question($qID, $user, $original[0]->getName(), $original[0]->getBody(), $skills); $flag = 1;
		}else if($input == 'body'){
			QuestionsDB::edit_question($qID, $user, $original[0]->getName(), $body, $original[0]->getSkills()); $flag = 1;
		}else if($input == 'name'){
			QuestionsDB::edit_question($qID, $user, $name, $original[0]->getBody(), $original[0]->getSkills()); $flag = 1;
		}else if($input == 'name and body'){
			QuestionsDB::edit_question($qID, $user, $name, $body, $original[0]->getSkills()); $flag = 1;
		}else if($input == 'name and skills'){
			QuestionsDB::edit_question($qID, $user, $name, $original[0]->getBody(), $skills); $flag = 1;
		}else if($input == 'body and skills'){
			QuestionsDB::edit_question($qID, $user, $original[0]->getName(), $body, $skills); $flag = 1;
		}else{
			 $q = QuestionsDB::get_question($qID);
			 include('edit/index.php');
			 echo '<div class="container"><div class="row" style="margin-top:20px"><div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3"><p class="copyright" style="text-align:center; color:red;">';
			echo "Make sure you enter at least one field to update, using the proper format";
			echo '</p></div></div></div>';
		}
		if ($flag == 1)
			header("Location: .?action=display_questions");
		
      }
} else if ($action == 'delete_question') {
    $user = filter_input(INPUT_POST, 'username');
    $qID = filter_input(INPUT_POST, 'question_id');
    QuestionsDB::delete_question($qID);
    header("Location: .?action=display_questions");
} else if ($action == 'answer_question') {
    $user = $_SESSION["user"];
    $qID = $_GET['questionID'];
    $q = QuestionsDB::get_question($qID);
    include('answer/index.php');
} else if ($action == 'logout') {
    session_destroy(); 
    header("Location: .?action=display_login");
}
?>   

