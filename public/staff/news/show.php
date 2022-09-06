<?php require_once('../../../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php require_staff_login(); ?>

<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$news = News::find_by_id($id);

?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/news/index.php'); ?>">&laquo; Back to List</a>

  <div class="news show">

    <h1>News: <?php echo h($news->title); ?></h1>

    <div class="attributes">
    
	  <dl>
        <dt>Title</dt>
        <dd><?php echo h($news->title); ?></dd>
      </dl>

      <dl>
        <dt>Content</dt>
        <dd><?php echo h($news->content); ?></dd>
      </dl>
      <dl>
        <dt>Release Date</dt>
        <dd><?php echo h($news->releaseDate); ?></dd>
      </dl>
      <dl>
        <dt>Expriy Date</dt>
        <dd><?php echo h($news->expiryDate); ?></dd>
      </dl>

    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
