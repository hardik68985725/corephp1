<?php
echo $_SERVER['DOCUMENT_ROOT'];

require_once('include/Main.php');

$users = array();
$user = new user();
// $users = $user->get_all_user();

$array_column = array('user_id', 'user_name', 'user_email');
$array_filter = array(
    'user_name' => "user'1",
    'or user_password' => 'user1'
);
$users = $user->get_user_by($array_column, $array_filter);

// $user->set_user_id('7');
// $user->set_user_name('user8');
// $user->set_user_password('user7');
// $user->set_user_email('user7@gmail.com');
// data_print($user->insert_user());
// data_print($user->update_user());
// data_print($user->delete_user());

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>index</title>

    <style type="text/css">
    table {
        border: 1px solid;
        border-spacing: 0px;
    }
    table th,
    table td {
        vertical-align: top;
        border: 1px solid;
    }
    </style>
</head>
<body>
    <h3>Users</h3>
    <div>
        <table>
            <thead>
                <tr>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach ($users as $user_key => $user) {
                ?>
                <tr>
                    <td><?php echo $user->user_name; ?></td>
                    <td><?php echo $user->user_email; ?></td>
                    <td>
                        <input type="button" value="Edit <?php echo $user->user_id; ?>" />
                        <input type="button" value="Delete <?php echo $user->user_id; ?>" />
                    </td>
                </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
