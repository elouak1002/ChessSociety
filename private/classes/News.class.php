<?php

class News extends DatabaseObject {

  static protected $table_name = "news";
  static protected $db_columns = ['id', 'title', 'content', 'expiryDate', 'releaseDate'];

  public $id;
  public $title;
  public $content;
  public $expiryDate;
  public $releaseDate;
  
  public function __construct($args=[]) {
	$this->title = $args['title'] ?? '';
	$this->content = $args['content'] ?? '';
	$this->expiryDate = $args['expiryDate'] ?? '';
	$this->releaseDate = $args['releaseDate'] ?? '';
  }

  protected function validate() {
    $this->errors = [];
  
    // Name format.
    if(is_blank($this->title)) {
      $this->errors[] = "Title cannot be blank.";
    } 

    // Username format.
    if(is_blank($this->content)) {
      $this->errors[] = "Content cannot be blank.";
    }

    if(is_blank($this->expiryDate)) {
      $this->errors[] = "Expiry date cannot be blank.";
    }

    if(is_blank($this->releaseDate)) {
      $this->errors[] = "Release date cannot be blank.";
    }
	
    return $this->errors;
  }

  static public function find_current_news($date) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE expiryDate >='" . self::$database->escape_string($date) . "'";
    $sql .= " AND releaseDate <='" . self::$database->escape_string($date) . "'";
	  $obj_array = static::find_by_sql($sql);
	  return $obj_array;
  }


}
?>