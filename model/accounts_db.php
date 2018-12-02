<?php

function get_user($user_ID) {
    global $db;
    $query = 'SELECT * FROM is_users
              WHERE username = :user_ID';
    $statement = $db->prepare($query);
    $statement->bindValue(":user_ID", $user_ID);
    $statement->execute();
    $user = $statement->fetch();
    $statement->closeCursor();
    return $user;
}

function create_user($user, $pass, $fName, $lName, $birth) {
    global $db;
    $query = 'INSERT INTO is_users
                 (username, password, firstName, lastName, birthDay)
              VALUES
                 (:user, :pass, :fName, :lName, :birth)';
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->bindValue(':pass', $pass);
    $statement->bindValue(':fName', $fName);
    $statement->bindValue(':lName', $lName);
    $statement->bindValue(':birth', $birth);
    $statement->execute();
    $statement->closeCursor();
}

function validate($user, $pass) {
	    if(!empty($user) && !empty($pass)){
		if(strpos($user, '@') !== false && strlen($pass) >= 8){
			return "correct";
		}
		else{
			if(strpos($user, '@') == false){
				return "Invalid Email Address Format";
			}
			else{
				return "Password less than 8 characters";
			}
		}}
	    else if(empty($user) && empty($pass)){
		return "Please Enter Username And Password";
	    }
	    else if(empty($pass)){
		return "Please Enter Password";
	    }
		return "Please Enter Email Address";
}

function validateRegistration($fname, $lname, $date, $username, $password) {
	    if(!empty($fname) && !empty($lname) && !empty($date)){
	    	return validate($username, $password);
            }
	    else{
            	if(empty($fname)){
			return "Enter First Name";
		}
		else if(empty($lname)){
			return "Enter Last Name";
		}
		else{
			return "Enter Date";
		}
	    }
}
?>
