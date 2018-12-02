<?php

function get_questions($user_ID) {
    global $db;
    $query = 'SELECT * FROM is_questions
              WHERE username = :user_ID';
    $statement = $db->prepare($query);
    $statement->bindValue(":user_ID", $user_ID);
    $statement->execute();
    $question = $statement->fetchAll();
    $statement->closeCursor();
    return $question;
}

function get_question($num) {
    global $db;
    $query = 'SELECT * FROM is_questions
              WHERE num = :num';
    $statement = $db->prepare($query);
    $statement->bindValue(":num", $num);
    $statement->execute();
    $question = $statement->fetch();
    $statement->closeCursor();
    return $question;
}

function delete_question($question_ID) {
    global $db;
    $query = 'DELETE FROM is_questions
              WHERE num = :num';
    $statement = $db->prepare($query);
    $statement->bindValue(':num', $question_ID);
    $statement->execute();
    $statement->closeCursor();
}

function add_question($user, $name, $body, $skills) {
    global $db;
    $query = 'INSERT INTO is_questions
                 (username, questionName, questionBody, questionSkills)
              VALUES
                 (:user, :name, :body, :skills)';
    $statement = $db->prepare($query);
    $statement->bindValue(':user', $user);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':body', $body);
    $statement->bindValue(':skills', $skills);
    $statement->execute();
    $statement->closeCursor();
}

function edit_question($question_ID, $user, $name, $body, $skills) {
    global $db;
    $query = "UPDATE is_questions
              SET questionName = :name, questionBody = :body, questionSkills = :skills
              WHERE num = :num and username = :user";
    $statement = $db->prepare($query);
    $statement->bindValue(':num', $question_ID);
    $statement->bindValue(':name', $name);
    $statement->bindValue(':body', $body);
    $statement->bindValue(':skills', $skills);
    $statement->bindValue(':user', $user);
    $statement->execute();
    $statement->closeCursor();
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

function validateNewQuestion($name, $body, $skills) {
	    if(!empty($name) && !empty($body) && !empty($skills)){
	    	$input = validateQuestion($name, $body, $skills);
		if($input == 'correct')
			return 'all';
		return $input;
	    }
	    else{
		if(empty($name) && empty($body) && count($skills) >= 2){
			return "skills";
		}
		else if(empty($body) && empty($skills) && strlen($name) >= 3){
			return "name";
		}
		else if(empty($name) && empty($skills) && strlen($body) < 500 && !empty($body)){
			return "body";
		}
		else if(empty($name) && strlen($body) < 500 && count($skills) >= 2 && !empty($body)){
			return "body and skills";
		}
		else if(empty($body) && strlen($name) >= 3 && count($skills) >= 2){
			return "name and skills";
		}
		else{
			if(strlen($name) >= 3 && strlen($body) < 500 && !empty($body))
			return "name and body";
		}
	    }
}
?>
