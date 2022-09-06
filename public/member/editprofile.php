<?php

require_once('../../private/initialize.php');

require_login();

$id = $session->member_id ?? ''; // PHP > 7.0
$member = Member::find_by_id($id);

if(is_post_request()) {

  // Handle form values sent by new.php

  $args = $_POST['member'];
  $member->merge_attributes($args);
  $result = $member->save();

  if($result === true) {
    redirect_to(url_for('/member/showprofile.php'));
  } else {
    $errors = $member->errors;
    //var_dump($errors);
  }
} 

?>

<?php include(SHARED_PATH . '/member_header.php'); ?>

<?php echo display_errors($errors); ?>

<div class="container-fluid">
  <div class="row mt-3 mb-7">
    <div class="col-sm-4">
    <form action="<?php echo url_for('/member/editprofile.php'); ?>" method="post">
        <div class="form-group">
          <label>Email address</label>
          <input type="email" class="form-control" aria-describedby="emailHelp" value="<?php echo h($member->email); ?>" readonly>
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
          <input type="text" class="form-control" name="member[fname]" value="<?php echo h($member->fname); ?>">
        </div>
        <div class="form-group">
          <label>Last Name</label>
          <input type="text" class="form-control" name="member[lname]" value="<?php echo h($member->lname); ?>">
        </div>
        <div class="form-group">
          <label>Address</label>
          <input type="text" class="form-control" name="member[address]" value="<?php echo h($member->address); ?>">
        </div>
        <div class="form-group">
          <label class="mr-sm-2">Gender</label>
            <select class="custom-select mr-sm-2" name="member[gender]">
            <?php foreach(Member::GENDERS as $gender) { ?>
              <option <?php if ($member->gender === $gender) { echo "selected ";}?> value="<?php echo h($gender) ?>"><?php echo h($gender) ?></option>
              <?php } ?>
            </select>
        </div>
        <div class="form-group">
          <label>English Phone Number</label>
          <input type="tel" class="form-control" name="member[pnumber]" value="<?php echo h($member->pnumber); ?>">
        </div>
        <div class="form-group">
          <label>Date of Birth</label>
          <input type="date" class="form-control" name="member[dob]" value="<?php echo h($member->dob); ?>">
        </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/member_footer.php'); ?>