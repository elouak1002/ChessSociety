<?php

require_once('../../../private/initialize.php');

require_staff_login(); 

if ($session->role != "admin") {
	redirect_to(url_for('/staff/members/index.php'));
}

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/members/index.php'));
}

$id = $_GET['id'] ?? '1';
$member = Member::find_by_id($id);

if($member == false || $member->get_role() != "member") {
  redirect_to(url_for('/staff/members/index.php'));
}

if(is_post_request()) {

  $member->role = 2;
  $member->save();
  $session->message('The Member was promoted successfully.');
  redirect_to(url_for('/staff/members/index.php'));

} else {
  // Display form
}

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/index.php'); ?>">&laquo; Back to List</a>

  <div class="members demote">
    <h1>Promote member</h1>
    <p>Are you sure you want to promote this member?</p>

    <form action="<?php echo url_for('/staff/members/promote.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
	  <button type="submit" class="btn btn-danger" style="margin-bottom: 10px;">Promote Member</button>
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
