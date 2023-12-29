<?php 
try {
    $host = "localhost";
    $dbname = "id21723269_employee_monitoring";
    $user = "id21723269_root";
    $password = "Durendal*7";

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $err) {
    echo $err->getMessage();
}
?>