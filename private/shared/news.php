<?php 
  $date = date('Y-m-d');
  $news = News::find_current_news($date);
?>

<div class= "row">


<?php foreach($news as $oneNews) { ?>
  <div class= "column">
    <div class="card mt-3">
    <h5 class="card-header"> <?php echo h($oneNews->title); ?> </h5>
      <p class= "card-text mt-1 mb-1 ml-1 mr-1"> <?php echo h($oneNews->content); ?>  </p>
    </div>
  </div>

<?php } ?>

</div>