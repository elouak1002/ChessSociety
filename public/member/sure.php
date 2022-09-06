<?php

require_once('../../private/initialize.php');
require_login();

if (is_post_request()) {
	$id = $session->member_id ?? ''; // PHP > 7.0
	echo $id;
	$member = Member::find_by_id($id);

	$result = $member->delete();
	redirect_to(url_for('/member/logout.php'));
}

?>

<?php include(SHARED_PATH . '/member_header.php'); ?>

<div class="row mt-3">
  		
		  <div class="col-sm-3 pr-5">
			  <div class="card">
					<div class="card-body">
						<h5> Are you sure you want to logout? </h5>
						<form action="<?php echo url_for('/member/logout.php'); ?>" method="get">
							<button type="submit" class="btn btn-danger">Logout</button>
						</form>
					</div>
			  </div>
			</div>	
  
  
		  <div class="col-sm-6 pl-5">
			  <div class="card">
					<div class="card-body">
						<h5> Are you sure you want to remove all yout data? </h5>
					  	<form action="<?php echo url_for('/member/sure.php') ?>" method="post">
							<button type="submit" class="btn btn-danger">Remove all your data and logout</button>
						</form>
					</div>
			  </div>
			</div>	
  
</div>

<?php include(SHARED_PATH . '/member_footer.php'); ?>