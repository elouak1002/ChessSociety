<?php

require_once('../../private/initialize.php');

if ($session->is_logged_in()) {
	redirect_to(url_for('/member/index.php'));
}

if (is_post_request()) {
	
	$email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
	
	if(is_blank($email)) {
		$errors[] = "Email cannot be blank.";
	}
	if(is_blank($password)) {
		$errors[] = "Password cannot be blank.";
	}

	// if there were no errors, try to login
	if(empty($errors)) {
		// Using one variable ensures that msg is the same
		$login_failure_msg = "Log in was unsuccessful.";

		$member = Member::find_by_email($email);
		if($member != false && $member->verify_password($password)) {
			// password matches
			$session->login($member);
			redirect_to(url_for('/member/index.php'));
		} else {
			// username found, but password does not match
			$errors[] = $login_failure_msg;
		}
	}
	
}

?>


<?php include(SHARED_PATH . '/open_header.php'); ?>

<?php echo display_errors($errors); ?>

<div class="container">
  <div class="row mt-5 mb-5">
    <h1 class="mx-auto display-3 text-center"> Login to Chess Society </h1>
  </div>
  <div class="row">
    <div class="col-sm-10 offset-sm-3 text-center">
      <form action="<?php echo url_for('/open/login.php'); ?>" method="post">
          <div class="form-group col-lg-7">
            <label>Email address</label>
            <input type="email" class="form-control" id="inputEmail1" aria-describedby="emailHelp" placeholder="Enter email" name='email' value="<?php echo h($email); ?>">
          </div>
          <div class="form-group col-lg-7">
            <label>Password</label>
            <input type="password" class="form-control" id="inputPassword1" placeholder="Password" name="password" value="">
          </div>
          <div class="form-group col-lg-7">
			  <button type="submit" class="btn btn-primary">Submit</button><br>
			</div>
			<div class="form-group col-lg-7">
			<a href="<?php echo url_for('/open/signup.php');?>">Don't have an account? SignUp</a>
			</div>
			<div class="form-group col-lg-7">
			<a href="<?php echo url_for('/staff/login.php');?>">Are you a member of Staff? Login to Staff Area</a>
			</div>
		</form>
    </div>
  </div>
</div>

<?php include(SHARED_PATH . '/open_footer.php'); ?>