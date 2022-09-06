<?php 
     require_once('../../../private/initialize.php');

     require_staff_login(); 

     // Find all news from data base
     $events = Event::find_all();
     
?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="events listing">
    <h1>Events</h1>

    <a class="back-link" href="<?php echo url_for('/staff/index.php'); ?>">&laquo; Back to Menu</a>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/events/add.php'); ?>">Add Event</a>
    </div>

<?php if(count($events) != 0) { ?>

  	<table class="list">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Date</th>
        <th>Description</th>
        <th>Expiry Date</th>
        <th>Release Date</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($events as $event) { ?>
        <tr>
          <td><?php echo h($event->id); ?></td>
          <td><?php echo h($event->title); ?></td>
          <td><?php echo h($event->event_date); ?></td>
          <td><?php echo h($event->description); ?></td>
          <td><?php echo h($event->expiryDate); ?></td>
          <td><?php echo h($event->releaseDate); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/events/show.php?id=' . h(u($event->id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/events/edit.php?id=' . h(u($event->id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/events/delete.php?id=' . h(u($event->id))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

<?php } ?>

  </div>

</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>