<?php
include 'config.php';

if (isset($_POST['update'])) {
    $errors = array();

    if (empty($_POST['s_no'])) {
        $errors[] = 'Options ID is missing.';
    }
    if (empty($_POST['site_name'])) {
        $errors[] = 'Site Name Field is Empty.';
    }
    if (empty($_POST['site_title'])) {
        $errors[] = 'Site Title Field is Empty.';
    }
    if (empty($_POST['footer_text'])) {
        $errors[] = 'Footer Text Field is Empty.';
    }
    if (empty($_POST['currency_format'])) {
        $errors[] = 'Currency Format Field is Empty.';
    }
    if (empty($_POST['site_desc'])) {
        $errors[] = 'Description Field is Empty.';
    }
    if (empty($_POST['contact_email'])) {
        $errors[] = 'Email Field is Empty.';
    }
    if (empty($_POST['contact_phone'])) {
        $errors[] = 'Phone Field is Empty.';
    }
    if (empty($_POST['contact_address'])) {
        $errors[] = 'Address Field is Empty.';
    }
    if (empty($_POST['old_logo']) && empty($_FILES['new_logo']['name'])) {
        $errors[] = 'Site Logo Field is Empty.';
    }

    if (!empty($errors)) {
        echo json_encode(array('error' => $errors));
        exit;
    }
    $file_name = '';
    if (!empty($_FILES['new_logo']['name'])) {
        $file_name = $_FILES['new_logo']['name'];
        $file_size = $_FILES['new_logo']['size'];
        $file_tmp = $_FILES['new_logo']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        $allowed_extensions = array("jpeg", "jpg", "png");

        if (!in_array($file_ext, $allowed_extensions)) {
            echo json_encode(array('error' => 'Extension not allowed, please choose a JPEG or PNG file.'));
            exit;
        }
        if ($file_size > 2097152) {
            echo json_encode(array('error' => 'File size must be exactly 2 MB.'));
            exit;
        }

        if (!empty($_POST['old_logo']) && file_exists('images/' . $_POST['old_logo'])) {
            unlink('images/' . $_POST['old_logo']);
        }

        $file_name = time() . '-' . preg_replace('/\s+/', '-', basename($file_name));

        // Ensure the images directory exists
        if (!is_dir('images')) {
            mkdir('images', 0777, true);
        }

        if (!move_uploaded_file($file_tmp, 'images/' . $file_name)) {
            echo json_encode(array('error' => 'Failed to upload file.'));
            exit;
        }
    } else {
        $file_name = $_POST['old_logo'];
    }

    $s_no = (int)$_POST['s_no'];
    $site_name = mysqli_real_escape_string($conn, $_POST['site_name']);
    $site_title = mysqli_real_escape_string($conn, $_POST['site_title']);
    $footer_text = mysqli_real_escape_string($conn, $_POST['footer_text']);
    $currency_format = mysqli_real_escape_string($conn, $_POST['currency_format']);
    $site_desc = mysqli_real_escape_string($conn, $_POST['site_desc']);
    $contact_email = mysqli_real_escape_string($conn, $_POST['contact_email']);
    $contact_phone = mysqli_real_escape_string($conn, $_POST['contact_phone']);
    $contact_address = mysqli_real_escape_string($conn, $_POST['contact_address']);

    $update = "UPDATE options SET 
                site_name = '$site_name', 
                site_title = '$site_title', 
                site_logo = '$file_name', 
                footer_text = '$footer_text', 
                currency_format = '$currency_format', 
                site_desc = '$site_desc', 
                contact_email = '$contact_email', 
                contact_phone = '$contact_phone', 
                contact_address = '$contact_address'
                WHERE s_no = $s_no";

    if (mysqli_query($conn, $update)) {
        echo json_encode(array('success' => 'Record updated successfully.'));
    } else {
        echo json_encode(array('error' => 'Record update failed.'));
    }
    if (!empty($_FILES['new_logo']['name'])) {
        /* directory in which the uploaded file will be moved */
        move_uploaded_file($file_tmp, "../../images/" . $file_name);
    }
    echo json_encode(array('success' => 'file upload success'));
    exit;
}
