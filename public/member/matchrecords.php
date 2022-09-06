<?php

require_once('../../private/initialize.php');

require_login();

$tournamentId = $_GET['id'] ?? '';
$tournament = Tournament::find_by_id($tournamentId);
if ($tournament == false) {
  redirect_to(url_for('/member/records.php'));
}
elseif (!$tournament->is_organiser($session->member_id)) {
  redirect_to(url_for('/staff/tournaments/index'));
}


$memberId = $session->member_id ?? ''; // PHP > 7.0
$matches = Match::find_tournament_member_matches($tournamentId,$memberId);

?>

<?php include(SHARED_PATH . '/member_header.php'); ?>

<h4 class="pl-5 mt-3"> Your Matches records of the Tournament : <?php  echo $tournament->name  ?> </h4>

<table class="table mt-3">


  <thead class="thead-dark">
    <tr>
      <th scope="col">Opponent</th>
      <th scope="col">My result</th>
      <th scope="col">My opponent result</th>
    </tr>
  </thead>

	<?php foreach($matches as $match) { ?>

  <tbody>
    <tr>
		<td><?php echo h((Member::find_by_id($match['opponent']))->email); ?></td>
		<td><?php  echo h($match['myoutcome']); ?></td>
		<td><?php echo h($match['opponentoutcome']); ?></td>
	</tr>
  
  </tbody>

	<?php } ?>

</table>


<?php include(SHARED_PATH . '/member_footer.php'); ?>