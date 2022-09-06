<?php

require_once('../../../private/initialize.php');

require_staff_login(); 

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/tournaments/index.php'));
}
$id = $_GET['id'] ?? '1';
$tournament = Tournament::find_by_id($id);

if (!$tournament->is_organiser($session->member_id)) {
  redirect_to(url_for('/staff/tournaments/index'));
}

if($tournament == false) {
  redirect_to(url_for('/staff/tournaments/index.php'));
}

if(is_post_request()) {

  // Delete bicycle
  $result = $tournament->delete();
  $session->message('The Tournament was deleted successfully.');
  redirect_to(url_for('/staff/tournaments/index.php'));

} else {
  // Display form
}

?>

<?php $page_title = 'Delete Tournament'; ?>
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/tournaments/index.php'); ?>">&laquo; Back to List</a>

  <div class="tournament delete">
    <h1>Delete Tournament</h1>
    <p>Are you sure you want to delete this tournament?</p>

    <form action="<?php echo url_for('/staff/tournaments/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
	  <button type="submit" class="btn btn-danger" style="margin-bottom: 10px;">Delete Tournament</button>
      </div>
    </form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
