<?php
	$hostname="sql.njit.edu";
	$username="tm334"; 
	$password="advice59";      
	$database="tm334";  
	$conn = mysqli_connect($hostname,$username,$password,$database);
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}
?>
