<?php

class Event extends DatabaseObject {

  static protected $table_name = "events";
  static protected $db_columns = ['id', 'event_date', 'title', 'expiryDate', 'releaseDate', 'description'];

  public $id;
  public $event_date;
  public $title;
  public $expiryDate;
  public $releaseDate;
  public $description;
  
  public function __construct($args=[]) {
	$this->event_date = $args['event_date'] ?? '';
	$this->title = $args['title'] ?? '';
	$this->expiryDate = $args['expiryDate'] ?? '';
	$this->releaseDate = $args['releaseDate'] ?? '';
	$this->description = $args['description'] ?? '';
  }

  protected function validate() {
    $this->errors = [];
  
    // Name format.
    if(is_blank($this->title)) {
      $this->errors[] = "Title cannot be blank.";
    } 

    // Username format.
    if(is_blank($this->event_date)) {
      $this->errors[] = "Date cannot be blank.";
    }

    if(is_blank($this->expiryDate)) {
      $this->errors[] = "Expiry date cannot be blank.";
    }

    if(is_blank($this->releaseDate)) {
      $this->errors[] = "Release date cannot be blank.";
    }

	if(is_blank($this->description)) {
      $this->errors[] = "Description date cannot be blank.";
    }
	
    return $this->errors;
  }

  static public function find_current_events($date) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE expiryDate >='" . self::$database->escape_string($date) . "'";
    $sql .= " AND releaseDate <='" . self::$database->escape_string($date) . "'";
    $sql .= " ORDER BY event_date";
    $obj_array = static::find_by_sql($sql);
	  return $obj_array;
  }


}
?>