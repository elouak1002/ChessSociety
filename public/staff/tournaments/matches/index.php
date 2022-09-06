<?php require_once('../../../../private/initialize.php'); ?>



<?php require_staff_login(); ?>

<?php

$id = $_GET['id'];
$tournament = Tournament::find_by_id($id);
if (!$tournament->is_organiser($session->member_id) && Organiser::find_by_tuple_id($tournament->id,$session->member_id) == null) {
	redirect_to(url_for('/staff/tournaments/index'));
  }
  

if($tournament == false) {
	redirect_to(url_for('/staff/tournaments/index.php'));
}

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="tournaments listing">
    <h1>Manage the Tournament</h1>

	<div class="alert alert-info" role="alert">
		Status : 
		<?php if($tournament->get_status() == "finished") { ?>
			The tournament is finished.
		<?php } elseif ($tournament->get_status() == "final") { ?>
			The final is scheduled. You can now see and edit the final of the tournament.
		<?php } elseif ($tournament->get_status() == "rounds") { ?>
			The tournament is scheduled. You can now see and edit the rounds.
		<?php } elseif ($tournament->get_status() == "registration") { ?>
			The tournament isn't scheduled yet.
		<?php } ?>
	</div>

      <?php echo display_session_message(); ?>
      
      <a class="back-link" href="<?php echo url_for('/staff/tournaments/index.php'); ?>">&laquo; Back to Menu</a>

	<div class="row mt-4">
  		
		<div class="col-sm-3">
    		<div class="card">
      			<div class="card-body">
        			<h5 class="card-title">Create Rounds</h5>
						<form action="<?php echo url_for('/staff/tournaments/matches/create.php?id=' . h(u($tournament->id))); ?>" method="post">
							<input type="hidden" name="create[id]" value="<?php echo ($tournament->id) ?>">
							<input type="hidden" name="create[status]" value="rounds">
    						<button type="submit" class="btn btn-primary">Do</button>
						</form>
      			</div>
    		</div>
  		</div>	


		<div class="col-sm-3">
    		<div class="card">
      			<div class="card-body">
        			<h5 class="card-title">End Rounds create Final</h5>
					<form action="<?php echo url_for('/staff/tournaments/matches/create.php?id=' . h(u($tournament->id))); ?>" method="post">
							<input type="hidden" name="create[id]" value="<?php echo ($tournament->id) ?>">
							<input type="hidden" name="create[status]" value="final">
    						<button type="submit" class="btn btn-primary">Do</button>
						</form>
      			</div>
    		</div>
  		</div>	
  		
		<div class="col-sm-5">
    		<div class="card">
      			<div class="card-body">
        			<h5 class="card-title">End Tournament - Compute new Elo Ratings</h5>
					<form action="<?php echo url_for('/staff/tournaments/matches/create.php?id=' . h(u($tournament->id))); ?>" method="post">
							<input type="hidden" name="create[id]" value="<?php echo ($tournament->id) ?>">
							<input type="hidden" name="create[status]" value="finished">
    						<button type="submit" class="btn btn-primary">Do</button>
						</form>
      			</div>
    		</div>
		</div>

	</div>

	<div class="row mt-4">
  		
		<div class="col-sm-3">
    		<div class="card">
      			<div class="card-body">
        			<h5 class="card-title">View Matches</h5>
					<a class="action" href="<?php echo url_for('/staff/tournaments/matches/match.php?id=' . h(u($id))); ?>">View Matches</a>
      			</div>
    		</div>
  		</div>	


	</div>

  </div>
</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
