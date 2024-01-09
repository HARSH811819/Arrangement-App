<?php

    echo '
        <form class="w-75 " action="/Arrangement App/components/PHP/login.php" method="post">
            <!--this url is not working for post request-->
        <!-- <form class="w-75 " action="../PHP/login.php" method="post">  -->

            <div class="mb-3">
                <label for="loginuserID" class="form-label">User ID</label>
                <input type="text" class="form-control" id="loginuserID" name="loginuserID" aria-describedby="userID" required>
                <div id="userID" class="form-text">Your admin User ID</div>
            </div>

            <div class="mb-3">
                <label for="loginpassword" class="form-label">Password</label>
                <input type="password" class="form-control" name="loginpassword" id="loginpassword" required>
            </div>

            <div class="mb-3 form-check">
                <input type="checkbox"  class="form-check-input" onchange="showPassword(this)" id="showpassword">
                <label class="form-check-label" for="showpassword">show password</label>
            </div>

            <button type="submit" class="btn btn-outline-info float-end">Submit</button>
            
        </form>
    ';
?>