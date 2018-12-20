<?php
class AccountsDB {
    public static function get_user($user_ID) {
        $db = Database::getDB();
	$query = 'SELECT * FROM is_users
              WHERE username = :user_ID';
        $statement = $db->prepare($query);
    	$statement->bindValue(":user_ID", $user_ID);
    	$statement->execute();
        $row = $statement->fetch();
    	$statement->closeCursor();
	$user = false;
	if($row){
	$user = new Account(
                        $row['username'],
                        $row['password'],
			$row['firstName'],
			$row['lastName'],
			$row['birthDay']);
	}
    	return $user;
    }
    public static function create_user($user, $pass, $fName, $lName, $birth) {
        $db = Database::getDB();
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
    public static function validate($user, $pass) {
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

    public static function validateRegistration($fname, $lname, $date, $username, $password) {
	    if(!empty($fname) && !empty($lname) && !empty($date)){
	    	return AccountsDB::validate($username, $password);
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
}
?>
