<?php

    if($_SERVER['REQUEST_METHOD'] == "POST"){
      $logout = false;
      session_start();
      session_unset();
      session_destroy();
      header("location:../../index.php");
    }
?>
