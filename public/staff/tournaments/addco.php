<?php require_once('../../../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php require_staff_login(); ?>

<?php

$tournamentId = $_GET['id'] ?? '1';

$tournament = Tournament::find_by_id($tournamentId);
if (!$tournament->is_organiser($session->member_id)) {
  redirect_to(url_for('/staff/tournaments/index'));
}

if(is_post_request()) {
	
	// Create record using post parameters
	$newco_id = $_POST['id'];
	$args['co_organiserId'] = $newco_id;
	$args['tournamentId'] = $tournamentId;
	$organiser = new Organiser($args);
	$result = $organiser->save();

	if($result === true) {
	  redirect_to(url_for('/staff/tournaments/show.php?id=' . $tournamentId));
	} else {
	  // show errors
	}
  
}

// Find all admins
$members = Member::find_staff_members_except_co_and_me($session->member_id, $tournamentId);

?>

<div id="content">
  <div class="staff members listing">
    <h1>Staff Members</h1>

<?php if (count($members) != 0) { ?>

  	<table class="list">
      <tr>
        <th>ID</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Gender</th>
        <th>Date of Birth</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($members as $member) { ?>
        <tr>
          <td><?php echo h($member->id); ?></td>
          <td><?php echo h($member->fname); ?></td>
          <td><?php echo h($member->lname); ?></td>
          <td><?php echo h($member->email); ?></td>
          <td><?php echo h($member->username); ?></td>
          <td><?php echo h($member->address); ?></td>
          <td><?php echo h($member->pnumber); ?></td>
          <td><?php echo h($member->gender); ?></td>
          <td><?php echo h($member->dob); ?></td>
		  <td>
		  	<form action="<?php echo url_for('/staff/tournaments/addco.php?id=' . h(u($tournamentId))); ?>" method="post">
    			<button type="submit" value="<?php echo h($member->id) ?>" name="id" class="btn-link">Add co-organiser</button>
			</form>
      </td>
    	  </tr>
      <?php } ?>
  	</table>

<?php } ?>

  </div>

</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
