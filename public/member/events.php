<?php 

require_once('../../private/initialize.php'); 

require_login(); 

$date = date('Y-m-d');
$events = Event::find_current_events($date);

?>

<?php include(SHARED_PATH . '/member_header.php'); ?>

<div class= "row">


<?php foreach($events as $event) { ?>
  <div class= "column">
    <div class="card mt-3">
    <h5 class="card-header"> <?php echo h($event->title) . " " . h($event->event_date) ?> </h5>
      <p class= "card-text mt-1 mb-1 ml-1 mr-1"> <?php echo h($event->description); ?>  </p>
    </div>
  </div>

<?php } ?>



</div>


<?php include(SHARED_PATH . '/member_footer.php'); ?> 