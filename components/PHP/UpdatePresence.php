<?php
require "connection.php";
echo "<br> this is Attendance file to update Presence";
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    echo "<br> This is a post request";
    $teacherID = $_POST['UpdateID'];
    $present = $_POST['present'];
    echo "<br> $teacherID";
    $ispresent = 0;
    
    if($present){
        $ispresent = 0;
    }else{
        $ispresent = 1;
    }
    $update = "UPDATE `teacher_info` SET `available` = '$ispresent' WHERE `teacher_info`.`teacher_id` = '$teacherID'";
    $run = mysqli_query($con,$update);
    if($run){
        
        echo "<br>the teacher $teacherID is set to  ".$ispresent;
        header("location:../../index.php");
    }else{
        
        echo "<br>the teacher $teacherID is not set to  ".$ispresent;
    }
    
}
?>