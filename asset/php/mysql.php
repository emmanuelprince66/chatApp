<?php 
$dsn= 'mysql:host=localhost;dbname=db_chat_users';
$dbuser = "root";
$dbpass = ""; 


try {
    $conn = new PDO($dsn,$dbuser,$dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo '';
} catch(PDOException $e) {
    echo 'connection failed:'. $e->getMessage();

}


?>