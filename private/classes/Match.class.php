<?php

class Match extends DatabaseObject {

  static protected $table_name = "matches";
  static protected $db_columns = ['id','player1','player2','outcome1','outcome2','tournament','editable'];

  public $id;
  public $player1;
  public $player2;
  public $outcome1;
  public $outcome2;
  public $tournament;
  public $editable;

  public const OUTCOMES = ['0', '0.5', '1'];

  public function __construct($args=[]) {
    $this->player1 = $args['player1'] ?? '';
    $this->player2 = $args['player2'] ?? '';
    $this->outcome1 = $args['outcome1'] ?? '';
    $this->outcome2 = $args['outcome2'] ?? '';
    $this->tournament = $args['tournament'] ?? '';
    $this->editable = $args['editable'] ?? '1';
  }

  protected function validate() {
    $this->errors = [];

    if(is_blank($this->player1)) {
      $this->errors[] = "Player 1 cannot be blank.";
	} 
	
    if(is_blank($this->player2)) {
      $this->errors[] = "Player 2 cannot be blank.";
    }

    if(is_blank($this->tournament)) {
      $this->errors[] = "Tournament cannot be blank.";
    }


    return $this->errors;
  }

  static public function create_tournament_matches($tournamentId, $participants_id) {
    for ($i=0, $len=count($participants_id); $i<$len; $i++) {
      for ($j=$i+1, $len=count($participants_id); $j<$len; $j++) {
        if ($participants_id[$i] != $participants_id[$j]) {
          $args = array();
          $args['player1'] = $participants_id[$i];
          $args['player2'] = $participants_id[$j];
          $args['tournament'] = $tournamentId;
          $match = new Match($args);
          $match->save();
        }
      }
    }
  }

  static public function find_tournament_matches($tournamentId) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= " WHERE tournament='" . self::$database->escape_string($tournamentId) . "'";
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }

  static public function find_tournament_member_matches($tournamentId,$memberId) {
    $sql = "select * from";
    $sql .= "((select tournament,player1 as opponent,outcome2 as myoutcome,outcome1 as opponentoutcome  from matches where player2='" . self::$database->escape_string($memberId) . "')";
    $sql .= "UNION";
    $sql .= "(select tournament,player2 as opponent,outcome1 as myoutcome,outcome2 as opponentoutcome  from matches where player1='" . self::$database->escape_string($memberId) . "'))"; 
    $sql .= "as d where d.tournament='" . self::$database->escape_string($tournamentId) . "'";
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }

    // results into objects
    $object_array = [];
    while($record = $result->fetch_assoc()) {
      $object_array[] = $record;
    }

    $result->free();

    return $object_array;
  }
  
}

?>
