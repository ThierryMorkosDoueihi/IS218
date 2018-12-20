<?php
    class Answer {
    private $id, $score $answer;
    public function __construct($id, $answer) {
        $this->id = $id;
        $this->score = 0;
        $this->answer = $answer;
    }
    public function upVote(){
	$this->score++;
    }
    public function downVote(){
	$this->score--;
    }


?>
