
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "arrangement app";

    $con  = mysqli_connect($servername,$username,$password,$database);

    if($con){
        // echo "connected";
    }else{
        echo "Not connected";

    }

?>
<?php
//    require"../PHP/connection.php";

echo '<nav class="navbar">
    <div class="logo userinfo  navblock">';
        
    if($logedin){
        echo '
            <div class="userimgbox" onclick="openNav()"  >  <!-- outer box of user image-->
             <img class="image" src="components/sources/profile image.png" alt="">
             </div>
            <div class="usernamebox">  <!-- outer box of username-->
               
                <h6 class="username" >harsh</h6>
            </div>  
        ';
    }else{
        echo '
            <div class="sidenavbtnbox" onclick="openNav()"  >  <!-- outer box of user image-->
                <i class="fa fa-bars"  style="font-size:20px;"></i>  <!-- Button for side Nav bar slide when user is not loged in-->
             </div>
            
        ';

    }
echo'    
    </div>

    <div class="navbarLinkbox">
        
        <a id="Home" class="navLink" href="/Arrangement App/index.php">Home</a>
        <a id="Contact" class="navLink" href="#">Contact Us</a>
        <a id="About" class="navLink" href="#">About</a>

    </div>    
    <div class="user  navblock">
        <!-- <a id="navLink" href="components/PHP/signup.php">Sign Up</a> -->
        <!-- <button id="navLink">Sign Up</button> -->
        <button type="button" id="signupbtn" class="navLink" data-bs-toggle="modal" data-bs-target="#SignUpForm"
        data-bs-whatever="@mdo" >Sign Up </button>
        <button id="loginbtn" class="navLink">Login</button>
        <!-- <a id="navLink" href="#">Log In</a> -->
        
    </div>
</nav>';

// Side nave collapsed navbar starts here 

echo'
    <div id="mySidenav" class="sidenav">    <!--side navebar open when click on user button-->
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        
        <div class="sideNavLinkbox">
            <!-- <a href="#">About</a>
            <a href="#">Services</a>
            <a href="#">Clients</a>
            <a href="#">Contact</a> -->
            <a id="Home" class="navLink" href="/Arrangement App/index.php">Home</a>
            <a id="Contact" class="navLink" href="#">Contact Us</a>
            <a id="About" class="navLink" href="#">About</a>
            ';

            if($logedin){

                echo'
                <!-- click on this button to add new member  -->
                <button class="addmemberbtn" id="addmember" type="button" onclick="Memberform(this)">Add Members</button> 
                <!-- click on this button to add new member  -->
                <button class="addclassesbtn" id="addclasses" type="button" onclick="Classesform(this)">Add Classes</button> 
                ';
            }

            //  form to add new members
            echo '
        </div>

        <div class="navFormBox" id="navFormBox" >   <!-- side nave bar outer form box -->

            <!--this action url is not working for post request-->
            <!-- <form class="border  addMemberForm " action="../PHP/addmember.php" method="post">             -->
                <form class="border  addMemberForm " id="addmemberform" action="/Arrangement App/components/PHP/addmember.php" method="post">            

                        <div class="input-group mb-3">

                            <span class="input-group-text" id="basic-addon1">Name</span>
                            <input type="text" id="name" name="name" class="form-control" placeholder="Name" aria-label="Name" aria-describedby="basic-addon1" required>

                            <span class="input-group-text" id="basic-addon1">Teacher ID</span>
                            <input type="text" id="teacherId" name="teacherId" class="form-control" placeholder="Teacher ID" aria-label="" aria-describedby="basic-addon1" required>

                        </div>

                        <div class="input-group mb-3">

                            <span class="input-group-text" id="basic-addon1">Role</span>
                            <input type="text" id="role" name="role" class="form-control" placeholder="Role : (e.g. subject teacher, lab teacher)" aria-label="Name" aria-describedby="basic-addon1" required>

                            <span class="input-group-text" id="basic-addon1">Password  </span>
                            <input type="password" id="teacherPassword" name="teacherPassword" class="form-control" placeholder="Password" aria-label="" aria-describedby="basic-addon1" required>

                        </div>
                        <div class="w-100 d-flex justify-content-center">

                            <button type="submit" class="btn btn-outline-primary w-50 ms-2">Add Member</button>


                        </div>
                        <p>_______________________________________________________________________________________________</p>
                </form>'; 


              //add class list
              echo'
           

              
                <form class="border  addMemberForm addClasses" id="addclassform" action="/Arrangement App/components/PHP/addclasses.php" method="post">            

                        <div class="input-group mb-3">

                            <span class="input-group-text"  id="basic-addon1">Class </span>
                            <input type="text" id="classname" name="classname" class="form-control" onkeydown="return /[a-z]/i.test(event.key)" placeholder="Class" aria-label="Name" aria-describedby="basic-addon1" required>

                            <span class="input-group-text" id="basic-addon1">Section</span>
                            <input type="text"  id="classsec" name="classsec" class="form-control" placeholder="Section" aria-label="" aria-describedby="basic-addon1" required>

                        </div>

                      
                        <div class="w-100 d-flex justify-content-center">

                            <button type="submit" class="btn btn-outline-primary w-50 ms-2">Add Class</button>


                        </div>
                        <p>_______________________________________________________________________________________________</p>
                </form>'; 
              
              
              // Members list will shown here
              $get = "SELECT * FROM `teacher_info` WHERE admin_key = '$adminKey'";
              $run = mysqli_query($con,$get);
                
              echo'

            <div class="membersBox" id="membersBox">
         
                ';

                while($row = mysqli_fetch_assoc($run)){
                  //  <!-- echo $row['teacher_id'] ." =>  ". $row['teacher_key']."<br>";
                    // echo $row['teacher_id']."<br>"; -->
                    echo'
                    <div class="input-group mb-3 member">
                        <button type="button" class="btn btn-success memberName">
                            '.$row['teacher_name'].'
                            <span class="badge bg-warning">4</span>
                            <span class="badge bg-danger">4</span>
                            <span class="position-absolute top-0 start-100 translate-middle p-2 bg-danger border border-light rounded-circle"></span>
                        </button>      
                        <div  class="form-control memberInfo border border-success" id="basic-url" aria-describedby="basic-addon3">
                            
                            <button type="button" class="editMember memberbtn" id="editMember"><i class="fa fa-pencil" style="font-size:24px"></i></button>
                            <button type="button" class="deleteMember memberbtn" id="deleteMember" ><i class="fa fa-trash-o" style="font-size:24px"></i></button>
                        </div>
    
                    </div>

                    
    
                    ';
                }

        


                echo'


             </div>

       

        </div>
    </div>

    <!-- Use any element to open the sidenav -->
  

    ';

?>