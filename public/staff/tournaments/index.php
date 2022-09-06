<?php require_once('../../../private/initialize.php'); ?>


<?php require_staff_login(); ?>

<?php

// Find all admins
$my_tournaments = Tournament::find_tournament_by_organiser_id($session->member_id);
$my_co_tournaments = Tournament::find_tournament_by_co_organiser_id($session->member_id);

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="tournaments listing">
    <h1>Tournaments</h1>

      <?php echo display_session_message(); ?>
      
      <a class="back-link" href="<?php echo url_for('/staff/index.php'); ?>">&laquo; Back to Menu</a>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/tournaments/add.php'); ?>">Add Tournament</a>
    </div>

<?php if(count($my_tournaments) != 0) { ?>

    <h3> My Tournaments </h3>

  	<table class="table mb-5">

      <thead class="thead-dark">
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Date</th>
        <th scope="col">Deadline</th>
        <th scope="col">Location</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
        <th scope="col">&nbsp;</th>
      </tr>
      </thead>

      <?php foreach($my_tournaments as $tournament) { ?>
        
        <tbody>
        <tr>
          <td><?php echo h($tournament->id); ?></td>
          <td><?php echo h($tournament->name); ?></td>
          <td><?php echo h($tournament->date); ?></td>
          <td><?php echo h($tournament->deadline); ?></td>
          <td><?php echo h($tournament->location); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/tournaments/show.php?id=' . h(u($tournament->id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/tournaments/edit.php?id=' . h(u($tournament->id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/tournaments/delete.php?id=' . h(u($tournament->id))); ?>">Delete</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/tournaments/addco.php?id=' . h(u($tournament->id))); ?>">Add co-organiser</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/tournaments/deleteco.php?id=' . h(u($tournament->id))); ?>">Remove co-organiser</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/tournaments/matches/index.php?id=' . h(u($tournament->id))); ?>">Manage Tournament</a></td>
    	  </tr>
        </tbody>
      <?php } ?>
  	</table>

<?php } ?>

<?php if(count($my_co_tournaments) != 0) { ?>

<h3> My Tournaments as co-organiser</h3>

<table class="table mb-5">

  <thead class="thead-dark">
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Name</th>
    <th scope="col">Date</th>
    <th scope="col">Deadline</th>
    <th scope="col">Location</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
    <th scope="col">&nbsp;</th>
  </tr>
  </thead>

  <?php foreach($my_co_tournaments as $tournament) { ?>
    
    <tbody>
    <tr>
      <td><?php echo h($tournament->id); ?></td>
      <td><?php echo h($tournament->name); ?></td>
      <td><?php echo h($tournament->date); ?></td>
      <td><?php echo h($tournament->deadline); ?></td>
      <td><?php echo h($tournament->location); ?></td>
      <td><a class="action" href="<?php echo url_for('/staff/tournaments/show.php?id=' . h(u($tournament->id))); ?>">View</a></td>
      <td><a class="action" href="<?php echo url_for('/staff/tournaments/matches/index.php?id=' . h(u($tournament->id))); ?>">Manage Tournament</a></td>
    </tr>
    </tbody>
  <?php } ?>
</table>

<?php } ?>


  </div>

</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
