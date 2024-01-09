<?php

  echo'<button type="button" id="signup_modal_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#SignUpForm"
    data-bs-whatever="@mdo" hidden>Sign Up </button>

  <div class="modal fade" id="SignUpForm" tabindex="-1" aria-labelledby="signupMadalLable" aria-hidden="false">
    <div class="modal-dialog">
      <div class="modal-content">

        <div class="modal-header">
          <h5 class="modal-title" id="signupMadalLable">Sign Up </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <form id="signupForm" action="/Arrangement App/components/PHP/signup.php"  method="post">
          <!-- <form id="signupForm" action="/Arrangement App/index.php"  method="POST"> -->

            <div class="mb-3">
              <label for="UserID" class="col-form-label">User ID :</label>
              <input type="text" name="userID" class="form-control" id="userID" aria-required="true">
            </div>

            <div class="mb-3">
              <label for="Location" class="col-form-label">Location :</label>
              <input type="text" name="location" class="form-control" id="location">
            </div>

            <div class="mb-3">
              <label for="Contact_No" class="col-form-label">Contact No:</label>
              <input type="number" name="contactNo" class="form-control" id="contactNo">
            </div>

            <div class="mb-3">
              <label for="Password" class="col-form-label">Password :</label>
              <input type="password" name="password" class="form-control" id="password">
            </div>
          
            <div class="mb-3">
              <label for="confirmPassword" class="col-form-label"> Confirm Password :</label>
              <input type="password" name="confirmPassword" class="form-control" id="confirmPassword">
            </div>

            <div class="modal-footer">
            <button type="submit" id="submitbtn" class="btn btn-primary" data-bs-dismiss="modal">Submit</button>
            <!-- <button type="button" id="submitbtn2" class="btn btn-primary" onclick="handlesignup(this)" data-bs-dismiss="modal">Submit 2</button> -->

            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
            
          </form>

        </div>

      </div>
    </div>
  </div>';
?>