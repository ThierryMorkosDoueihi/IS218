<?php
class Question {
    private $id, $user, $name, $body, $skills, $answers;
    public function __construct($user, $name, $body, $skills) {
        $this->user = $user;
        $this->name = $name;
        $this->body = $body;
        $this->skills = $skills;
    }
    public function getUser() {
        return $this->user;
    }
    public function setUser($value) {
        $this->user = $value;
    }
    public function getID() {
        return $this->id;
    }
    public function setID($value) {
        $this->id = $value;
    }
    public function getName() {
        return $this->name;
    }
    public function setName($value) {
        $this->name = $value;
    }
    public function getBody() {
        return $this->body;
    }
    public function setBody($value) {
        $this->body = $value;
    }
    public function getSkills() {
        return $this->skills;
    }
    public function setSkills($value) {
        $this->skills = $value;
    }
    public function getAnswers() {
        return $this->anwers;
    }
    public function newAnswer($value) {
        $this->answers = new Answer($this->id, $value);
    }
}
?>
