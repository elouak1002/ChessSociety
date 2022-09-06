<?php require_once('../../../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/staff_header.php'); ?>

<?php require_staff_login(); ?>

<?php

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$member = Member::find_by_id($id);

?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/members/index.php'); ?>">&laquo; Back to List</a>

  <div class="member show">

    <h1>Member: <?php echo h($member->username); ?></h1>

    <div class="attributes">
      <dl>
        <dt>First name</dt>
        <dd><?php echo h($member->fname); ?></dd>
      </dl>
      <dl>
        <dt>Last name</dt>
        <dd><?php echo h($member->lname); ?></dd>
      </dl>
      <dl>
        <dt>Email</dt>
        <dd><?php echo h($member->email); ?></dd>
      </dl>
      <dl>
        <dt>Username</dt>
        <dd><?php echo h($member->username); ?></dd>
      </dl>
      <dl>
        <dt>Address</dt>
        <dd><?php echo h($member->address); ?></dd>
      </dl>
      <dl>
        <dt>Phone Number</dt>
        <dd><?php echo h($member->pnumber); ?></dd>
      </dl>
      <dl>
        <dt>Gender</dt>
        <dd><?php echo h($member->gender); ?></dd>
      </dl>
      <dl>
        <dt>Date of Birth</dt>
        <dd><?php echo h($member->dob); ?></dd>
      </dl>
      <dl>
        <dt>Elo Ranking</dt>
        <dd><?php echo h($member->elo_ranking); ?></dd>
      </dl>
      <dl>
        <dt>Member Status</dt>
		<dd>
		<?php 
		if ($member->role == 2) { 
			echo h("Staff");
		}
		elseif ($member->role == 3) { 
			echo h("Super admin");
		}
		else {
			echo h("Only member");
		}
		?>
		</dd>
      </dl>
    </div>

  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
