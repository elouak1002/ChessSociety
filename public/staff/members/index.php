<?php require_once('../../../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php require_staff_login(); ?>

<?php

// Find all admins
$member = Member::find_all();

?>
<?php $page_title = 'Admins'; ?>

<div id="content">
  <div class="admins listing">
    <h1>Member</h1>

      <?php echo display_session_message(); ?>

    <a class="back-link" href="<?php echo url_for('/staff/index.php'); ?>">&laquo; Back to Menu</a>


  	<table class="list">
      <tr>
        <th>ID</th>
        <th>First name</th>
        <th>Last name</th>
        <th>Email</th>
        <th>Username</th>
        <th>Address</th>
        <th>Phone Number</th>
        <th>Gender</th>
        <th>Date of Birth</th>
        <th>Member status</th>
        <th>Elo Ranking</th>
        <th>&nbsp;</th>
        <?php if ($session->role == "admin") { ?>
          <th>&nbsp;</th>
        <?php } ?>
      </tr>

      <?php foreach($member as $member) { ?>
        <tr>
          <td><?php echo h($member->id); ?></td>
          <td><?php echo h($member->fname); ?></td>
          <td><?php echo h($member->lname); ?></td>
          <td><?php echo h($member->email); ?></td>
          <td><?php echo h($member->username); ?></td>
          <td><?php echo h($member->address); ?></td>
          <td><?php echo h($member->pnumber); ?></td>
          <td><?php echo h($member->gender); ?></td>
          <td><?php echo h($member->dob); ?></td>
          <td><?php echo h($member->role); ?></td>
          <td><?php echo h($member->elo_ranking); ?></td>
          <td><a class="action" href="<?php echo url_for('/staff/members/show.php?id=' . h(u($member->id))); ?>">View</a></td>
          <?php if ($session->role == "admin" && $member->get_role() == "member") { ?>
            <td><a class="action" href="<?php echo url_for('/staff/members/promote.php?id=' . h(u($member->id))); ?>">Promote to Staff</a></td>
           <?php } elseif ($session->role == "admin" && $member->get_role() == "staff") { ?>
            <td><a class="action" href="<?php echo url_for('/staff/members/demote.php?id=' . h(u($member->id))); ?>">Demote to Member</a></td>
          <?php } ?>
    	  </tr>
      <?php } ?>
  	</table>

  </div>

</div>


<?php include(SHARED_PATH . '/staff_footer.php'); ?>
