<?php require_once('../../../private/initialize.php'); ?>

<?php

require_staff_login(); 

$id = $_GET['id'] ?? '1'; // PHP > 7.0

$tournament = Tournament::find_by_id($id);
$co_organisers = Member::find_co_organisers($id);
$participants = Member::find_participants($id);

if (!$tournament->is_organiser($session->member_id) && Organiser::find_by_tuple_id($tournament->id,$session->member_id) == null) {
  redirect_to(url_for('/staff/tournaments/index'));
}

?>

<?php include(SHARED_PATH . '/staff_header.php');?>

<div id="content">

  <a class="back-link" href="<?php echo url_for('/staff/tournaments/index.php'); ?>">&laquo; Back to List</a>

  <div class="Tournament show">

    <h1>Tournament: <?php echo h($tournament->name); ?></h1>

    <div class="attributes">
      <dl>
        <dt>Name</dt>
        <dd><?php echo h($tournament->name); ?></dd>
      </dl>
	  
      <dl>
        <dt>Date</dt>
        <dd><?php echo h($tournament->date); ?></dd>
      </dl>
	  
      <dl>
        <dt>Deadline</dt>
        <dd><?php echo h($tournament->deadline); ?></dd>
      </dl>

	  
      <dl>
        <dt>Location</dt>
        <dd><?php echo h($tournament->location); ?></dd>
      </dl>

    </div>

    <?php if (count($co_organisers) != 0) { ?>

    <h1>Co-organisers:</h1>

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
      </tr>

      <?php foreach($co_organisers as $member) { ?>
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
    	  </tr>
      <?php } ?>
  	</table>

    <?php } ?>

    <?php if (count($participants) != 0) { ?>

    <h1>Participants</h1>

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
      </tr>

      <?php foreach($participants as $member) { ?>
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
    	  </tr>
      <?php } ?>
  	</table>

    <?php } ?>



  </div>

</div>

<?php include(SHARED_PATH . '/staff_footer.php'); ?>
