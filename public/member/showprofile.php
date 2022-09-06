<?php require_once('../../private/initialize.php'); ?>

<?php include(SHARED_PATH . '/member_header.php'); ?>

<?php 

require_login(); 

$id = $session->member_id ?? ''; // PHP > 7.0
$member = Member::find_by_id($id);

?>


<div class="container-fluid">
  <div class="row mt-3 mb-7">
    <div class="col-sm-4">
        <div class="form-group">
          <label>Email address</label>
          <input type="email" class="form-control" value="<?php echo h($member->email); ?>" readonly>
        </div>
        <div class="form-group">
          <label>Username</label>
          <input type="text" class="form-control" value="<?php echo h($member->username); ?>" readonly>
        </div>
        <div class="form-group">
          <label>Elo Ranking</label>
          <input type="number" class="form-control" value="<?php echo h($member->elo_ranking); ?>" readonly>
        </div>
        <div class="form-group">
          <label>First Name</label>
          <input type="text" class="form-control" value="<?php echo h($member->fname); ?>" readonly>
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" class="form-control" value="<?php echo h($member->lname); ?>" readonly>
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" class="form-control" value="<?php echo h($member->address); ?>" readonly>
        </div>
        <div class="form-group">
          <label class="mr-sm-2">Gender</label>
              <input  type="text" class="form-control"  value="<?php echo h($member->gender) ?>" readonly></option>
            </select>
        </div>
        <div class="form-group">
          <label>English Phone Number</label>
          <input type="tel" class="form-control" value="<?php echo h($member->pnumber); ?>" readonly>
        </div>
        <div class="form-group">
          <label>Date of Birth</label>
          <input type="date" class="form-control" value="<?php echo h($member->dob); ?>" readonly>
        </div>
    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/member_footer.php'); ?>
