<?php
    require "connection.php";
    session_start();
    $logedin = false;
    
    if(isset($_SESSION['login']) && $_SESSION['login']==true){
        
        $logedin = true;
    }


    if($logedin){

        echo "YOU ARE IN ADD MEMBER <br>";
        if($_SERVER['REQUEST_METHOD']=='POST'){

            echo "this is a post request <br> <br>";

            $tName = $_POST['name'];    
            $teacherID = $_POST['teacherId'];
            $teacherRoll = $_POST['role'];
            $tPassword = $_POST['teacherPassword'];
            $adminId = $_SESSION['admin_id'];
            $adminKey = $_SESSION['admin_key'];
            
            
        
            
            if(strlen(trim($tPassword))){
                
                // echo "<br> you are in insert mod <br>";
                     
                $pass_hash = password_hash($_POST['teacherPassword'], PASSWORD_DEFAULT);
         
                $addMember = "INSERT INTO `teacher_info` (`teacher_key`, `teacher_id`, `admin_key`, `admin_id`, `teacher_name`, `teacher_role`, `teacher_password`, `free_p`, `full_p`, `available`) VALUES (NULL, '$teacherID', '$adminKey', '$adminId', '$tName', '$teacherRoll', '$tPassword', '3', '2', '0')";

                $run = mysqli_query($con,$addMember);

                
                if($run){
                    echo "<br> data inserted";
                    $get = "SELECT * FROM `teacher_info` WHERE teacher_id = '$teacherID'";   
                    $runGet = mysqli_query($con,$get);
                    $row = mysqli_fetch_assoc($runGet);
                    $tID = $row['teacher_id'];
                    $tKey = $row['teacher_key'];
                    echo "<br> $tID";
                    echo "<br> $tKey";

                    $addInTimetbl = "INSERT INTO `timetable` (`pd_key`, `admin_key`, `teacher_key`, `teacher_id`, `pd_1`, `pd_2`, `pd_3`, `pd_4`, `pd_5`, `pd_6`, `pd_7`, `pd_8`) VALUES (NULL, '$adminKey', '$tKey', '$tID', '', '', '', '', '', '', '', '')";
                    $runTimetbl = mysqli_query($con,$addInTimetbl);
                    if($runTimetbl){
                        echo "<br> inserted in times table";
                        header("location:../../index.php");
                    }else{
                        echo "<br> not inserted in times table";

                    }
                    
                }else{
                    echo "<br> data not inserted !";
                    
                }

            }else{

                echo "blank password<br>";
                
                // header("location:../../index.php");

            }
    
        }else{

            echo "<br> This is not a post request <br>";
        }

    }else{
        echo "<br> please login to add Member<br>";
    }

?>