<?php

require_once('../../private/initialize.php');

require_login();

$id = $session->member_id ?? ''; // PHP > 7.0
$member = Member::find_by_id($id);

?>

<?php include(SHARED_PATH . '/member_header.php'); ?>

<?php echo display_errors($errors); ?>

<div class="row mt-4">
  <div class="col-sm-3 mr-7">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Show Profile</h5>
        <a class="action" href="<?php echo url_for('/member/showprofile.php'); ?>">View Profile</a>
      </div>
    </div>
  </div>	
  <div class="col-sm-3 ml-5">
    <div class="card">
      <div class="card-body">
        <h5 class="card-title">Edit Profile</h5>
        <a class="action" href="<?php echo url_for('/member/editprofile.php'); ?>">Edit Profile</a>
      </div>
    </div>
  </div>	
</div>

<?php include(SHARED_PATH . '/member_footer.php'); ?>