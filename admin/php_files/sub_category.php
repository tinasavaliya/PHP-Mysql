<?php
include 'config.php';

if (isset($_POST['create'])) {
    if (!isset($_POST['sub_cat_title']) || empty($_POST['sub_cat_title'])) {
        echo json_encode(array('error' => 'Title Field is Empty.'));
    } elseif (!isset($_POST['cat_parent']) || empty($_POST['cat_parent'])) {
        echo json_encode(array('error' => 'Parent Category Field is Empty.'));
    } else {

        $title = mysqli_real_escape_string($conn, $_POST['sub_cat_title']);
        $cat_parent =mysqli_real_escape_string($conn, $_POST['cat_parent']);

        $sub_categories = "select * from sub_categories where sub_cat_title = '{$title}' AND cat_parent = '{$cat_parent}'";
        if (mysqli_query($conn, $sub_categories)) {
            echo json_encode(['success' => 'sub Category Inserted successfully']);
            exit;
        } else {
            echo json_encode(['error' => 'sub Category Inserted failed']);
            exit;
        }
    }
}
// if (isset($_POST['update'])) {
//     if (!isset($_POST['sub_cat_id']) || empty($_POST['sub_cat_id'])) {
//         echo json_encode(array('error' => 'sub_cat_id is Empty.'));
//         exit;
//     } elseif (!isset($_POST['sub_cat_title']) || empty($_POST['sub_cat_title'])) {
//         echo json_encode(array('error' => 'sub_cat_title Field is Empty.'));
//         exit;
//     } elseif (!isset($_POST['cat_parent']) || empty($_POST['cat_parent'])) {
//         echo json_encode(array('error' => 'Parent Category Field is Empty.'));
//     } else {

//         $sub_cat_id = ($_POST['sub_cat_id']);
//         $sub_cat_title = ($_POST['sub_cat_title']);
//         $cat_parent = ($_POST['cat_parent']);

//         $update_sub_cat = "UPDATE sub_categories SET sub_cat_title = '$sub_cat_title' cat_parent = '$cat_parent' where sub_cat_id = $sub_cat_id ";
//         if (mysqli_query($conn, $update_sub_cat)) {
//             echo json_encode(['success' => 'sub Category update successfully']);
//             exit;
//         } else {
//             echo json_encode(['error' => 'sub Category update failed']);
//             exit;
//         }
//     }
// }

if (isset($_POST['update'])) {
    if (!isset($_POST['sub_cat_id']) || empty($_POST['sub_cat_id'])) {
        echo json_encode(array('error' => 'ID is Empty.'));
        exit;
    } elseif (!isset($_POST['sub_cat_title']) || empty($_POST['sub_cat_title'])) {
        echo json_encode(array('error' => 'Title Field is Empty.'));
    } elseif (!isset($_POST['cat_parent']) || empty($_POST['cat_parent'])) {
        echo json_encode(array('error' => 'Parent Category Field is Empty.'));
    } else {


        $sub_cat_id = (int)$_POST['sub_cat_id'];
        $sub_cat_title =mysqli_real_escape_string($conn, $_POST['sub_cat_title']);
        $cat_parent = mysqli_real_escape_string($conn, $_POST['cat_parent']);
        $update = "UPDATE sub_categories SET sub_cat_title = '$sub_cat_title', cat_parent = '$cat_parent' WHERE sub_cat_id = $sub_cat_id
";

        if (mysqli_query($conn, $update)) {
            echo json_encode(['success' => 'sub Category update successfully']);
            exit;
        } else {
            echo json_encode(['error' => 'sub Category update failed']);
            exit;
        }
    }
}

if (isset($_POST['delete_id'])) {
    $id = (int) ($_POST['delete_id']);

    // $sub_categories = "select cat_parent from sub_categories where sub_cat_id =$id";
    $delete_sub_cat = "DELETE FROM sub_categories WHERE sub_cat_id = $id";

    if (mysqli_query($conn, $delete_sub_cat)) {
        echo json_encode(['success' => 'sub_Category deleted successfully']);
        exit;
    } else {
        echo json_encode(['error' => 'sub_Category deletion failed']);
        exit;
    }
}

if (isset($_POST['showInHeader'])) {
    $status = $_POST['showInHeader'];
    $id = $_POST['id'];

    $sub_cat = "UPDATE sub_categories SET show_in_header = $status where sub_cat_id =$id ";

    if (mysqli_query($conn, $sub_cat)) {
        echo json_encode(['success' => 'show header successfully']);
        exit;
    } else {
        echo json_encode(['error' => 'show header failed']);
        exit;
    }
}

if (isset($_POST['showInFooter'])) {
    $status = $_POST['showInFooter'];
    $id = $_POST['id'];


    $sub_cat = "UPDATE sub_categories SET show_in_footer = $status where sub_cat_id =$id ";

    if (mysqli_query($conn, $sub_cat)) {
        echo json_encode(['success' => 'show footer successfully']);
        exit;
    } else {
        echo json_encode(['error' => 'show footer failed']);
        exit;
    }
}
