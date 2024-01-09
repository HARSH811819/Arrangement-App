<?php

    require "connection.php";  //connecting with database


     if($_SERVER['REQUEST_METHOD'] == "POST"){ 
         
         $userID = $_POST['userID'];
         $location = $_POST['location'];
         $contactNo = $_POST['contactNo'];
         $password = $_POST['password'];
         $Cpassword = $_POST['confirmPassword'];
         $password_hash = password_hash($_POST['password'], PASSWORD_DEFAULT);  // creating hash of the password
         
         
         
            if(!strlen(trim($userID)) || !strlen(trim($location)) || !strlen(trim($contactNo)) || !strlen(trim($password)) || !strlen(trim($Cpassword))){   // check for no any field of form is empty of contains only blank spaces
             
             $err = true;
             header("location:../../index.php?blankfield=$err");
             
            }elseif(strcmp($password,$Cpassword) != 0){   // check for password and confirm password are same
                
                $err = false;
                header("location:../../index.php?password_match=$err");
                
            }else{
                
                $check = "SELECT * FROM `admin` WHERE `user_id`='$userID'";
                $run_check = mysqli_query($con,$check);
                $num_rows = mysqli_num_rows($run_check);
                
                
                if(mysqli_num_rows($run_check) > 0){  // checking for if user ID is duplicate or not 

                    $err = true;
                    header("location:../../index.php?duplicate=$err");
                }else{
                    $create_user = "INSERT INTO `admin` (`admin_key`, `user_id`, `location`, `contact_no`, `password`,`date`) VALUES (NULL, '$userID', '$location', '$contactNo', '$password_hash',current_timestamp())";  // creating a new user in database

                    // INSERT INTO `admin` (`key_id`, `user_id`, `location`, `contact_no`, `password`, `date`) VALUES (NULL, 'harsh', 'zzn', '554544', '', current_timestamp())
                    $run = mysqli_query($con,$create_user);
                    
                   
                    if($run){    //check if data is inserted in database or not
        
                        
                        $signup = true;
                        header("location:../../index.php?signup=$signup");
                       
                    }else{      
                        $signup = false;
                        header("location:../../index.php?signup=$signup");
                        
                    }
                }
                
            }   


    }

?>


