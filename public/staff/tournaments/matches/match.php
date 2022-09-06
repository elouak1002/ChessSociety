<?php require_once('../../../../private/initialize.php'); ?>


<?php 

require_staff_login(); 

if(!isset($_GET['id'])) {
	redirect_to(url_for('/staff/tournaments/index.php'));
}	

$id = $_GET['id'] ?? '1';
$tournament = Tournament::find_by_id($id);
if (!$tournament->is_organiser($session->member_id) && Organiser::find_by_tuple_id($tournament->id,$session->member_id) == null) {
	redirect_to(url_for('/staff/tournaments/index'));
  }
  

if($tournament == false) {
	redirect_to(url_for('/staff/tournaments/index.php'));
}

$matches = Match::find_tournament_matches($tournament->id);

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

	<?php echo display_session_message(); ?>


<a class="back-link" href="<?php echo url_for('/staff/tournaments/matches/index.php?id=' . h(u($id))); ?>">&laquo; Back to Tournament</a>

<table class="table mt-3">


  <thead class="thead-dark">
    <tr>
      <th scope="col">Player 1</th>
      <th scope="col">Player 2</th>
      <th scope="col">Player 1 outcome</th>
      <th scope="col">Player 2 outcome</th>
      <th scope="col">Set result</th>
    </tr>
  </thead>

	<?php foreach($matches as $match) { ?>

  <tbody>
    <tr>
		<td><?php echo h((Member::find_by_id($match->player1))->email); ?></td>
		<td><?php  echo h((Member::find_by_id($match->player2))->email); ?></td>
		<td><?php echo h($match->outcome1); ?></td>
		<td><?php echo h($match->outcome2); ?></td>
		<td>
			<?php if ($match->editable) { ?>
				<a class="action" href="<?php echo url_for('/staff/tournaments/matches/edit.php?tourid=' . $tournament->id .'&matchid=' . h(u($match->id))); ?>">Record</a>
			<?php } else { ?>
				<span class="badge badge-danger">Cannot edit it anymore</span>
			<?php } ?>
		</td>
	</tr>
  
  </tbody>

	<?php } ?>

</table>



</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
