<?php
     if (isset($_GET['blankfield']) && $_GET['blankfield'] == true) {   // error for blank field

        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>! All fields are compulsory</strong> please fill all the fields of form
        <button type="button" id="signupAlert" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

          echo '<script>A
            
            setTimeout(() => {
             let signupAlert = document.getElementById("signupAlert");
             signupAlert.click();
            //  console.log(signupAlert);
            },3000);
         </script>';
    }
    if (isset($_GET['password_match']) && $_GET['password_match'] == false) {    // error for unmatch password with confirm password

        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>! password is not matched </strong> confirm password should be same as password
        <button type="button" id="password_alert" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

          echo '<script>
            
            setTimeout(() => {
             let password_alert = document.getElementById("password_alert");
             password_alert.click();
            //  console.log(password_alert);
            },3000);
         </script>';
    }
    if (isset($_GET['duplicate']) && $_GET['duplicate'] == true) {    // alert if user exist with the given username
   
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> User Exist </strong> Try some different UserID
        <button type="button" id="duplicate" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

          echo '<script>
            
            setTimeout(() => {
             let duplicate = document.getElementById("duplicate");
             duplicate.click();
            //  console.log(duplicate);
            },3000);
         </script>';
    }
    if (isset($_GET['signup']) && $_GET['signup'] == true){    // confirmation message for signup
   
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong> You have Signed Up </strong> You can login now
        <button type="button" id="signedUp" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

          echo '<script>
            
            setTimeout(() => {
             let signedUp = document.getElementById("signedUp");
             signedUp.click();
            //  console.log(signedUp);
            },3000);
         </script>';
    }

    else if(isset($_GET['signup']) && $_GET['signup'] == false) {    // alert if user is unique but sign up data is not stored in database

   
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong> ! something went wrong  </strong> Please try again
        <button type="button" id="signedup_deny" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';

          echo '<script>
            
            setTimeout(() => {
             let signedUp = document.getElementById("signedup_deny");
             signedup_deny.click();
            //  console.log(signedup_deny);
            },3000);
         </script>';
    }



    // LOG IN errors and messages

    if (isset($_GET['userID']) && $_GET['userID'] == false) {    // warning for Incorrect User ID
   
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> User ID is Incorrect </strong> Please Check the user ID or Sign Up to Continue
        <button type="button" id="wronguser" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    
          echo '<script>
            
            setTimeout(() => {
             let wronguser = document.getElementById("wronguser");
             wronguser.click();
            //  console.log(wronguser);
            },4000);
         </script>';
    }
    if (isset($_GET['login']) && $_GET['login'] == true) {    // messege for user is loged in with the given user ID
                                                                //Script for login btn and logoutbtn
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong> User ID is logedin </strong> Welcome to Arrangement App
        <button type="button" id="logedin" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    
          echo '<script>
            
            setTimeout(() => {
             let logedin = document.getElementById("logedin");
             logedin.click();
            //  console.log(logedin);
            },3000);

         </script>';
    }


  

    if (isset($_GET['login']) && $_GET['login'] == false) {    // Warning for incorrect password
    
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong> ! Incorrect password </strong> Please check your password 
        <button type="button" id="logedin" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
    
          echo '<script>
            
            setTimeout(() => {
             let logedin = document.getElementById("logedin");
             logedin.click();
            //  console.log(logedin);
            },3000);

          

         </script>';
    }
?>