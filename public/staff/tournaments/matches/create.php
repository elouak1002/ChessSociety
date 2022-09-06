<?php require_once('../../../../private/initialize.php'); ?>


<?php 

require_staff_login(); 


if (!is_post_request()) {
	redirect_to(url_for('staff/tournaments/index.php'));
}

$create = $_POST['create'];

$tournament = Tournament::find_by_id($create['id']);
if (!$tournament->is_organiser($session->member_id) && Organiser::find_by_tuple_id($tournament->id,$session->member_id) == null) {
	redirect_to(url_for('/staff/tournaments/index'));
  }
  

if($tournament == false) {
	redirect_to(url_for('/staff/tournaments/index.php'));
}

elseif ($tournament->deadline >= date('Y-m-d')) {
	$session->message('The matches cannot be created until the deadline for registration is passed.');
	redirect_to(url_for('/staff/tournaments/index.php'));
}

elseif (($tournament->get_status() == "registration") && ($create['status'] == "rounds")) {

	$participants = Member::find_participants($tournament->id);
	$participants_id = array();
	foreach ($participants as $participant) {
		array_push($participants_id,$participant->id);
	}

	Match::create_tournament_matches($tournament->id, $participants_id);
	$tournament->status = 2;
	$tournament->save();

}

elseif (($tournament->get_status() == "rounds") && ($create['status'] == "final")) {

	$matches = Match::find_tournament_matches($tournament->id);
	foreach($matches as $match) {
		$match->editable = 0;
		$match->save();
	}

	$participants = Member::find_tournament_finalist($tournament->id);
	$participants_id = array();
	foreach ($participants as $participant) {
		array_push($participants_id,$participant->id);
	}

	Match::create_tournament_matches($tournament->id, $participants_id);
	
	$tournament->status = 3;
	$tournament->save();


}

elseif (($tournament->get_status() == "final") && ($create['status'] == "finished")) {

	$matches = Match::find_tournament_matches($tournament->id);
	foreach($matches as $match) {
		$player1 = Member::find_by_id($match->player1);
		$player2 = Member::find_by_id($match->player2);
		$player1_tmp = $player1->elo_ranking;
		$player1->compute_elo_rating($player2->elo_ranking,$match->outcome1);
		$player1->save();
		$player2->compute_elo_rating($player1_tmp,$match->outcome2);
		$player2->save();
		$match->editable = 0;
		$match->save();
	}

	$tournament->status = 4;
	$tournament->save();
}

redirect_to(url_for('/staff/tournaments/matches/index.php?id=' . h(u($create['id']))));

?>