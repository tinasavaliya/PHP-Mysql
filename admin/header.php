<?php
include 'php_files/config.php';
if (!session_id()) {
    session_start();
}
if (!isset($_SESSION['admin_name'])) {
    header("location:{$base_url}/admin");
}


$option = "SELECT site_name,site_logo,currency_format FROM options";
$result = mysqli_query($conn, $option);
$row = mysqli_fetch_assoc($result);
$currency_format = $row['currency_format'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/stylesheet.css?v=<?php echo time(); ?>">
    <title>ADMIN</title>

</head>

<body>
    <!-- HEADER -->
    <div id="admin-header">
        <div class="container-fluid">
            <div class="row py-lg-4 py-2 justify-content-between">
                <div class="col-md-2">
                    <?php
                    if (!empty($row['site_logo'])) { ?>
                        <a href="dashboard.php" class="logo-img"><img src="../images/<?php echo $row['site_logo']; ?>" alt="site-logo"></a>
                    <?php } else { ?>
                        <a href="dashboard.php" class="logo"><?php echo $row['site_name']; ?></a>
                    <?php } ?>
                </div>
                <div class="col-md-2">
                    <div>
                        <a class="dropdown-toggle text-gray fs-17 fw-700" href="#" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            if (!session_id()) {
                                session_start();
                            }
                            echo 'Hi ' . $_SESSION['admin_name'];
                            ?>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="change_password.php" class="dropdown-item text-black fs-16 fw-600">Change Password</a></li>
                            <li><a href="php_files/logout.php" class="dropdown-item text-black fs-16 fw-600">Logout</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /HEADER -->
    <div id="admin-wrapper">
        <div class="container-fluid">
            <div class="row">
                <!-- Menu Bar Start -->
                <div class="col-lg-2 col-12 ps-0" id="admin-menu">
                    <ul class="menu-list">
                        <li <?php if (basename($_SERVER['PHP_SELF']) == "dashboard.php") echo 'class="active"'; ?>><a href="dashboard.php">Dashboard</a></li>
                        <li <?php if (basename($_SERVER['PHP_SELF']) == "products.php") echo 'class="active"'; ?>><a href="products.php">Products</a></li>
                        <li <?php if (basename($_SERVER['PHP_SELF']) == "category.php") echo 'class="active"'; ?>><a href="category.php">Categories</a></li>
                        <li <?php if (basename($_SERVER['PHP_SELF']) == "sub_category.php") echo 'class="active"'; ?>><a href="sub_category.php">Sub-Categories</a></li>
                        <li <?php if (basename($_SERVER['PHP_SELF']) == "brands.php") echo 'class="active"'; ?>><a href="brands.php">Brands</a></li>
                        <li <?php if (basename($_SERVER['PHP_SELF']) == "orders.php") echo 'class="active"'; ?>><a href="orders.php">Orders</a></li>
                        <li <?php if (basename($_SERVER['PHP_SELF']) == "users.php") echo 'class="active"'; ?>><a href="users.php">Users</a></li>
                        <li <?php if (basename($_SERVER['PHP_SELF']) == "options.php") echo 'class="active"'; ?>><a href="options.php">Options</a></li>
                    </ul>
                </div>
                <!-- Menu Bar End -->
                <!-- Content Start -->
                <div class="col-lg-10 col-12 clearfix" id="admin-content">