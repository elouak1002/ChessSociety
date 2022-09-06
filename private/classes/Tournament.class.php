<?php

class Tournament extends DatabaseObject {

  static protected $table_name = "tournaments";
  static protected $db_columns = ['id','organiserId','name','date','deadline','location','status'];

  public $id;
  public $organiserId;
  public $name;
  public $date;
  public $deadline;
  public $location;
  public $status;

  public function __construct($args=[]) {
    $this->name = $args['name'] ?? '';
    $this->organiserId = $args['organiserId'] ?? '';
    $this->date = $args['date'] ?? '';
    $this->deadline = $args['deadline'] ?? '';
    $this->location = $args['location'] ?? '';
    $this->status = $args['status'] ?? '1';
  }

  protected function validate() {
    $this->errors = [];

    // Name format.
    if(is_blank($this->name)) {
      $this->errors[] = "Name cannot be blank.";
    } 

    // Username format.
    if(is_blank($this->date)) {
      $this->errors[] = "Date cannot be blank.";
    }

    if(is_blank($this->deadline)) {
      $this->errors[] = "Deadline cannot be blank.";
    }

    if(is_blank($this->location)) {
      $this->errors[] = "Location cannot be blank.";
    }

    return $this->errors;
  }

  static public function find_upcoming_date($date) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE date >='" . self::$database->escape_string($date) . "'";
	  $obj_array = static::find_by_sql($sql);
	  return $obj_array;
  }

  static public function find_tournament_by_organiser_id($organiser_id) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE organiserId='" . self::$database->escape_string($organiser_id) . "'";
	  $obj_array = static::find_by_sql($sql);
	  return $obj_array;
  }
  
  static public function find_tournament_by_co_organiser_id($co_organiser_id) {
    $sql = "SELECT " . static::$table_name  . ".* FROM " . static::$table_name . " ";
    $sql .= "JOIN tournament_co_organisers on id=tournamentId ";
    $sql .= "WHERE co_organiserId='" . self::$database->escape_string($co_organiser_id) . "'";
    var_dump($sql);
	  $obj_array = static::find_by_sql($sql);
	  return $obj_array;
  }

  public function is_full() {
    if (static::number_of_participants($this->id) >= 10) {
        return true;
    }
    else {
      return false;
    }
  }

  static public function number_of_participants($tournamentId) {
    $sql = "SELECT * FROM tournament_participants";
    $sql .= " WHERE tournamentId='" . self::$database->escape_string($tournamentId) . "'";
    $result = self::$database->query($sql);
    $count = $result->num_rows;
    if(!$result) {
      exit("Database query failed.");
    }
    $result->free();
    return $count;
  }

  public function get_status() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "JOIN tournament_status ON ";
    $sql .=  static::$table_name . ".status = tournament_status.id ";
    $sql .=  "AND " . static::$table_name . ".id='" . self::$database->escape_string($this->id) . "'";
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }
    $status = $result->fetch_assoc();
    $result->free();
    return $status['name'];
  }

  public static function find_finished_tournaments($memberId) {
    $sql = "SELECT " . static::$table_name . ".* FROM " . static::$table_name . " JOIN";
    $sql .= " tournament_status ON " . static::$table_name . ".status = tournament_status.id";
    $sql .= " JOIN tournament_participants ON " . static::$table_name . ".id = tournament_participants.tournamentId";
    $sql .= " WHERE tournament_status.name='finished'";
    $sql .= " AND tournament_participants.participantId='" . self::$database->escape_string($memberId) . "'";
    $sql .= " ORDER BY date";
	  $obj_array = static::find_by_sql($sql);
    return $obj_array;
    
  }


  public function is_organiser($memberId) {
    if ($this->organiserId == $memberId) {
      return true;
    }
    else {
      return false;
    }
  }

}

?>
