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

     // Save record using post parameters
	 $args = $_POST['event'];
     $event->merge_attributes($args);
     $result = $event->save();
     
     if($result === true) {
          $session->message('The Tournament was updated successfully.');
          redirect_to(url_for('/staff/events/index.php'));
     } else {
          // show errors
     }
     
     } else {
     
     // display the form
     
     }

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

     <a class="back-link" href="<?php echo url_for('/staff/events/index.php'); ?>"> Back to Events page</a>
     
     <div class="Events edit">
          <h1>Edit selected Event</h1>
          

          <?php echo display_errors($event->errors); ?>

          <form action="<?php echo url_for('/staff/events/edit.php?id=' . h(u($id))); ?>" method="post">
               <dl>
                    <dt>Title</dt>
                    <dd><input type="text" name="event[title]" value="<?php echo h($event->title); ?>" /></dd>
               </dl>

               <dl>
                    <dt>Description</dt>
                    <dd><textarea type="text" name="event[description]"><?php echo h($event->description); ?></textarea></dd>
               </dl>

               <dl>
                    <dt>Date</dt>
                    <dd><input type="date" name="event[event_date]" value="<?php echo h($event->event_date); ?>" /></dd>
               </dl>


               <dl>
                    <dt>Expiry Date</dt>
                    <dd><input type="date" name="event[expiryDate]" value="<?php echo h($event->expiryDate); ?>" /></dd>
               </dl>

               <dl>
                    <dt>Release Date</dt>
                    <dd><input type="date" name="event[releaseDate]" value="<?php echo h($event->releaseDate); ?>" /></dd>
               </dl>

               <button type="submit" class="btn btn-primary" style="margin-bottom: 10px;">Create Event</button>

          </form>
     </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>