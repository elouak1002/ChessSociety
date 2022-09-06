<?php 

require_once('./private/initialize.php'); 
$public_end = strpos($_SERVER['SCRIPT_NAME'], '/index.php');
$doc_root = substr($_SERVER['SCRIPT_NAME'], 0, $public_end);
redirect_to($doc_root . '/public/open/index.php');

?>