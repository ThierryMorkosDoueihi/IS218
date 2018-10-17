<?php
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


	function validateQuestion($name, $body, $skills) {
	    if(!empty($name) && !empty($body) && !empty($skills)){
	    	if(strlen($name) >= 3 && strlen($body) < 500 && count($skills) >= 2)
			return "correct";
		else if(!(strlen($name) >= 3))
			return "Title too short";
		else if(!(strlen($body) < 500))
			return "Question is too long";
		else
			return "Add more skills";
	    }
	    else{
		if(empty($name)){
			return "Enter Title";
		}
		else if(empty($body)){
			return "Enter Question Body";
		}
		else{
			return "Enter Skills";
		}
	    }
	}
?>
