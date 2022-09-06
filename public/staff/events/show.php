<?php require_once('../../../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php require_staff_login(); ?>

<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$event = Event::find_by_id($id);

?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/events/index.php'); ?>">&laquo; Back to List</a>

  <div class="event show">

    <h1>Event: <?php echo h($event->title); ?></h1>

    <div class="attributes">
    
	  <dl>
        <dt>Title</dt>
        <dd><?php echo h($event->title); ?></dd>
      </dl>
	  
      <dl>
        <dt>Date</dt>
        <dd><?php echo h($event->event_date); ?></dd>
      </dl>
      <dl>
        <dt>Description</dt>
        <dd><?php echo h($event->description); ?></dd>
      </dl>
      <dl>
        <dt>Release Date</dt>
        <dd><?php echo h($event->releaseDate); ?></dd>
      </dl>
      <dl>
        <dt>Expriy Date</dt>
        <dd><?php echo h($event->expiryDate); ?></dd>
      </dl>

    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
