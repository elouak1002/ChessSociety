<?php

require_once('../../../private/initialize.php');

require_staff_login(); 


if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/tournaments/index.php'));
}
$id = $_GET['id'];
$tournament = Tournament::find_by_id($id);

if (!$tournament->is_organiser($session->member_id)) {
  redirect_to(url_for('/staff/tournaments/index'));
}

if($tournament == false) {
  redirect_to(url_for('/staff/tournaments/index.php'));
}

if(is_post_request()) {

  // Save record using post parameters
  $args = $_POST['tournament'];
  $tournament->merge_attributes($args);
  $result = $tournament->save();

  if($result === true) {
    $session->message('The Tournament was updated successfully.');
    redirect_to(url_for('/staff/tournaments/show.php?id=' . $id));
  } else {
    // show errors
  }

} else {

  // display the form

}

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/tournaments/index.php'); ?>">&laquo; Back to List</a>

  <div class="Tournament edit">
    <h1>Edit Tournament</h1>

    <?php echo display_errors($tournament->errors); ?>

    <form action="<?php echo url_for('/staff/tournaments/edit.php?id=' . h(u($tournament->id))); ?>" method="post">

	<div class="form-group">
		<label>Name</label>
		<input type="text" class="form-control" name="tournament[name]" value="<?php echo ($tournament->name) ?>">
	</div>
	
	<div class="form-group">
		<label>Date</label>
		<input type="date" class="form-control" name="tournament[date]" value="<?php echo ($tournament->date) ?>">
	</div>
	
	<div class="form-group">
		<label>Deadline</label>
		<input type="date" class="form-control" name="tournament[deadline]" value="<?php echo ($tournament->deadline) ?>">
	</div>
	
	<div class="form-group">
		<label>Location</label>
		<input type="text" class="form-control" name="tournament[location]" value="<?php echo ($tournament->location) ?>">
	</div>
	
	
	<button type="submit" class="btn btn-primary" style="margin-bottom: 10px;">Edit Tournament</button>
	
	</form>
  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>