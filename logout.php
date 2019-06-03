<?php
require_once('include/Main.php');

$session = new Session();
$session->unset_session_data();
$session->set_session_flash_data( array('login_message' => 'Loggout Successfull !!!') );
redirect(url_base('login.php'));

?>
