<?php
include 'config.php';

// Product insert script
if (isset($_POST['create'])) {
    $requiredFields = ['brand_title', 'brand_cat'];

    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            echo json_encode(['error' => ucfirst(str_replace('_', ' ', $field)) . ' Field is Empty.']);
            exit;
        }
    }

    $brand_title = mysqli_real_escape_string($conn, $_POST['brand_title']);
    $brand_cat = (int) $_POST['brand_cat'];

    $brands_check = "SELECT brand_title FROM brands WHERE brand_title = '{$brand_title}' AND brand_cat = '{$brand_cat}'";
    $result = mysqli_query($conn, $brands_check);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['error' => 'Brand title already exists.']);
        exit;
    }

    $insert_brands = "
        INSERT INTO brands (brand_title, brand_cat) 
        VALUES ('$brand_title', '$brand_cat')";

    if (mysqli_query($conn, $insert_brands)) {
        echo json_encode(['success' => 'Brand inserted successfully']);
    } else {
        echo json_encode(['error' => 'Brand insertion failed']);
    }
    exit;
}

// Product update script
if (isset($_POST['update'])) {
    $requiredFields = ['brand_id', 'brand_title', 'brand_cat'];

    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            echo json_encode(['error' => ucfirst(str_replace('_', ' ', $field)) . ' Field is Empty.']);
            exit;
        }
    }

    $brand_id = (int) $_POST['brand_id'];
    $brand_title = mysqli_real_escape_string($conn, $_POST['brand_title']);
    $brand_cat = (int) $_POST['brand_cat'];

    $update_brands = "
        UPDATE brands SET
            brand_title = '$brand_title',
            brand_cat = '$brand_cat'
        WHERE brand_id = $brand_id";

    if (mysqli_query($conn, $update_brands)) {
        echo json_encode(['success' => 'Brand updated successfully']);
    } else {
        echo json_encode(['error' => 'Brand update failed']);
    }
    exit;
}

// Product delete script
if (isset($_POST['delete_id'])) {
    $id = (int) $_POST['delete_id'];

    $delete_brands = "DELETE FROM brands WHERE brand_id = $id";

    if (mysqli_query($conn, $delete_brands)) {
        echo json_encode(['success' => 'Brand deleted successfully']);
    } else {
        echo json_encode(['error' => 'Brand deletion failed']);
    }
    exit;
}
?>
