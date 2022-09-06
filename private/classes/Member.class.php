<?php

class Member extends DatabaseObject {

  static protected $table_name = "members";
  static protected $db_columns = ['id', 'username', 'hash_password', 'email', 'fname', 'lname', 'address', 'pnumber', 'gender', 'dob', 'role','elo_ranking'];

  public $id;
  public $email;
  public $username;
  public $fname;
  public $lname;
  public $address;
  public $pnumber;
  public $gender;
  public $dob;
  public $role;
  public $elo_ranking;
  public $password;
  public $hash_password;
  
  protected $required = array("password" => true, "fname" => false, "lname" => false);

  public const GENDERS = ['Male', 'Female', 'Non-Binary', 'Not saying'];

  public function __construct($args=[]) {
    $this->email = $args['email'] ?? '';
    $this->username = $args['username'] ?? '';
    $this->fname = $args['fname'] ?? '';
    $this->lname = $args['lname'] ?? '';
    $this->address = $args['address'] ?? '';
    $this->pnumber = $args['pnumber'] ?? '';
    $this->gender = $args['gender'] ?? '';
    $this->dob = $args['dob'] ?? '';
    $this->role = $args['role'] ?? 1;
    $this->elo_ranking = $args['elo_ranking'] ?? 1200;
    $this->hash_password = $args['hash_password'] ?? '';
    $this->password = $args['password'] ?? '';
  }
  
  protected function set_hash_password() {
    $this->hash_password = password_hash($this->password, PASSWORD_BCRYPT);
  }

  public function verify_password($password) {
    return password_verify($password, $this->hash_password);
  }

  protected function create() {
    $this->set_hash_password();
    return parent::create();
  }

  protected function update() {
    if($this->password != '') {
      $this->set_hash_password();
      // validate password
    }
    $this->chooseValidation();
    return parent::update();
  }

  private function chooseValidation() {
    foreach($this->required as $property => $value) {
      if ($this->$property == '') {
        $this->required[$property] = false; 
      }
      else {
        $this->required[$property] = true; 
      }
    }
  }

  protected function validate() {
    $this->errors = [];

    // Email format.
    if(is_blank($this->email)) {
      $this->errors[] = "Email cannot be blank.";
    } elseif(!has_valid_email_format($this->email)) {
      $this->errors[] = "Must have valid email format.";
    } elseif (!has_unique_email($this->email, $this->id ?? 0)) {
      $this->errors[] = "Email not allowed. Try another.";
    }   

    // Username format.
    if(is_blank($this->username)) {
      $this->errors[] = "Username cannot be blank.";
    } elseif(!has_length($this->username, ['min' => 3, 'max' => 256])) {
      $this->errors[] = "Username name must be between 3 and 255 characters.";
    } elseif (!has_unique_username($this->username, $this->id ?? 0)) {
      $this->errors[] = "Username not allowed. Try another.";
    }  

    // Password format.
    if($this->required["password"]) {
        if(is_blank($this->password)) {
          $this->errors[] = "Password cannot be blank.";
        } 
        elseif (!has_length($this->password, array('min' => 12))) {
          $this->errors[] = "Password must contain 12 or more characters";
        } 
        elseif (!preg_match('/[A-Z]/', $this->password)) {
          $this->errors[] = "Password must contain at least 1 uppercase letter";
        } 
        elseif (!preg_match('/[a-z]/', $this->password)) {
          $this->errors[] = "Password must contain at least 1 lowercase letter";
        } 
        elseif (!preg_match('/[0-9]/', $this->password)) {
          $this->errors[] = "Password must contain at least 1 number";
        } 
        elseif (!preg_match('/[^A-Za-z0-9\s]/', $this->password)) {
          $this->errors[] = "Password must contain at least 1 symbol";
        }
    }

    if ($this->required["fname"]) {
      if (!has_length($this->fname, array('min' => 2, 'max' => 255))) {
        $this->errors[] = "First name must be between 2 and 255 characters.";
      }
    }

    if ($this->required["lname"]) {
      if (!has_length($this->lname, array('min' => 2, 'max' => 255))) {
        $this->errors[] = "Last name must be between 2 and 255 characters.";
      }
    }

    return $this->errors;
  }

  static public function find_by_username($username) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE username='" . self::$database->escape_string($username) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_by_email($email) {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "WHERE email='" . self::$database->escape_string($email) . "'";
    $obj_array = static::find_by_sql($sql);
    if(!empty($obj_array)) {
      return array_shift($obj_array);
    } else {
      return false;
    }
  }

  static public function find_staff_members_except_co_and_me($memberId, $tournamentId) {
    $sql = "SELECT members.* FROM " . static::$table_name . " ";
    $sql .= "LEFT OUTER JOIN tournament_co_organisers AS co ON co.co_organiserId = " .  static::$table_name . ".id ";
    $sql .= " AND co.tournamentId='" . self::$database->escape_string($tournamentId) . "'";
    $sql .= "WHERE role!=1"; 
    $sql .= " AND members.id!='" . self::$database->escape_string($memberId) . "'";
    $sql .= " AND co.co_organiserId is null";
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }

  static public function find_co_organisers($tournamentId) {
    $sql = "SELECT members.* FROM " . static::$table_name . " ";
    $sql .= "JOIN tournament_co_organisers AS co ON co.co_organiserId = " .  static::$table_name . ".id ";
    $sql .= " AND co.tournamentId='" . self::$database->escape_string($tournamentId) . "'";
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }

  static public function find_participants($tournamentId) {
    $sql = "SELECT members.* FROM " . static::$table_name . " ";
    $sql .= "JOIN tournament_participants AS par ON par.participantId = " .  static::$table_name . ".id ";
    $sql .= " AND par.tournamentId='" . self::$database->escape_string($tournamentId) . "'";
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }

  static public function find_tournament_finalist($tournamentId) {
    $sql = "SELECT members.* from members JOIN";
    $sql .= " (SELECT u.id,sum(u.sum) as sum FROM";
    $sql .= " ((SELECT members.id,sum(outcome1) AS sum FROM members JOIN matches ON matches.player1=members.id WHERE matches.tournament=" . self::$database->escape_string($tournamentId) . " GROUP BY members.id)";
    $sql .= " UNION";
    $sql .= " (SELECT members.id,sum(outcome2) AS sum FROM members JOIN matches ON matches.player2=members.id WHERE matches.tournament=" . self::$database->escape_string($tournamentId) .  " GROUP BY members.id))";
    $sql .= " as u";
    $sql .= " GROUP BY u.id";
    $sql .= " ORDER BY sum DESC";
    $sql .= " LIMIT 2)";
    $sql .= " as res ON members.id=res.id";
    $obj_array = static::find_by_sql($sql);
    return $obj_array;
  }

  public function compute_elo_rating($opponent_rating,$outcome) {
    $difference = 1.0 * ($this->elo_ranking - $opponent_rating);
    $expected = 1.0/(pow(10.0,(0.0-$difference)/400)+1);
    $this->elo_ranking = round($this->elo_ranking + 20 * ($outcome - $expected));
  }

  public function get_role() {
    $sql = "SELECT * FROM " . static::$table_name . " ";
    $sql .= "JOIN member_role ON ";
    $sql .=  static::$table_name . ".role = member_role.id ";
    $sql .=  "AND " . static::$table_name . ".id='" . self::$database->escape_string($this->id) . "'";
    $result = self::$database->query($sql);
    if(!$result) {
      exit("Database query failed.");
    }
    $role = $result->fetch_assoc();
    $result->free();
    return $role['name'];
  }

}

?>