<?php
include 'config.php';

// Fetch sub-category and brands
if (isset($_POST['p_cat'])) {
    $cat = (int) $_POST['p_cat'];
    $output = [];

    // Fetch sub-categories
    $sub_categories = "SELECT * FROM sub_categories WHERE cat_parent = $cat";
    $result = mysqli_query($conn, $sub_categories) or die(json_encode(['error' => 'Query Failed']));
    $sub_category = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if ($sub_category) {
        $output['sub_category'] = $sub_category;
    }

    // Fetch brands
    $brands = "SELECT * FROM brands WHERE brand_cat = $cat";
    $result = mysqli_query($conn, $brands) or die(json_encode(['error' => 'Query Failed']));
    $brands = mysqli_fetch_all($result, MYSQLI_ASSOC);

    if ($brands) {
        $output['brands'] = $brands;
    }

    echo json_encode($output);
    exit;
}

// Product insert script
if (isset($_POST['create'])) {
    $requiredFields = ['product_title', 'product_cat', 'product_sub_cat', 'product_desc', 'product_price', 'product_qty', 'product_status'];

    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            echo json_encode(['error' => ucfirst(str_replace('_', ' ', $field)) . ' Field is Empty.']);
            exit;
        }
    }

    if (!isset($_FILES['featured_img']['name']) || empty($_FILES['featured_img']['name'])) {
        echo json_encode(['error' => 'Image Field is Empty.']);
        exit;
    }

    $errors = [];
    $file_name = $_FILES['featured_img']['name'];
    $file_size = $_FILES['featured_img']['size'];
    $file_tmp = $_FILES['featured_img']['tmp_name'];
    $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed_extensions = ["jpeg", "jpg", "png"];

    if (!in_array($file_ext, $allowed_extensions)) {
        $errors[] = 'Extension not allowed, please choose a JPEG or PNG file.';
    }

    if ($file_size > 2097152) {
        $errors[] = 'File size must be exactly 2 MB';
    }

    if (!empty($errors)) {
        echo json_encode(['error' => $errors]);
        exit;
    }

    $file_name = time() . '-' . str_replace([' ', '_'], '-', $file_name);
    $product_title = mysqli_real_escape_string($conn, $_POST['product_title']);
    $product_cat = (int) $_POST['product_cat'];
    $product_sub_cat = (int) $_POST['product_sub_cat'];
    $product_brand = isset($_POST['product_brand']) ? (int) $_POST['product_brand'] : 0;
    $product_desc = mysqli_real_escape_string($conn, $_POST['product_desc']);
    $product_price = (float) $_POST['product_price'];
    $product_qty = (int) $_POST['product_qty'];
    $product_status = (int) $_POST['product_status'];
    $product_code = uniqid();

    $product_check = "SELECT product_title FROM products WHERE product_title = '$product_title'";
    $result = mysqli_query($conn, $product_check);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(['error' => 'Title Already Exists.']);
        exit;
    }

    $insert_product = "
        INSERT INTO products (
            product_title, product_code, product_cat, product_sub_cat, product_brand, featured_image, product_desc, product_price, qty, product_status
        ) VALUES (
            '$product_title', '$product_code', '$product_cat', '$product_sub_cat', '$product_brand', '$file_name', '$product_desc', '$product_price', '$product_qty', '$product_status'
        )";
    
    if (mysqli_query($conn, $insert_product)) {
        move_uploaded_file($file_tmp, "../../product-images/$file_name");
        $update_sub_cat = "UPDATE sub_categories SET cat_products = cat_products + 1 WHERE sub_cat_id = $product_sub_cat";
        mysqli_query($conn, $update_sub_cat);
        echo json_encode(['success' => 'Product added successfully']);
        exit;
    } else {
        echo json_encode(['error' => 'Product insertion failed']);
        exit;
    }
}

// Product update script
if (isset($_POST['update'])) {
    $requiredFields = ['product_id', 'product_title', 'product_cat', 'product_sub_cat', 'product_desc', 'product_price', 'product_qty', 'product_status'];

    foreach ($requiredFields as $field) {
        if (!isset($_POST[$field]) || empty($_POST[$field])) {
            echo json_encode(['error' => ucfirst(str_replace('_', ' ', $field)) . ' Field is Empty.']);
            exit;
        }
    }

    $product_id = (int) $_POST['product_id'];
    $product_title = mysqli_real_escape_string($conn, $_POST['product_title']);
    $product_cat = (int) $_POST['product_cat'];
    $product_sub_cat = (int) $_POST['product_sub_cat'];
    $product_desc = mysqli_real_escape_string($conn, $_POST['product_desc']);
    $product_price = (float) $_POST['product_price'];
    $product_qty = (int) $_POST['product_qty'];
    $product_status = (int) $_POST['product_status'];
    $product_brand = isset($_POST['product_brand']) ? (int) $_POST['product_brand'] : 0;

    $file_name = !empty($_POST['old_image']) ? $_POST['old_image'] : '';
    if (!empty($_FILES['new_image']['name'])) {
        $errors = [];
        $file_name = $_FILES['new_image']['name'];
        $file_size = $_FILES['new_image']['size'];
        $file_tmp = $_FILES['new_image']['tmp_name'];
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

        if (!in_array($file_ext, $allowed_extensions)) {
            $errors[] = 'Extension not allowed, please choose a JPEG or PNG file.';
        }

        if ($file_size > 2097152) {
            $errors[] = 'File size must be exactly 2 MB';
        }

        if (file_exists("../../product-images/".$_POST['old_image'])) {
            unlink("../../product-images/".$_POST['old_image']);
        }

        $file_name = time() . '-' . str_replace([' ', '_'], '-', $file_name);
        if (!empty($errors)) {
            echo json_encode(['error' => $errors]);
            exit;
        }
    }

    $update_product = "
        UPDATE products SET
            product_title = '$product_title',
            product_cat = '$product_cat',
            product_sub_cat = '$product_sub_cat',
            product_brand = '$product_brand',
            featured_image = '$file_name',
            product_desc = '$product_desc',
            product_price = '$product_price',
            qty = '$product_qty',
            product_status = '$product_status'
        WHERE product_id = $product_id
    ";

    if (mysqli_query($conn, $update_product)) {
        if (!empty($_FILES['new_image']['name'])) {
            move_uploaded_file($file_tmp, "../../product-images/$file_name");
        }
        echo json_encode(['success' => 'Product updated successfully']);
        exit;
    } else {
        echo json_encode(['error' => 'Product update failed']);
        exit;
    }
}

// Product delete script
if (isset($_POST['delete_id'])) {
    $id = (int) $_POST['delete_id'];
    $sub_cat = (int) $_POST['p_subcat'];

    $delete_product = "DELETE FROM products WHERE product_id = $id";
    $update_sub_cat = "UPDATE sub_categories SET cat_products = cat_products - 1 WHERE sub_cat_id = $sub_cat";

    if (mysqli_query($conn, $delete_product) && mysqli_query($conn, $update_sub_cat)) {
        echo json_encode(['success' => 'Product deleted successfully']);
        exit;
    } else {
        echo json_encode(['error' => 'Product deletion failed']);
        exit;
    }
}
?>
