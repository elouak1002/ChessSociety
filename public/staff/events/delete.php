<?php

require_once('../../../private/initialize.php');

require_staff_login(); 

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/events/index.php'));
}

$id = $_GET['id'];

$event = Event::find_by_id($id);
if($event == false) {
  redirect_to(url_for('/staff/events/index.php'));
}

if(is_post_request()) {
  // Delete admin
  $result = $event->delete();
  $session->message('The news was deleted successfully.');
  redirect_to(url_for('/staff/events/index.php'));

} else {
  // Display form
}
?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/events/index.php'); ?>">&laquo; Back to List</a>

  <div class="events delete">
    <h1>Delete event</h1>
    <p>Are you sure you want to delete this event?</p>
    <p class="item"><?php echo h($event->title); ?></p>

    <form action="<?php echo url_for('/staff/events/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete Event" />
      </div>
    </form>
  </div>

</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>