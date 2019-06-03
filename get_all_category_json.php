<?php
require_once('include/Main.php');

$users = array();
$user = new user();
$users = $user->get_all_user();

header("Content-type: application/json; utf-8;");
echo json_encode($users);
exit(0);
?>
