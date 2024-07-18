<?php
// database class
include 'config.php';

if (isset($_POST['login'])) {

    if (!isset($_POST['username']) || empty($_POST['username'])) {
        echo json_encode(array('error' => 'username_empty'));
        exit;
    } elseif (!isset($_POST['password']) || empty($_POST['password'])) {
        echo json_encode(array('error' => 'pass_empty'));
        exit;
    } else {

        $username = mysqli_real_escape_string($conn, $_POST['username']);
        // $password = md5($conn, $_POST['password']);
        $password = md5($_POST['password']);

        $query = "SELECT admin_name FROM admin WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($conn, $query);

        if (!$result) {
            echo json_encode(array('error' => 'query_failed', 'details' => mysqli_error($conn)));
            exit;
        }

        $admin = mysqli_fetch_all($result, MYSQLI_ASSOC);

        if (!empty($admin)) {
            session_start();
            $_SESSION["admin_name"] = $admin[0]['admin_name'];
            echo json_encode(array('success' => 'true'));
            exit;
        } else {
            echo json_encode(array('error' => 'false'));
            exit;
        }
    }
}
if (isset($_POST['changePass'])) {
    $old_pass = isset($_POST['old_pass']) ? mysqli_real_escape_string($conn, $_POST['old_pass']) : null;
    $new_pass = isset($_POST['new_pass']) ? mysqli_real_escape_string($conn, $_POST['new_pass']) : null;

    if (!$old_pass) {
        echo json_encode(['error' => 'Old Password field Empty']);
        exit;
    } elseif (!$new_pass) {
        echo json_encode(['error' => 'New Password field Empty']);
        exit;
    } else {
        $old = md5($old_pass);
        $new = md5($new_pass);


        $sql = "UPDATE user SET password = '$new' WHERE password = '$old'";
        
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['success' => 'Password Updated successfully']);
            exit;
        } else {
            echo json_encode(['error' => 'Password Updated failed']);
            exit;
        }
    }
}
