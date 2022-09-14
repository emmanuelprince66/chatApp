<?php 
$dsn= 'mysql:host=sql100.epizy.com;dbname=epiz_32590068_packetcodeofficial';
$dbuser = "epiz_32590068";
$dbpass = "fgIoAVEh2UaH"; 


try {
    $conn = new PDO($dsn,$dbuser,$dbpass);
    $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    echo '';
} catch(PDOException $e) {
    echo 'connection failed:'. $e->getMessage();

}


?>