<?php 
     require_once('../../../private/initialize.php');

     require_staff_login(); 

     if(is_post_request()) {
          // Create record using post parameters
          $args = $_POST['event'];
          $event = new Event($args);
          $result = $event->save();
        
          if($result === true) {
            $new_id = $event->id;
            $session->message('The news was created successfully.');
            redirect_to(url_for('/staff/events/index.php'));
          } else {
            // show errors
          }
     } else {
          // display the form
          $event = new Event;
     }   
?>
    
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

     <a class="back-link" href="<?php echo url_for('/staff/events/index.php'); ?>"> Back to Events page</a>

     <div class="news new">
          <h1>Create Event</h1>

          <?php echo display_errors($event->errors); ?>

          <form action="<?php echo url_for('/staff/events/add.php'); ?>" method="post">
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