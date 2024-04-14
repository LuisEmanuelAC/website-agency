<?php
$server="localhost";
$Database="website-agency";
$user="root";
$password="";

try {
    $sql=new PDO("mysql:host=$server;dbname=$Database",$user,$password);
    echo "successful connection";
} catch (Exception $error) {
    echo $error->getMessage();
}

?>