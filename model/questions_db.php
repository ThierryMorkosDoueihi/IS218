<?php
class QuestionsDB {
    public static function get_all_questions() {
        $db = Database::getDB();
        $query = 'SELECT * FROM is_questions';
    	$statement = $db->prepare($query);
    	$statement->execute();
    	$rows = $statement->fetchAll();
    	$statement->closeCursor();

	foreach ($rows as $row) {
	    $question = new Question(
                        $row['username'],
                        $row['questionName'],
			$row['questionBody'],
			$row['questionSkills']);
            $question->setId($row['num']);
            $questions[] = $question;
	}
    	return $questions;
    }
    public static function get_questions($user_ID) {
        $db = Database::getDB();
        $query = 'SELECT * FROM is_questions
              WHERE username = :user_ID';
    	$statement = $db->prepare($query);
    	$statement->bindValue(":user_ID", $user_ID);
    	$statement->execute();
    	$rows = $statement->fetchAll();
    	$statement->closeCursor();

	foreach ($rows as $row) {
	    $question = new Question(
                        $row['username'],
                        $row['questionName'],
			$row['questionBody'],
			$row['questionSkills']);
	    $question->setId($row['num']);
            $questions[] = $question;
	}
    	return $questions;
    }
    public static function get_question($num) {
        $db = Database::getDB();
        $query = 'SELECT * FROM is_questions
              WHERE num = :num';
        $statement = $db->prepare($query);
    	$statement->bindValue(":num", $num);
    	$statement->execute();
    	$rows = $statement->fetchAll();
    	$statement->closeCursor();
	foreach ($rows as $row) {
	    $question = new Question(
                        $row['username'],
                        $row['questionName'],
			$row['questionBody'],
			$row['questionSkills']);
            $question->setId($row['num']);
            $questions[] = $question;
	}
    	return $questions;
    }
    public static function delete_question($question_ID) {
        $db = Database::getDB();
        $query = 'DELETE FROM is_questions
              WHERE num = :num';
    	$statement = $db->prepare($query);
    	$statement->bindValue(':num', $question_ID);
    	$statement->execute();
    	$statement->closeCursor();
    }
    public static function add_question($user, $name, $body, $skills) {
        $db = Database::getDB();
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
    public static function edit_question($question_ID, $user, $name, $body, $skills) {
        $db = Database::getDB();
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
    public static function validateQuestion($name, $body, $skills) {
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
    public static function validateNewQuestion($name, $body, $skills) {
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
}
?>
