<?php

require_once('../../private/initialize.php');

if (is_post_request()) {
    $args = $_POST['member'] ?? '';
    $member = new Member($args);
    $result = $member->save();

    if ($result === true) {
      $new_id = $member->id;
      $session->login($member);
      redirect_to(url_for('/member/index.php'));
    }
    else {
      $errors = $member->errors;
    }
}

?>

<?php

if ($session->is_logged_in()) {
	redirect_to(url_for('/member/index.php'));
}

?>

<?php include(SHARED_PATH . '/open_header.php'); ?>

  <?php echo display_errors($errors); ?>

<div class="maincontent">

  <div class="container">
    <div class="row mt-5 mb-5">
      <h1 class="mx-auto display-3 text-center"> Create your Account </h1>
    </div>
    <div class="row">
      <div class="col-sm-10 offset-sm-3 text-center">
        <form action="<?php echo url_for('/open/signup.php'); ?>" method="post">
            <div class="form-group col-lg-7">
              <label>Email address</label>
              <input type="email" class="form-control" aria-describedby="emailHelp" placeholder="Enter email" name="member[email]" value="<?php echo h($member->email); ?>">
              <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group col-lg-7">
                <label>User name</label>
                <input type="username" class="form-control" placeholder="User Name" name="member[username]" value="<?php echo h($member->username); ?>">
            </div>
            <div class="form-group col-lg-7">
              <label>Password</label>
              <input type="password" class="form-control" placeholder="Password" name="member[password]" value="">
            </div>
            <div class="form-group col-lg-7">
              <button type="submit" class="btn btn-primary">Submit</button>
            </div>
          </form>
      </div>
    </div>
  </div>

</div>

<?php include(SHARED_PATH . '/open_footer.php'); ?>