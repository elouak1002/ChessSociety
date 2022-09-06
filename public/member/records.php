<?php

require_once('../../private/initialize.php');

require_login();

$id = $session->member_id ?? ''; // PHP > 7.0
$member = Member::find_by_id($id);
$tournaments = Tournament::find_finished_tournaments($member->id);

?>

<?php include(SHARED_PATH . '/member_header.php'); ?>


<?php if (count($tournaments) == 0) { ?>

<h4 class="pl-5 mt-3"> No Tournament records yet</h4>

<?php } else { ?>

<h4 class="pl-5 mt-3"> Your Previous Tournaments</h4>

<table class="table mt-3">


  <thead class="thead-dark">
    <tr>
      <th scope="col">Name</th>
      <th scope="col">Date</th>
      <th scope="col">Location</th>
      <th scope="col">&nbsp;</th>
    </tr>
  </thead>

	<?php foreach($tournaments as $tournament) { ?>

  <tbody>
    <tr>
		<td><?php echo h($tournament->name); ?></td>
		<td><?php  echo h($tournament->date); ?></td>
		<td><?php echo h($tournament->location); ?></td>
		<td> <a class="action" href="<?php echo url_for('/member/matchrecords.php?id=' . h(u($tournament->id))); ?>">View Matches results</a></td>
	</tr>
  
  </tbody>

	<?php } ?>

</table>

<?php } ?>

<?php include(SHARED_PATH . '/member_footer.php'); ?>