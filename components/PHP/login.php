<?php
    require"connection.php";

    if($_SERVER['REQUEST_METHOD'] == "POST"){
   
        
        $loginuserID = $_POST['loginuserID'];
        $loginpassword= $_POST['loginpassword'];

        $user = "SELECT * FROM `admin` WHERE `user_id`='$loginuserID'";
        $run_user = mysqli_query($con,$user);
        $num_rows = mysqli_num_rows($run_user);

        if($num_rows==0){       //check if user ID is exist or not
            echo "<br>$loginuserID does not exist<br>";

            $userID = false;                        
            header("location:../../index.php?userID=$err");
            
        }elseif($num_rows==1){          // check for user is only one
            $user = mysqli_fetch_assoc($run_user);
            $password_hash = $user['password'];

            $verified = password_verify($loginpassword, $password_hash);
            
              

            if($verified){          //check if passeord is correct or not and then log in the user
                
                // INSERT INTO `admin` (`key_id`, `user_id`, `location`, `contact_no`, `password`, `date`) VALUES (NULL, 'harsh', 'zzn', '554544', '', current_timestamp())
                
                session_start();    //starting the session 
                $_SESSION['login'] = true;
                $_SESSION['user'] = $user['user_id'];
                $_SESSION['admin_id'] = $user['user_id'];
                $_SESSION['admin_key'] = $user['admin_key'];
                $_SESSION['location'] = $user['location'];
                $_SESSION['contact'] = $user['contact_no'];
                $_SESSION['date'] = $user['date'];

                $login = true;
                header("location:../../index.php?login=$login");
            }else{
                $password = false;
                header("location:../../index.php?login=$password");
                                
            }
            
        }
      
      
    }
?>