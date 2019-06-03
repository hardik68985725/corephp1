<?php
require_once('include/Main.php');

$session = new Session();
$session_user_data = $session->get_session_data('user_data');
$session->set_session_data( array('test' => 'test') );

$admin_login_details = new stdClass();
$admin_login_details->admin_name = $session_user_data->user_name;

// data_dump($session->get_session_flash_data());
data_print($session->get_session_data());


?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Blank</title>

    <?php require_once('include/common_style.php'); ?>

    <style type="text/css">

    </style>

</head>

<body>

    <div id="wrapper">

        <?php require_once('include/navigation.php'); ?>

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Blank</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                <?php
                    if( $session->get_session_flash_data('login_message') != '' ) {
                ?>
                    <div class="panel-heading">
                        <h3 class="panel-title text_green"><?php echo $session->get_session_flash_data('login_message'); ?></h3>
                    </div>
                <?php
                    }
                ?>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

</body>

<?php require_once('include/common_script.php'); ?>

<script type="text/javascript">

    jQuery(document).ready(function() { console.log('jQuery document ready ....');
        jQuery(document).on('click', '#btn_login', function() {

        });
    });

</script>

</html>
