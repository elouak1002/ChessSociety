<?php require_once('../../../../private/initialize.php'); ?>


<?php 

require_staff_login(); 

if(!isset($_GET['matchid'])) {
	redirect_to(url_for('/staff/tournaments/index.php'));
}

$tournamentId = $_GET['tourid'];
$tournament = Tournament::find_by_id($tournamentId);
if (!$tournament->is_organiser($session->member_id) && Organiser::find_by_tuple_id($tournament->id,$session->member_id) == null) {
	redirect_to(url_for('/staff/tournaments/index'));
  }
  

$id = $_GET['matchid'];
$match = Match::find_by_id($id);

if($match == false) {
	redirect_to(url_for('/staff/tournaments/matches/match.php?id=' . h(u($tournamentId))));
}

if(is_post_request()) {

	// Save record using post parameters
	$args = $_POST['match'];
	$match->merge_attributes($args);
	$result = $match->save();
  
	if($result === true) {
	  $session->message('The Match was updated successfully.');
	  redirect_to(url_for('/staff/tournaments/matches/match.php?id=' . h(u($tournamentId))));
	} else {
	  // show errors
	}
  
  } else {
  
	// display the form
  
  }

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

<a class="back-link" href="<?php echo url_for('/staff/tournaments/matches/match.php?id=' . h(u($tournamentId))); ?>">&laquo; Back to Tournaments</a>

<form action="<?php echo url_for('/staff/tournaments/matches/edit.php?tourid=' . $tournamentId .'&matchid=' . h(u($id))); ?>" method="post">

<div class="form-group">
		<label>Outcome of player 1</label>
		<select class="custom-select mr-sm-2" name="match[outcome1]">
            <?php foreach(Match::OUTCOMES as $outcome) { ?>
              <option <?php if ($match->outcome1 === $outcome) { echo "selected ";}?> value="<?php echo h($outcome) ?>"><?php echo h($outcome) ?></option>
              <?php } ?>
            </select>
	</div>

	<div class="form-group">
		<label>Outcome of player 2</label>
		<select class="custom-select mr-sm-2" name="match[outcome2]">
            <?php foreach(Match::OUTCOMES as $outcome) { ?>
              <option <?php if ($match->outcome2 === $outcome) { echo "selected ";}?> value="<?php echo h($outcome) ?>"><?php echo h($outcome) ?></option>
              <?php } ?>
            </select>
	</div>

	<button type="submit" class="btn btn-primary" style="margin-bottom: 10px;">Edit Match</button>

</form>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
