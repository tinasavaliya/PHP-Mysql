<?php
include '../config.php';

function escapeString($conn, $string) {
    return mysqli_real_escape_string($conn, trim($string));
}

if(isset($_POST['create'])) {
    $f_name = isset($_POST['f_name']) ? escapeString($conn, $_POST['f_name']) : null;
    $l_name = isset($_POST['l_name']) ? escapeString($conn, $_POST['l_name']) : null;
    $username = isset($_POST['username']) ? escapeString($conn, $_POST['username']) : null;
    $password = isset($_POST['password']) ? escapeString($conn, $_POST['password']) : null;
    $mobile = isset($_POST['mobile']) ? escapeString($conn, $_POST['mobile']) : null;
    $address = isset($_POST['address']) ? escapeString($conn, $_POST['address']) : null;
    $city = isset($_POST['city']) ? escapeString($conn, $_POST['city']) : null;

    if(!$f_name) {
        echo json_encode(['error' => 'First Name Field Empty.']);
        exit;
    } elseif (!$l_name) {
        echo json_encode(['error' => 'Last Name Field Empty.']);
        exit;
    } elseif (!$username) {
        echo json_encode(['error' => 'Username Field Empty.']);
        exit;
    } elseif (!filter_var($username, FILTER_VALIDATE_EMAIL)) {
        echo json_encode(['error' => 'Please Enter Correct Email Address.']);
        exit;
    } elseif (!$password) {
        echo json_encode(['error' => 'Password Field Empty.']);
        exit;
    } elseif (!$mobile) {
        echo json_encode(['error' => 'Mobile Number Field Empty.']);
        exit;
    } elseif (!$address) {
        echo json_encode(['error' => 'Address Field Empty.']);
        exit;
    } elseif (!$city) {
        echo json_encode(['error' => 'City Field Empty.']);
        exit;
    } else {
        $hashed_password = md5($password);

        // Check if username already exists
        $sql = "SELECT username FROM user WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            echo json_encode(['error' => 'Username Already Exists.']);
            exit;
        } else {
            $sql = "INSERT INTO user (f_name, l_name, username, password, mobile, address, city) VALUES ('$f_name', '$l_name', '$username', '$hashed_password', '$mobile', '$address', '$city')";
            if (mysqli_query($conn, $sql)) {
                session_start();
                $_SESSION["user_id"] = mysqli_insert_id($conn);
                $_SESSION["username"] = $f_name;
                $_SESSION["user_role"] = 'user';
                echo json_encode(['success' => 'Registered Successfully']);
                exit;
            } else {
                echo json_encode(['error' => 'Failed to register user.']);
                exit;
            }
        }
    }
}

if(isset($_POST['login'])) {
    $username = isset($_POST['username']) ? escapeString($conn, $_POST['username']) : null;
    $password = isset($_POST['password']) ? escapeString($conn, $_POST['password']) : null;

    if(!$username) {
        echo json_encode(['error' => 'Username Field is Empty.']);
        exit;
    } elseif(!$password) {
        echo json_encode(['error' => 'Password Field is Empty.']);
        exit;
    } else {  
        $hashed_password = md5($password);
        $sql = "SELECT user_id, username, f_name, l_name FROM user WHERE username = '$username' AND password = '$hashed_password'";
        $result = mysqli_query($conn, $sql);
        $response = mysqli_fetch_assoc($result);

        if($response) {
            session_start();
            $_SESSION["user_id"] = $response['user_id'];
            $_SESSION["username"] = $response['f_name'];
            $_SESSION["user_role"] = 'user';
            echo json_encode(['success' => 'Logged In Successfully.']);
            exit;
        } else {
            echo json_encode(['error' => 'Username and Password not matched.']);
            exit;
        }
    }
}

if(isset($_POST['user_logout'])) {
    session_start();
    session_unset();
    session_destroy();
    echo 'true';
    exit;
}

if(isset($_POST['update'])) {
    $f_name = isset($_POST['f_name']) ? escapeString($conn, $_POST['f_name']) : null;
    $l_name = isset($_POST['l_name']) ? escapeString($conn, $_POST['l_name']) : null;
    $mobile = isset($_POST['mobile']) ? escapeString($conn, $_POST['mobile']) : null;
    $address = isset($_POST['address']) ? escapeString($conn, $_POST['address']) : null;
    $city = isset($_POST['city']) ? escapeString($conn, $_POST['city']) : null;

    if(!$f_name) {
        echo json_encode(['error' => 'First Name Field Empty.']);
        exit;
    } elseif(!$l_name) {
        echo json_encode(['error' => 'Last Name Field Empty.']);
        exit;
    } elseif(!$mobile) {
        echo json_encode(['error' => 'Mobile Number Field Empty.']);
        exit;
    } elseif(!$address) {
        echo json_encode(['error' => 'Address Field Empty.']);
        exit;
    } elseif(!$city) {
        echo json_encode(['error' => 'City Field Empty.']);
        exit;
    } else {
        session_start();
        $user_id = $_SESSION['user_id'];
        $sql = "UPDATE user SET f_name = '$f_name', l_name = '$l_name', mobile = '$mobile', address = '$address', city = '$city' WHERE user_id = '$user_id'";
        if (mysqli_query($conn, $sql)) {
            echo json_encode(['success' => 'User information updated successfully.']);
            exit;
        } else {
            echo json_encode(['error' => 'Failed to update user information.']);
            exit;
        }
    }
}

if(isset($_POST['modifyPass'])) {
    $old_pass = isset($_POST['old_pass']) ? escapeString($conn, $_POST['old_pass']) : null;
    $new_pass = isset($_POST['new_pass']) ? escapeString($conn, $_POST['new_pass']) : null;

    if(!$old_pass) {
        echo json_encode(['error' => 'Old Password field Empty']);
        exit;
    } elseif(!$new_pass) {
        echo json_encode(['error' => 'New Password field Empty']);
        exit;
    } else {
        $old_hashed = md5($old_pass);
        $new_hashed = md5($new_pass);

        session_start();
        $user_id = $_SESSION['user_id'];

        $sql = "SELECT user_id FROM user WHERE user_id = '$user_id' AND password = '$old_hashed'";
        $result = mysqli_query($conn, $sql);
        $exist = mysqli_fetch_assoc($result);

        if($exist) {
            $sql = "UPDATE user SET password = '$new_hashed' WHERE user_id = '$user_id'";
            if(mysqli_query($conn, $sql)) {
                echo json_encode(['success' => 'Password changed successfully']);
                exit;
            } else {
                echo json_encode(['error' => 'Failed to change password.']);
                exit;
            }
        } else {
            echo json_encode(['error' => 'Old Password is not matched.']);
            exit;	
        }
    }
}
?>
