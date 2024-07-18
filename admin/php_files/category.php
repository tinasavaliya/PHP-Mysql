<?php
include 'config.php';

if (isset($_POST['create'])) {
    if (!isset($_POST['cat']) || empty($_POST['cat'])) {
        echo json_encode(array('error' => 'Category Field is Empty.'));
    } else {


        $category = ($_POST['cat']);
        $cat = "SELECT * FROM categories WHERE category_title = '{$category}'";
        $row = mysqli_query($conn, $cat);
        $exist = mysqli_fetch_all($row, MYSQLI_ASSOC);
        if (!empty($exist)) {
            echo json_encode(array('error' => 'Category Already exists.'));
        } else {

            $insert_cat = "
            INSERT INTO categories (
                category_title
            ) VALUES (
                '$category')";
            if (mysqli_query($conn, $insert_cat)) {
                echo json_encode(['success' => 'Category Inserted successfully']);
                exit;
            } else {
                echo json_encode(['error' => 'Category Inserted failed']);
                exit;
            }
        }
    }
}


if (isset($_POST['update'])) {
    if (!isset($_POST['id']) || empty($_POST['id'])) {
        echo json_encode(array('error' => 'ID is Empty.'));
        exit;
    }
    if (!isset($_POST['category_title']) || empty($_POST['category_title'])) {
        echo json_encode(array('error' => 'Category Field is Empty.'));
        exit;
    } else {

        $id = ($_POST['id']);
        $category_title =($_POST['category_title']);

        $update_cat = "UPDATE categories SET category_title = '$category_title' where id = $id";
        if (mysqli_query($conn, $update_cat)) {
            echo json_encode(['success' => 'Category updated successfully']);
            exit;
        } else {
            echo json_encode(['error' => 'Category updated failed']);
            exit;
        }
    }
}

if (isset($_POST['delete_id'])) {
    $id = ($_POST['delete_id']);
    $delete_cat = "DELETE FROM categories WHERE id = $id";

    if (mysqli_query($conn, $delete_cat)) {
        echo json_encode(['success' => 'Category deleted successfully']);
        exit;
    } else {
        echo json_encode(['error' => 'Category deletion failed']);
        exit;
    }
}
