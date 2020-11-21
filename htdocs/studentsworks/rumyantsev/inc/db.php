<?php
$servername = "in-education.ru";
$username = "aleksey";
$password = "hevzywtd";
$dbname = "aleksey";
//Подключаемся к базе данных.
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    echo "Connection failed: ".$conn->connect_error;
} 
