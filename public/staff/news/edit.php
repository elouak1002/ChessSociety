<?php


require_once('../../../private/initialize.php');

require_staff_login(); 

if(!isset($_GET['id'])) {
     redirect_to(url_for('/staff/news/index.php'));
}

$id = $_GET['id'];
$wantedNews = News::find_by_id($id);
if($wantedNews == false) {
     redirect_to(url_for('/staff/news/index.php'));
}

if(is_post_request()) {

     // Save record using post parameters
     $args = $_POST['news'];
     $wantedNews->merge_attributes($args);
     $result = $wantedNews->save();
     
     if($result === true) {
          $session->message('The Tournament was updated successfully.');
          redirect_to(url_for('/staff/news/index.php'));
     } else {
          // show errors
     }
     
     } else {
     
     // display the form
     
     }

?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

     <a class="back-link" href="<?php echo url_for('/staff/news/index.php'); ?>"> Back to news page</a>
     
     <div class="News edit">
          <h1>Edit selected News</h1>
          

          <?php echo display_errors($wantedNews->errors); ?>

          <form action="<?php echo url_for('/staff/news/edit.php?id=' . h(u($id))); ?>" method="post">
               <dl>
                    <dt>new title</dt>
                    <dd><input type="text" name="news[title]" value="<?php echo h($wantedNews->title); ?>" /></dd>
               </dl>

               <dl>
                    <dt>new Content</dt>
                    <dd><textarea type="text" name="news[content]"><?php echo h($wantedNews->content); ?></textarea></dd>
               </dl>

               <dl>
                    <dt>new expiry Date</dt>
                    <dd><input type="date" name="news[expiryDate]" value="<?php echo h($wantedNews->expiryDate); ?>" /></dd>
               </dl>

               <dl>
                    <dt>new release Date</dt>
                    <dd><input type="date" name="news[releaseDate]" value="<?php echo h($wantedNews->releaseDate); ?>" /></dd>
               </dl>

               <div id="operations">
                    <input type="submit" value="Edit news" />
               </div>
          </form>
     </div>
</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>