<?php 
// database connection
    $server = 'v.je';
    $username = 'student';
    $password = 'student';
    $schema = 'CSY2028';

    $pdo = new PDO('mysql:dbname=' . $schema . ';host=' . $server, $username, $password, 
    [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
?>