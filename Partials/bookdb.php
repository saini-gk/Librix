<?php
    $servername = "localhost";
    $username = "root";
    $password = "Gunjan@123";
    $dbname = "lms";

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if(!$conn){  
        die("Error" . mysqli_connect_error());
    }
?>