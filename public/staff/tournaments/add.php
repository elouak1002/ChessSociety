<?php

require_once('../../../private/initialize.php'); 

require_staff_login(); 

if(is_post_request()) {

  // Create record using post parameters
  $args = $_POST['tournament'];
  $args["organiserId"] = $session->member_id;
  $tournament = new Tournament($args);
  $result = $tournament->save();

  if($result === true) {
    $new_id = $tournament->id;
    $session->message('The Tournament was created successfully.');
    redirect_to(url_for('/staff/tournaments/show.php?id=' . $new_id));
  } else {
    // show errors
  }

} else {
  // display the form
  $tournament = new Tournament;
}

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/tournaments/index.php'); ?>">&laquo; Back to List</a>

  <div class="tournament new">
    <h1>Create Tournament</h1>

    <?php echo display_errors($tournament->errors); ?>

    <form action="<?php echo url_for('/staff/tournaments/add.php'); ?>" method="post">

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
	
	
	<button type="submit" class="btn btn-primary" style="margin-bottom: 10px;">Create Tournament</button>
	
	</form>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
