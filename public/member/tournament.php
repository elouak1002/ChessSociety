<?php

require_once('../../private/initialize.php');

require_login();

if(is_post_request()) {
	
	// Create record using post parameters
	$tournamentId = $_POST['tournamentId'];
	$args['participantId'] = $session->member_id;
	$args['tournamentId'] = $tournamentId;
	$participant = new Participant($args);
	$result = $participant->save();

	if($result === true) {
	  redirect_to(url_for('/member/tournament.php'));
	} else {
	  // show errors
	}
  
}

$date = date('Y-m-d');
$tournaments = Tournament::find_upcoming_date($date);

?>

<?php include(SHARED_PATH . '/member_header.php'); ?>

<ul class="list-group" style="margin-left:10px">
	<?php foreach($tournaments as $tournament) { ?>
		<div class="test">
		<li class="list-group-item" style="margin-top:10px; width: 65%;">The tournament <?php echo $tournament->name ?> will takes place on  
		<?php echo $tournament->date ?> at  <?php echo $tournament->location ?>.
		<?php if (Participant::find_by_tuple_id($tournament->id,$session->member_id) != NULL) { ?>
			<span class="badge badge-success">Already signed up</span>
		<?php } elseif (($tournament->is_full())) { ?>
			<span class="badge badge-danger">Tournament is full</span>
		<?php } elseif (($tournament->deadline) >  date('Y-m-d')) { ?>
				<span class="badge badge-primary">Open for registration</span>
				<form action="<?php echo url_for('/member/tournament.php') ?>" method="post">
    			<button type="submit" value="<?php echo h($tournament->id) ?>" name="tournamentId" class="btn-link">Sign Up</button>
				</form>
		<?php } else { ?>
			<span class="badge badge-danger">Close for registration</span>
		<?php } ?>
		</li>
		<div>

	<?php } ?>
</ul>

<?php include(SHARED_PATH . '/member_footer.php'); ?>
