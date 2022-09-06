<?php 
     require_once('../../../private/initialize.php');

     require_staff_login(); 

     if(is_post_request()) {
          // Create record using post parameters
          $args = $_POST['news'];
          $news = new News($args);
          $result = $news->save();
        
          if($result === true) {
            $new_id = $news->id;
            $session->message('The news was created successfully.');
            redirect_to(url_for('/staff/news/index.php'));
          } else {
            // show errors
          }
     } else {
          // display the form
          $news = new News;
     }   
?>
    
<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

     <a class="back-link" href="<?php echo url_for('/staff/news/index.php'); ?>"> Back to News page</a>

     <div class="news new">
          <h1>Create News</h1>

          <?php echo display_errors($news->errors); ?>

          <form action="<?php echo url_for('/staff/news/add.php'); ?>" method="post">
               <dl>
                    <dt>new title</dt>
                    <dd><input type="text" name="news[title]" value="<?php echo h($news->title); ?>" /></dd>
               </dl>

               <dl>
                    <dt>new Content</dt>
                    <dd><input type="text" name="news[content]" value="<?php echo h($news->content); ?>" /></dd>
               </dl>

               <dl>
                    <dt>new expiry Date</dt>
                    <dd><input type="date" name="news[expiryDate]" value="<?php echo h($news->expiryDate); ?>" /></dd>
               </dl>

               <dl>
                    <dt>new release Date</dt>
                    <dd><input type="date" name="news[releaseDate]" value="<?php echo h($news->releaseDate); ?>" /></dd>
               </dl>

               <button type="submit" class="btn btn-primary" style="margin-bottom: 10px;">Create News</button>

          </form>
     </div>
</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>