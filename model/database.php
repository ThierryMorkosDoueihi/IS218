<?php
    try {
        $db = new PDO('mysql:dbname=tm334;host=sql1.njit.edu', 'tm334', 'C8BOrztwS');
    } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include('../errors/database_error.php');
        exit();
    }
?>
