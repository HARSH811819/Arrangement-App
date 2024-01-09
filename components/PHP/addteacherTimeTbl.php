    <?php
        require"connection.php";
        $logedin = false;
        session_start();
        if(isset($_SESSION['login']) && $_SESSION['login']==true){
            
            $logedin = true;
        }

        echo "<br>you are in add time table <br>";
        if($logedin){

        
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            echo "<br> you posted<br>";

            $teacherID = $_POST['EditTeacherID']; // this is teacher id which is to be updated
            $Ist = $_POST['Ist'];
            $IInd = $_POST['IInd'];
            $IIIrd = $_POST['IIIrd'];
            $IVth = $_POST['IVth'];
            $Vth = $_POST['Vth'];
            $VIth = $_POST['VIth'];
            $VIIth = $_POST['VIIth'];
            $VIIIth = $_POST['VIIIth'];
            $free = 0;
            $full = 0;

            
            $PD = array($Ist,$IInd,$IIIrd,$IVth,$Vth,$VIth,$VIIth,$VIIIth); // array to store lature data for free and full pd data
            
            
            for($i = 0;$i<8;$i++){
                // echo "<br>". $PD[$i];
                if(!strcmp($PD[$i],"Free")){
                    $free++;
                }else{
                    $full++;
                }
            }
    
            $updateTbl = "UPDATE `timetable` SET `pd_1` = '$Ist', `pd_2` = '$IInd', `pd_3` = '$IIIrd', `pd_4` = '$IVth', `pd_5` = '$Vth', `pd_6` = '$VIth', `pd_7` = '$VIIth', `pd_8` = '$VIIIth' WHERE `timetable`.`teacher_id` = '$teacherID'";
            $run = mysqli_query($con,$updateTbl);
            
            if($run){
        
                    echo "<br> Time table updated";
                    $updateInfo = "UPDATE `teacher_info` SET `free_p` = '$free', `full_p` = '$full' WHERE `teacher_info`.`teacher_id` = '$teacherID'";  // update teachers column in teacher info table free_pd and full_pd

                    $runUpInfo = mysqli_query($con,$updateInfo);
                    if($runUpInfo){
                        echo "<br> teachers Info is updated";
                        header("location:../../index.php");
                    }else{
                        
                        echo "<br> teachers Info is updated";
                    }

            }else{
                echo "<br> can't update ! Something went wrong";
                
            }
        }else{

            echo "<br> this is not a post Request <br>";
        }

    }else{
        echo "<br> Pleaase Log in to Update Time table <br>";
    }

    ?>