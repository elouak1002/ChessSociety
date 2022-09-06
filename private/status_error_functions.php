<?php

function require_login() {
  global $session;
  if(!$session->is_logged_in()) {
    redirect_to(url_for('/open/login.php'));
  } else {
    // Do nothing, let the rest of the page proceed
  }
}

function require_staff_login() {
  global $session;
  if(!$session->is_logged_in() || $session->role == "member") {
    redirect_to(url_for('/staff/login.php'));
  } else {
    // Do nothing, let the rest of the page proceed
  }
}

function display_errors($errors=array()) {
  $output = '';
  if (!empty($errors)) {
      $output .= "<div class=\"alert alert-danger\">";
      $output .= "<p>Please fix the following errors:</p>";
      $output .= "<ul>";
      foreach($errors as $error) {
          $output .= "<li>" . h($error) . "</li>";
      }
      $output .= "</ul>";
      $output .= "</div>";
  }
  return $output;
}

function display_session_message() {
  global $session;
  $msg = $session->message();
  if(isset($msg) && $msg != '') {
    $session->clear_message();
    return '<div id="message">' . h($msg) . '</div>';
  }
}

?>
