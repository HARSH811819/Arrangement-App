<?php
    require "connection.php";
    $logedin = false;
    session_start();
    if(isset($_SESSION['login']) && $_SESSION['login']==true){
        $logedin = true;
    }
    
    if($logedin){
        
        $adminId = $_SESSION['admin_id'];
        $adminKey = $_SESSION['admin_key'];
    
        echo "<br>you are in Add clases<br>";
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            echo "data posted<br>";
            $class = trim($_POST['classname']);
            $section = trim($_POST['classsec']);
    
            $class = $_POST['classname'];
            $secsion = $_POST['classsec'];
            echo "yourclass$class <br>";
            echo "yoursec$secsion <br>";                                                                                                                                
            
            $addclass = "INSERT INTO `class_list` (`class_key`, `admin_key`, `teacher_key`, `Class`, `section`, `av`) VALUES (NULL, '$adminKey', '', '$class', '$section', '0')";
            $run = mysqli_query($con,$addclass);

            if($run){
                echo "Class insered";
                header("location:../../index.php");
            }else{
                echo "Class not insered";
                header("location:../../index.php");
            }
        }else{
            echo " something is wrong it is not a post request";
        }
    }else{
        echo "<br>not loged in ";
    }

?>  


