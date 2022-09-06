<?php 
     require_once('../../../private/initialize.php');

     require_staff_login(); 

     // Find all news from data base
     $news = News::find_all();
     
?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<div id="content">
  <div class="news listing">
    <h1>News</h1>

    <a class="back-link" href="<?php echo url_for('/staff/index.php'); ?>">&laquo; Back to Menu</a>

    <div class="actions">
      <a class="action" href="<?php echo url_for('/staff/news/add.php'); ?>">Add News</a>
    </div>

<?php if(count($news) != 0) { ?>

  	<table class="list">
      <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Content</th>
        <th>Expiry Date</th>
        <th>Release Date</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>

      <?php foreach($news as $eachNews) { ?>
        <tr>
          <td><?php echo h($eachNews->id); ?></td>
          <td><?php echo h($eachNews->title); ?></td>
          <td><?php echo h($eachNews->content); ?></td>
          <td><?php echo h($eachNews->expiryDate); ?></td>
          <td><?php echo h($eachNews->releaseDate); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/news/show.php?id=' . h(u($eachNews->id))); ?>">View</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/news/edit.php?id=' . h(u($eachNews->id))); ?>">Edit</a></td>
          <td><a class="action" href="<?php echo url_for('/staff/news/delete.php?id=' . h(u($eachNews->id))); ?>">Delete</a></td>
    	  </tr>
      <?php } ?>
  	</table>

<?php } ?>

  </div>

</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>