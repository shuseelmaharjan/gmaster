<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gmaster";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

function grade($marks) {
    if($marks >= 90) {
        return "A+";
    } else if($marks >= 80) {
        return "A";
    } else if ($marks >= 70) {
        return "B+";
    } else if ($marks >= 60) {
        return "B";
    } else if ($marks >= 50) {
        return "C+";
    } else if ($marks >= 40) {
        return "C";
    } else {
        return "Fail";
    }
}


?>

