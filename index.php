<?php
    // echo "hellow my name is harsh PHP";
    $logedin = false;
    session_start();
    $adminId = "";
    $adminKey = NULL ;
    if(isset($_SESSION['login']) && $_SESSION['login']==true){
        $logedin = true;
        $adminId = $_SESSION['admin_id'];
        $adminKey = $_SESSION['admin_key'];
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Boot strap CDN link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font awsom icons link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Option 1: Include in HTML -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <script src="https://use.fontawesome.com/your-embed-code.js"></script>

    <!-- website CSS link -->
    <link rel="stylesheet" href="components/CSS/style.css">

    <title>Teachers Arrangement App</title>
   
</head>
<body>

    <?php
        require"components/HTML/navbar.php";    // importing navbar file 
        require"components/HTML/signup.php";    // importing signup modal
        require"components/HTML/logout.php";    // importing Logout modal
        require"components/PHP/alerts.php";     // importing alerts file of the screen           

            if($logedin){
                // echo "session started<br>";
                // echo "Mr.".$_SESSION['user']."<br>";
                // echo "contact".$_SESSION['contact']."<br>";
                // echo "location".$_SESSION['location']."<br>";
                // echo "register date".$_SESSION['date']."<br>";
            }      

        ?>
    
     <!-- in this container the login form and starting fom banner is placed -->
     
    <?php
       if(!$logedin){
        echo
        '
         <div class="container logincontainer"> 
            <div class="banner">
                <img src="components/sources/time_table.gif" alt=""> <!--baner animation of front page-->
            </div>
            <div class="loginform">
                <h1 class="p-3">Log In</h5>
                ';
                require"components/HTML/login.php";   // importing login form 
        echo'        
            </div>
         </div>
        ';
       }
    ?>

    <!-- time table starts here -->

    <?php
        if($logedin){
        echo '
        
            <div class="container  mt-5 tablebox">

                <!-- header row -->
                <div class="trowHead" id="thead" >
                <div class="tnamehead">Teacher</div>
                <div class="pdh pd">Pd - I</div>
                <div class="pdh pd">Pd - II</div>
                <div class="pdh pd">Pd - III</div>
                <div class="pdh pd">Pd - IV</div>
                <div class="pdh pd">Pd - V</div>
                <div class="pdh pd">Pd - VI</div>
                <div class="pdh pd">Pd - VII</div>
                <div class="pdh pd">Pd - VII</div>
                <div class="pdh pd">Mark</div>
                
                </div>
                <!-- Table body -->

                <div class="tbody">
        ';
    
        // fetching data from the timeTable Table in database
    $get = "SELECT * FROM `timetable` WHERE admin_key = '$adminKey'";
    $run = mysqli_query($con,$get);
    $row_id = 1;
        while($row = mysqli_fetch_assoc($run)){

            // getting present details of teacher
            $teacherID = $row['teacher_id'];
            $Getteacher = "SELECT * FROM `teacher_info` WHERE teacher_id = '$teacherID'";
            $run_GetteacherID = mysqli_query($con,$Getteacher);
            $teacher_row = mysqli_fetch_assoc($run_GetteacherID);
            $isPresent = $teacher_row['available'];  // to set the ID of each row of the table so that it can be accessed in DOM easily

            // Teachers Row Starts here
            if($isPresent){
                // changing class of time table row if teacher is present 
                echo '
                <div class="trowPresent" id="'.$row_id.'" >
                ';
            }else{
                // changing class of time table row if teacher is Absent 
                echo '
                <div class="trowAbsent" id="'.$row_id.'" >
                ';
                
            }
            
            echo '
                    <div class=" tname">'.$row["teacher_id"].'
                        
                        <!-- <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"></span> -->
                    </div>
                    <div class="pd">'.$row["pd_1"].'</div>
                    <div class="pd">'.$row["pd_2"].'</div>
                    <div class="pd">'.$row["pd_3"].'</div>
                    <div class="pd">'.$row["pd_4"].'</div>
                    <div class="pd">'.$row["pd_5"].'</div>
                    <div class="pd">'.$row["pd_6"].'</div>  
                    <div class="pd">'.$row["pd_7"].'</div>
                    <div class="pd">'.$row["pd_8"].'</div>

                    <div class="attendanceBtnBox pd" id="attendanceBtnBox">    
                        <button type="button" class="btn btn-outline-info editT" id="EditTimeTableBtn" data-bs-toggle="offcanvas" data-bs-target="#editT'.$row["teacher_key"].'"><i class="fa fa-pencil" style="font-size:18px"></i></button>
                        ';

                        if($isPresent){
                            echo '
                            <!-- Form to update teachers Presence in data base -->
                                <form class="attendanceform" action="components/PHP/UpdatePresence.php" method="post" >
                                
                                    <!-- this input is used send ID of teacher to which is to be updated -->
                                    <input type="hidden" name="UpdateID" id="EditTeacherID" value="'.$row["teacher_id"].'" hidden>
                                    <!-- this input is used send whether a teacher is absent or present  -->
                                    <!-- <input type="hidden" name="Present" id="MarktInput" value="'.$isPresent.'" > -->
                                    <button type="submit" name="present"  value="'.$isPresent.'"  class="btn btn-outline-info editT present attendanceBtn" id="present'.$row_id.'" >P</button>
                                </form>
                         </div>
                             ';
                    
                        }else{
                                    echo '
                                    <!-- Form to update teachers Presence in data base -->
                                        <form class="attendanceform" action="components/PHP/UpdatePresence.php" method="post" >
                                        
                                            <!-- this input is used send ID of teacher to which is to be updated -->
                                            <input type="hidden" name="UpdateID" id="EditTeacherID" value="'.$row["teacher_id"].'" hidden>
                                            <!-- this input is used send whether a teacher is absent or present  -->
                                            <!-- <input type="hidden" name="Present" id="MarktInput" value="'.$isPresent.'" hidden> -->
                                            <button type="submit" name="present" value="'.$isPresent.'"  class="btn btn-outline-info editT absent attendanceBtn" id="present'.$row_id.'" >A</button>
                                        </form>
                                </div>
                            ';
                                    
                                }

                    $row_id++;

                        //  Edit time table offcanva form to update teachers timetable 
            echo '            
                
                        <div class="offcanvas offcanvas-top time_table_offcanva" tabindex="-1" id="editT'.$row["teacher_key"].'" aria-labelledby="offcanvasTopLabel">
                        <div class="offcanvas-header">
                            <h5 id="offcanvasTopLabel">'.$row["teacher_id"].'</h5>
                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                        </div>
                        <div class="offcanvas-body">
                            <!-- Offcanva forrm to update teachers time table -->
                            <form class="editTimetableForm" action="components/PHP/addteacherTimeTbl.php" method="post" >

                                <!-- this input is used send ID of teacher to which is to be updated -->
                                <input type="text" name="EditTeacherID" id="EditTeacherID" value="'.$row["teacher_id"].'" hidden>

                             <div class="pdlist">

                                <select class="arrange" name="Ist" id="Ist">
                                <option value="Free">Free</option>
                                ';
                                $getClass = "SELECT * FROM `class_list` WHERE admin_key = '$adminKey'";
                                $runClass = mysqli_query($con,$getClass);
                        
                                while($Class = mysqli_fetch_assoc($runClass)){  
                                //  echo"<br>". $Class['Class'];
                                echo'
                                <option value="'.$Class['Class'].$Class['section'].'">'.$Class['Class'].$Class['section'].'</option>
                                    ';
                                }

                        echo '
                                </select>

                                <select class="arrange" name="IInd" id="IInd">
                                <option value="Free">Free</option>

                                ';
                                $runClass = mysqli_query($con,$getClass);
                                while($Class = mysqli_fetch_assoc($runClass)){
                                    //  echo"<br>". $Class['Class'];
                                    echo'
                                    <option value="'.$Class['Class'].$Class['section'].'">'.$Class['Class'].$Class['section'].'</option>
                                        ';
                                    
                                    }

                        echo '
                            </select>
                            <select class="arrange" name="IIIrd" id="IIIrd">
                            <option value="Free">Free</option>
                            ';
                            $runClass = mysqli_query($con,$getClass);
                            while($Class = mysqli_fetch_assoc($runClass)){
                                //  echo"<br>". $Class['Class'];
                                echo'
                                <option value="'.$Class['Class'].$Class['section'].'">'.$Class['Class'].$Class['section'].'</option>
                                    ';
                                
                                }

                        echo'        
                            </select>
                            <select class="arrange" name="IVth" id="IVth">
                            <option value="Free">Free</option>
                            ';
                            $runClass = mysqli_query($con,$getClass);
                            while($Class = mysqli_fetch_assoc($runClass)){
                                //  echo"<br>". $Class['Class'];
                                echo'
                                <option value="'.$Class['Class'].$Class['section'].'">'.$Class['Class'].$Class['section'].'</option>
                                    ';
                                
                                }
                        echo '
                            </select>
                            <select class="arrange" name="Vth" id="Vth">
                            <option value="Free">Free</option>
                            ';
                            $runClass = mysqli_query($con,$getClass);
                            while($Class = mysqli_fetch_assoc($runClass)){
                                //  echo"<br>". $Class['Class'];
                                echo'
                                <option value="'.$Class['Class'].$Class['section'].'">'.$Class['Class'].$Class['section'].'</option>
                                    ';
                                
                                }
                        echo '
                            </select>
                            <select class="arrange" name="VIth" id="VIth">
                            <option value="Free">Free</option>
                            ';
                            $runClass = mysqli_query($con,$getClass);
                            while($Class = mysqli_fetch_assoc($runClass)){
                                //  echo"<br>". $Class['Class'];
                                echo'
                                <option value="'.$Class['Class'].$Class['section'].'">'.$Class['Class'].$Class['section'].'</option>
                                    ';
                                
                                }
                        echo '
                            </select>
                            <select class="arrange" name="VIIth" id="VIIth">
                            <option value="Free">Free</option>
                            ';
                            $runClass = mysqli_query($con,$getClass);
                            while($Class = mysqli_fetch_assoc($runClass)){
                                //  echo"<br>". $Class['Class'];
                                echo'
                                <option value="'.$Class['Class'].$Class['section'].'">'.$Class['Class'].$Class['section'].'</option>
                                    ';
                                
                                }
                        echo '
                            </select>
                            <select class="arrange" name="VIIIth" id="VIIIth">
                            <option value="Free">Free</option>
                            ';
                            $runClass = mysqli_query($con,$getClass);
                            while($Class = mysqli_fetch_assoc($runClass)){
                                //  echo"<br>". $Class['Class'];
                                echo'
                                <option value="'.$Class['Class'].$Class['section'].'">'.$Class['Class'].$Class['section'].'</option>
                                    ';
                                
                                }   

                        echo '
                            </select>
                                
                            </div>

                            <button type="submit" class="btn btn-outline-success">Update</button>
                            </form>
                        </div>
                        </div>
                
                    </div>
            ';

        }
        echo '
        </div>
        </div>
        ';
    }
  ?>


</body>

<?php
    if($logedin){
        // echo 'bottom script';
    
          echo '
          <script>
                let loginbtn = document.getElementById("loginbtn");
                loginbtn.textContent = "LogOut";
                loginbtn.id = "logoutbtn";
                let signupbtn = document.getElementById("signupbtn");                             
                // signupbtn.remove();
                signupbtn.style.visibility = "hidden";
                // console.log(loginbtn);
                // console.log(lounch);
                document.getElementById("logoutbtn").addEventListener("click",(e)=>{
                document.getElementById("logout_modal_btn").click();
            });

         </script>
         ';
    }
?>

<script>
// javascript for arrangement algorithm Starts here
            class vacant{
                fill(ID,name,pd,pd_class,arranged){
                    this.t_row_id = ID;
                    this.t_name = name;
                    this.pd = pd;
                    this.pd_class = pd_class;
                    this.arranged = arranged;
                }
            }
            class fillPD{                   
                fill(pd,cls,arranged){
                    this.pd = pd;
                    this.pd_class = cls;
                    this.arranged = arranged;
                }
            }
            class teachers_A{
                
                absent(name,ID,arr,PD_class){
                this.name = name;
                this.row_num_id = ID;
                this.PD_array_fill = arr;
                
                }
            }
            class teachers_P{
                
                present(name,ID,arr,arranged){
                this.name = name;
                this.row_num_id = ID;
                this.PD_array_free = arr;
                this.arranged = arranged;
                }
            }
        
            const absent_array = [];        // array to store absent teachers
            const present_array = [];       //array to store present teachers

            
         
</script>

<?php
    $teacherCountSql = "SELECT *FROM `teacher_info` WHERE `admin_id` = '$adminId'";
    $runCount = mysqli_query($con,$teacherCountSql);
    $teacherCount = mysqli_num_rows($runCount);
    // echo $teacherCount ;
    $i = 1;
    while($i <= $teacherCount){
        
        echo '
        <script>
           
        let row_'.$i.' = document.getElementById("'.$i.'");
        let presentBtn'.$i.' = document.getElementById("present'.$i.'");
        
        if(!("P").localeCompare(presentBtn'.$i.'.textContent)){
            
            let teacher_name_'.$i.' = row_'.$i.'.children[0].textContent;
            let P_free_pd_arr_'.$i.' = [];
            let j = 1;
            while(j <= 8){
                let pd_value = document.getElementById("'.$i.'").children[j].textContent;
                if(!(pd_value.localeCompare("Free"))){
                    // P_free_pd_arr_'.$i.'.push(j);

                    let fill_pd'.$i.' = new fillPD();
                    fill_pd'.$i.'.fill(j,false,false);
                    P_free_pd_arr_'.$i.'.push(fill_pd'.$i.'); 
                   
                }
                j++;
            }
            let P_teacher_'.$i.' = new teachers_P();
            P_teacher_'.$i.'.present(teacher_name_'.$i.','.$i.',P_free_pd_arr_'.$i.',false);
            present_array.push(P_teacher_'.$i.');

            
        }else{
            
            let teacher_name_'.$i.' = row_'.$i.'.children[0].textContent;
            let A_fill_pd_arr_'.$i.' = [];
            // let A_fill_class_arr_'.$i.' = [];
            let A_teacher_'.$i.' = new teachers_A();
            
            let j = 1;
            while(j <= 8){
                let pd_value = document.getElementById("'.$i.'").children[j].textContent;
                if(pd_value.localeCompare("Free")){
                    // A_fill_class_arr_'.$i.'.push(pd_value);
                    
                    let fill_pd'.$i.' = new fillPD();
                    fill_pd'.$i.'.fill(j,pd_value,false);
                    A_fill_pd_arr_'.$i.'.push(fill_pd'.$i.'); 
                    
                }
                j++;
            }
            
            A_teacher_'.$i.'.absent(teacher_name_'.$i.','.$i.',A_fill_pd_arr_'.$i.');
            absent_array.push(A_teacher_'.$i.'); 
        }       

        </script>
        ';
        $i++;
    }

?>
<script>

// console.log(present_array);
// console.log(absent_array);

     

            function arrange_teachers(teachers_A, teachers_P){

                let length_A = teachers_A.length;       // length of absent array
                let length_P = teachers_P.length;       // length of present array
                let count_A = 0;

                while(count_A < length_A){        //iteration in absent array
                    let absent_teacher = absent_array[count_A];
                //    console.log(absent_teacher);

                   let count_i = 0;         

                   while(count_i < absent_teacher.PD_array_fill.length){            //iterating in absent teacher fill_pd_arr
                    let fill_pd = absent_array[count_A].PD_array_fill[count_i];     //current pd to be filled
                    // console.log(absent_teacher.PD_array_fill.length[count_i]);
                    // console.log("fill this pd of- "+absent_teacher.name);
                    // console.log(fill_pd);

                    let count_P = 0;

                    while(count_P < present_array.length){          //iterating in present teacher array
                        let present_teacher = present_array[count_P];   // current present teacher array
                        // console.log(present_teacher);
                        
                        let count_j = 0;
                        // console.log("from these " + present_teacher.name );
                        while(count_j < present_array[count_P].PD_array_free.length){       //iterating in present teachers free_pd array
                            let cur_free_pd = present_array[count_P].PD_array_free[count_j];
                            // console.log(cur_free_pd);

                            if((fill_pd.pd == cur_free_pd.pd && cur_free_pd.pd_class == false) && fill_pd.arranged == false){       // check if present teacher is available to arrange or not 
                                present_array[count_P].PD_array_free[count_j].pd_class = fill_pd.pd_class;          // assign class to the teacher if available
                                present_array[count_P].arranged = true;     // mark this pd is arranged
                                present_array[count_P].PD_array_free[count_j].arranged = true;  
                                absent_array[count_A].PD_array_fill[count_i].arranged = true;

                                // break the loop because vacant pd assigned to an available teacher
                                break;
                            }                       

                            count_j++;
                        }

                        count_P++;
                    }

                    count_i++;
                   }

                count_A++;
                }

            }
            arrange_teachers(absent_array,present_array);
            // console.log(present_array);
            // console.log(absent_array);

            let count_P = 0;

            while(count_P < present_array.length){          //iterating in present teachers array
                if(present_array[count_P].arranged){        // check if a teacher is arranged or not 
                    let cur_row = present_array[count_P];
                    // console.log(cur_row);

                    let count_i = 0;

                    while(count_i < present_array[count_P].PD_array_free.length){       //iterating in present teacher free pd array
                        let cur_pd = present_array[count_P].PD_array_free[count_i];
                        // console.log(cur_pd);
                        if(cur_pd.arranged){                // check if the current PD is arranged or not 
                            let arrange_row = document.getElementById(cur_row.row_num_id);  //getting the ror of the arranged teacher
                            // console.log(arrange_row.children[cur_pd.pd]);
                            arrange_row.children[cur_pd.pd].textContent = cur_pd.pd_class   //set the arranged class for the arranged pd
                            arrange_row.children[cur_pd.pd].style.backgroundColor = "yellow";  //change colour of the arranged pd
                            arrange_row.children[cur_pd.pd].style.border = "1px solid green";  //change colour of the arranged pd
                        }
                        count_i++;
                    }
                }
                count_P++;
            }

            let count_A = 0;
            while(count_A < absent_array.length){
                let cur_row = absent_array[count_A];
                console.log(cur_row);

                let count_j = 0;
                while(count_j < cur_row.PD_array_fill.length){
                    let cur_pd = cur_row.PD_array_fill[count_j];
                    // console.log(cur_pd);
                    if(!(cur_pd.arranged)){
                        let unarrange_row = document.getElementById(cur_row.row_num_id);
                        console.log(unarrange_row);
                        unarrange_row.children[cur_pd.pd].style.backgroundColor = "red";
                    }
                    count_j++;
                }
                count_A++;
            }



// function removeItemOnce(arr, value) { // function to remove an element from an array at specific position
//   var index = arr.indexOf(value);
//   if (index > -1) {
//     arr.splice(index, 1);
//   }
//   return arr;
// }


    function showPassword(e){ // To show the password of the login form on checked
        let loginpassword = document.getElementById('loginpassword');
        if(e.checked){
            let password = loginpassword.value;
            loginpassword.type = "text";
            loginpassword.value = password;

            setTimeout(() => {
                let password = loginpassword.value;
                loginpassword.type = "password";
                loginpassword.value = password;
                e.checked = false;
            },2000);

        }else{
            let password = loginpassword.value;
            loginpassword.type = "password";
            loginpassword.value = password;
        }
       
    }
    function openNav() {  // function to open side nav bar
        document.getElementById("mySidenav").style.width = "250px";
    }

    let is_sideNavForm  = 0;  // this will zero if side nav  is off and 1 if side nav form is on 
    function closeNav() {   // function to close side navbar
        document.getElementById("mySidenav").style.width = "0";
       
        if(is_sideNavForm ==1){   // to control the side nav from appearene when we click close button
            let e = document.getElementById("notaddm");  
            
            Memberform(e);
        }   
        if(is_sideNavForm == 2){   // to control the side nav from appearene when we click close button
            let e = document.getElementById("notaddc");  
            
            Classesform(e);
        }   
    }
    
    function Memberform(e){     // function to open side nav add member form

        if(is_sideNavForm == 2){   // check if any form is previously opened before opening new 
            let e = document.getElementById("notaddc");    
            Classesform(e);
        } 

        if(!(e.id.localeCompare("addmember"))){  // localeCompare method return 0 if strings are equal
            document.getElementById("mySidenav").style.width = "100%";
            document.getElementById("navFormBox").style.display = "flex";  
            document.getElementById("addmemberform").style.display = "flex";   
            document.getElementById("membersBox").style.display = "flex";   
            e.id = "notaddm";
            e.textContent = "close <";           
            is_sideNavForm = 1;
            
            
        }else if(!(e.id.localeCompare("notaddm"))){
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("navFormBox").style.display = "none";
            document.getElementById("addmemberform").style.display = "none";
            e.id = "addmember";
            e.textContent = "Add Member";
            is_sideNavForm = 0;
            
        }  
    }
    
    function Classesform(e){    // function to open add classes form in side nav
        if(is_sideNavForm ==1){   // check if any form is previously opened before opening new 
            let e = document.getElementById("notaddm");       
             Memberform(e);
        }
         if(!(e.id.localeCompare("addclasses"))){  // localeCompare method return 0 if strings are equal
    
            document.getElementById("mySidenav").style.width = "100%";
            document.getElementById("navFormBox").style.display = "flex";  
            document.getElementById("addclassform").style.display = "flex";
            document.getElementById("membersBox").style.display = "none";   
            
            e.id = "notaddc";
            e.textContent = "close <";           
            is_sideNavForm = 2;   
            
        }else if(!(e.id.localeCompare("notaddc"))){
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("navFormBox").style.display = "none";
            document.getElementById("addclassform").style.display = "none";
            e.id = "addclasses";
            e.textContent = "Add Classes";
            is_sideNavForm = 0;
            
        }
   }
    
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</html>