<?php

require_once('../../../private/initialize.php');

require_staff_login(); 

if(!isset($_GET['id'])) {
  redirect_to(url_for('/staff/news/index.php'));
}

$id = $_GET['id'];

$news = News::find_by_id($id);
if($news == false) {
  redirect_to(url_for('/staff/news/index.php'));
}

if(is_post_request()) {
  // Delete admin
  $result = $news->delete();
  $session->message('The news was deleted successfully.');
  redirect_to(url_for('/staff/news/index.php'));

} else {
  // Display form
}
?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/news/index.php'); ?>">&laquo; Back to List</a>

  <div class="news delete">
    <h1>Delete news</h1>
    <p>Are you sure you want to delete this news?</p>
    <p class="item"><?php echo h($news->title); ?></p>

    <form action="<?php echo url_for('/staff/news/delete.php?id=' . h(u($id))); ?>" method="post">
      <div id="operations">
        <input type="submit" name="commit" value="Delete News" />
      </div>
    </form>
  </div>

</div>
<?php include(SHARED_PATH . '/staff_footer.php'); ?>