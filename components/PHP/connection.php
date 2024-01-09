<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "arrangement app";

    $con  = mysqli_connect($servername,$username,$password,$database);

    if($con){
        echo "connected";
    }else{
        echo "Not connected";

    }

?>