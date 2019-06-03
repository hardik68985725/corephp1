<?php
require_once('include/Main.php');

$session = new Session();
// $flash_data = $session->get_session_flash_data();

// $session->unset_session_data();

$session_user_data = $session->get_session_data('user_data');
// data_dump($session_user_data, true);
if ( is_object($session_user_data) && count($session_user_data) > 0 ) {
    redirect(url_base('blank.php'));
}


// data_print($_SESSION);

// echo url_base('admin/');
// echo path_base('admin/');

// data_print($_POST);

// If login form has been submitted then process it.
if( isset($_POST['hid_admin_login']) && (empty($_POST['hid_admin_login']) == FALSE) ) {
    $user = new user();
    $array_column = array('user_id', 'user_name', 'user_email');
    $array_filter = array(
        'user_email' => $_POST['email']
        ,'AND user_password' => $_POST['password']
    );
    $users = $user->get_user_by($array_column, $array_filter);
    // data_print(count($users));
    // data_print($users, true);

    // Check is it any user found or not.
    if( count($users) > 0 ) {
        // echo 'Loggedin Successfull !!!';
        // redirect(url_base('admin.php'));

        // $session = new Session();
        $session->set_session_flash_data( array('login_message' => 'Loggin Successfull !!!') );
        $session->set_session_data( array('user_data' => $users[0]) );

        redirect(url_base('blank.php'));
    } else {
        // echo 'Loggedin Failed !!!';
        // $session = new Session();
        $session->set_session_flash_data( array('login_message' => 'Loggin Failed !!!') );
        $session->set_session_flash_data( array('email' => $_POST['email']) );
        $session->set_session_flash_data( array('password' => $_POST['password']) );
        $session->unset_session_data();

        // data_print( $session->get_session_flash_data() );
        // data_print( $session->get_session_flash_data('login_message') );
        // data_print($_SESSION['flash_data']);
        redirect(url_base('login.php'));
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

    <?php require_once('include/common_style.php'); ?>

    <style type="text/css">

    </style>

</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Login</h3>
                    </div>
                    <?php
                        if( $session->get_session_flash_data('login_message') != '' ) {
                    ?>
                        <div class="panel-heading">
                            <h3 class="panel-title text_red"><?php echo $session->get_session_flash_data('login_message'); ?></h3>
                        </div>
                    <?php
                        }
                    ?>
                    <div class="panel-body">
                        <form id="form_admin_login" name="form_admin_login" method="POST" action="" role="form" accept-charset="utf-8">
                            <input type="hidden" id="hid_admin_login" name="hid_admin_login" value="hid_admin_login" />
                            <fieldset>
                                <div class="form-group">
                                    <input type="text" id="email" name="email" class="form-control" value="<?php echo $session->get_session_flash_data('email'); ?>" placeholder="Email" autofocus="autofocus" />
                                </div>
                                <div class="form-group">
                                    <input type="password" id="password" name="password" class="form-control" value="<?php echo $session->get_session_flash_data('password'); ?>" placeholder="Password" />
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id="remember" name="remember" value="remember" />Remember Me
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <input type="button" id="btn_login" name="btn_login" class="btn btn-lg btn-success btn-block" value="Login" />
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>

<?php require_once('include/common_script.php'); ?>

<script type="text/javascript">

    jQuery(document).ready(function() {
        jQuery(document).on('click', '#btn_login', function() {
            var email = jQuery('#form_admin_login #email').val();
            var password = jQuery('#form_admin_login #password').val();

            if ( email == '' ) {
            // Check Email is entered or not?
                alert('Please enter the Email.');
                jQuery('#form_admin_login #email').focus();

            return false;
            } else if ( password == '' ) {
            // Check Password is entered or not?
                alert('Please enter the Password.');
                jQuery('#form_admin_login #password').focus();

            return false;
            }
            jQuery('#form_admin_login').submit();
        });
    });

</script>

</html>
