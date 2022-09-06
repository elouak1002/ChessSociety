<?php

class Participant extends DatabaseObject {

  static protected $table_name = "tournament_participants";
  static protected $db_columns = ['participantId','tournamentId'];

  public $participantId;
  public $tournamentId;

  public function __construct($args=[]) {
    $this->participantId = $args['participantId'] ?? '';
    $this->tournamentId = $args['tournamentId'] ?? '';
  }

  protected function validate() {
    $this->errors = [];

    return $this->errors;
  }

  public function save() {
    return $this->create();
  }

  static public function find_by_tuple_id($tournamentId, $participantId) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE participantId='" . self::$database->escape_string($participantId) . "'";
    $sql .= " AND tournamentId='" . self::$database->escape_string($tournamentId) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  public function delete() {
    $sql = "DELETE FROM " . static::$table_name . " ";
    $sql .= "WHERE participantId='" . self::$database->escape_string($this->co_organiserId) . "'";
    $sql .= " AND tournamentId='" . self::$database->escape_string($this->tournamentId) . "'";
    $sql .= "LIMIT 1";
    $result = self::$database->query($sql);
    return $result;
  }
  
}

?>
