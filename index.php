<?php
require('model/database.php');
require('model/accounts_db.php');
require('model/questions_db.php');

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
    $res = validate($username, $pass);
    if ($res == 'correct'){
	$user = get_user($username);
	if (password_verify($pass, $user["password"])){
		header("Location: .?action=display_questions&userID=$username");
	}else {
		include('login/index.php');
		echo "Username or Password Incorrect";
	}
    } else {
	include('login/index.php');
	echo $res;
	
    }
} else if ($action == 'display_registeration') {
    include('register/index.php');
} else if ($action == 'register') {
	$username = filter_input(INPUT_POST, 'username');
	if (get_user($username)){
		include('register/index.php');
		echo "Username already exists. Please chosse another one";
	} else {
	    	$pass = filter_input(INPUT_POST, 'password');
		$f = filter_input(INPUT_POST, 'firstName');
		$l = filter_input(INPUT_POST, 'lastName');
		$bday = filter_input(INPUT_POST, 'birthday');
		$res = validateRegistration($f,$l,$bday,$username,$pass);
		if ($res == 'correct'){
			$options = [
	    		'cost' => 11,
			];
			$hash = password_hash($pass, PASSWORD_BCRYPT, $options);
			create_user($username,$hash,$f,$l,$bday);
			header("Location: .?action=display_questions&userID=$username");
		} else {
			include('register/index.php');
			echo $res;
		}
	}
}else if ($action == 'display_questions') {
    $user = $_GET['userID'];
    $userInfo = get_user($user);
    $questions = get_questions($user);
    include('questions/index.php');
} else if ($action == 'display_new_question') {
    $user = $_GET['userID'];
    include('question_form/index.php');
} else if ($action == 'create_new_question') {
    $user = $_GET['userID'];
    $name = filter_input(INPUT_POST, 'questionname');
    $body = filter_input(INPUT_POST, 'content');
    $skills = filter_input(INPUT_POST, 'skills');
    if (strlen($skills) > 0) 
		$skills1 = explode(",", $skills);
    $res = validateQuestion($name, $body, $skills1);
    if ($res == 'correct'){
		add_question($user,$name,$body,$skills);
		header("Location: .?action=display_questions&userID=$user");
	} else {
		include('question_form/index.php');
		echo $res;
    }
} else if ($action == 'display_edit_question') {
    $user = $_GET['userID'];
    $qID = $_GET['questionID'];
    $q = get_question($qID);
    include('edit/index.php');
} else if ($action == 'edit_question') {
    $user = $_GET['userID'];
    $qID = $_GET['questionID'];
    $name = filter_input(INPUT_POST, 'questionname');
    $body = filter_input(INPUT_POST, 'content');
    $skills = filter_input(INPUT_POST, 'skills');
    if (strlen($skills) > 0) 
		$skills1 = explode(",", $skills);
    $input = validateNewQuestion($name, $body, $skills1);
	
      if($input == 'all'){
		edit_question($qID, $user, $name, $body, $skills);
		header("Location: .?action=display_questions&userID=$user");
      }
      else{
		$original = get_question($qID);
		$flag = 0;
		if($input == 'skills'){
			edit_question($qID, $user, $original['questionName'], $original['questionBody'], $skills); $flag = 1;
		}else if($input == 'body'){
			edit_question($qID, $user, $original['questionName'], $body, $original['questionSkills']); $flag = 1;
		}else if($input == 'name'){
			edit_question($qID, $user, $name, $original['questionBody'], $original['questionSkills']); $flag = 1;
		}else if($input == 'name and body'){
			edit_question($qID, $user, $name, $body, $original['questionSkills']); $flag = 1;
		}else if($input == 'name and skills'){
			edit_question($qID, $user, $name, $original['questionBody'], $skills); $flag = 1;
		}else if($input == 'body and skills'){
			edit_question($qID, $user, $original['questionName'], $body, $skills); $flag = 1;
		}else{
			 $user = $_GET['userID'];
			 $qID = $_GET['questionID'];
			 $q = get_question($qID);
			 include('edit/index.php');
			 echo "Make sure you enter at least one field to update, using the proper format";
		}
		if ($flag == 1)
			header("Location: .?action=display_questions&userID=$user");
		
      }
} else if ($action == 'delete_question') {
    $user = filter_input(INPUT_POST, 'username');
    $qID = filter_input(INPUT_POST, 'question_id');
    delete_question($qID);
    header("Location: .?action=display_questions&userID=$user");
}
?>   

