<?php require_once('../../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>


<?php 
require_staff_login(); 
$member = Member::find_by_id($session->member_id);
?>

<div id="content">
  <div id="main-menu" class="container mt-5">
    <h2>Main Menu</h2>
    <p> Hello <b> <?php echo $member->username ?> </b> happy to see you. <br>
        This is the Staff Area of the KCL Chess Society. <br>
        From here you can see all Members and Staff of the Chess Society. <br>
        You can manage the Tournaments for which you are the organiser or a co-organiser. <br>
        Also, you can manage all the News and Events.
    </p>
    <ul>
      <li><a href="<?php echo url_for('/staff/events/index.php'); ?>">Events</a></li>
      <li><a href="<?php echo url_for('/staff/news/index.php'); ?>">News</a></li>
      <li><a href="<?php echo url_for('/staff/members/index.php'); ?>">Members</a></li>
      <li><a href="<?php echo url_for('/staff/tournaments/index.php'); ?>">Tournaments</a></li>
    </ul>
  </div>

</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
