<?php
echo'<button type="button" id="logout_modal_btn" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#logoutmodal" hidden>
    
  </button>
  <div class="modal fade" id="logoutmodal" tabindex="-1" aria-labelledby="logoutmodal" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="logoutmodal"><h1>?</h1></h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h6>
          ARE YOU SURE YOU WANT TO LOG OUT ?
          </h6> 
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
          <form action="/Arrangement App/components/PHP/logout.php" method="post">
            <button type="submit" id="confirm_logout"  class="btn btn-outline-success">Yes</button>
          </form>
        </div>
      </div>
    </div>
  </div>';
?>