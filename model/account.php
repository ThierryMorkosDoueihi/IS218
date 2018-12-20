<?php
class Account {
    private $user, $pass, $first, $last, $birth;
    public function __construct($user, $pass, $first, $last, $birth) {
        $this->user = $user;
        $this->pass = $pass;
        $this->first = $first;
        $this->last = $last;
	$this->birth = $birth;
    }
    public function getUser() {
        return $this->user;
    }
    public function setUser($value) {
        $this->user = $value;
    }
    public function getPass() {
        return $this->pass;
    }
    public function setPass($value) {
        $this->pass = $value;
    }
    public function getFirst() {
        return $this->first;
    }
    public function setFirst($value) {
        $this->first = $value;
    }
    public function getLast() {
        return $this->last;
    }
    public function setLast($value) {
        $this->last = $value;
    }
}
?>
