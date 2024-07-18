<?php
$sql2 = "select site_name,site_logo,currency_format from options";
$result2 = mysqli_query($conn, $sql2) or die("Query Failed");
$cur_format = '$';
if (!empty($header[0]['currency_format'])) {
    $cur_format = $header[0]['currency_format'];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.css" integrity="sha512-yHknP1/AwR+yx26cB1y0cjvQUMvEa2PFzt1c9LlS4pRQ5NOTZFWbhBig+X9G9eYW/8m0/4OXNx8pxJ6z57x0dw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/stylesheet.css?v=<?php echo time(); ?>">
    <title>Online Shopping</title>
</head>

<body>
    <div id="header">
        <div class="container">
            <div class="row align-items-center">
                <!-- LOGO -->
                <div class="col-md-2">
                    <?php
                    include "config.php";
                    $sql = "select site_logo, site_name from options";
                    $result = mysqli_query($conn, $sql) or die("Query Failed");
                    $row = mysqli_fetch_assoc($result);
                    if (!empty($row['site_logo'])) { ?>
                        <a href="<?php echo $hostname; ?>" class="logo-img desktop-logo"><img src="images/<?php echo $row['site_logo']; ?>" alt="desktop logo"></a>
                        <a href="#" class="logo-img mobile-logo"><img src=".././online-shopping/images/responsive-logo.png" alt="mobile logo"></a>
                    <?php } else { ?>
                        <a href="<?php echo $hostname; ?>" class="logo"><?php echo $row['site_name']; ?></a>
                    <?php } ?>
                </div>
                <!-- /LOGO -->
                <!-- seerch products-->
                <div class="col-md-7 col-12">
                    <form action="search.php" method="GET">
                        <div class="search-wrapper search">
                            <div class="search-main">
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="Search for...">
                                    <span class="input-group-btn">
                                        <input class="btn btn-dark" type="submit" value="Search" />
                                    </span>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-3 d-flex user-profile-menu align-items-center justify-content-end">
                    <ul class="header-info d-flex align-items-center gap-2">
                        <li class="">
                            <a class="dropdown-toggle text-gray fs-17 fw-700" href="#" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <?php
                                if (session_status() == PHP_SESSION_NONE) {
                                    session_start();
                                }
                                if (isset($_SESSION["user_role"])) { ?>
                                    Hello <?php echo $_SESSION["username"]; ?>
                                <?php  } else { ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="19px" width="19px">
                                        <path d="M224 256A128 128 0 1 0 224 0a128 128 0 1 0 0 256zm-45.7 48C79.8 304 0 383.8 0 482.3C0 498.7 13.3 512 29.7 512H418.3c16.4 0 29.7-13.3 29.7-29.7C448 383.8 368.2 304 269.7 304H178.3z" />
                                    </svg>
                                <?php  } ?>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- Trigger the modal with a button -->
                                <?php
                                if (isset($_SESSION["user_role"])) { ?>
                                    <li><a href="user_profile.php" class="dropdown-item">My Profile</a></li>
                                    <li><a href="user_orders.php" class="dropdown-item">My Orders</a></li>
                                    <li><a href="javascript:void(0)" class="user_logout dropdown-item">Logout</a></li>
                                <?php  } else { ?>
                                    <li><a href="javascript:void(0)" class="dropdown-item" data-bs-toggle="modal" data-bs-target="#userLogin_form">Login</a></li>
                                    <li><a href="register.php" class="dropdown-item">Register</a></li>
                                <?php  } ?>
                            </ul>
                        </li>
                        <li>
                            <a href="wishlist.php">

                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="20px" width="20px">
                                    <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z" />
                                </svg>
                                <?php if (isset($_COOKIE['wishlist_count'])) {
                                    echo '<span>' . $_COOKIE["wishlist_count"] . '</span>';
                                } ?>
                            </a>
                        </li>
                        <li>
                            <a href="cart.php">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" height="20px" width="20px">
                                    <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z" />
                                </svg>
                                <?php if (isset($_COOKIE['cart_count'])) {
                                    echo '<span>' . $_COOKIE["cart_count"] . '</span>';
                                } ?>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="col-lg-none col-md-7">
                    <ul class="d-flex position-absolute responsive-icon p-2">
                        <li class="humburgmenu">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="20px" width="20px" fill="#000">
                                <path d="M0 96C0 78.3 14.3 64 32 64H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32C14.3 128 0 113.7 0 96zM0 256c0-17.7 14.3-32 32-32H416c17.7 0 32 14.3 32 32s-14.3 32-32 32H32c-17.7 0-32-14.3-32-32zM448 416c0 17.7-14.3 32-32 32H32c-17.7 0-32-14.3-32-32s14.3-32 32-32H416c17.7 0 32 14.3 32 32z" />
                            </svg>
                        </li>
                        <li class="search-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="20px" width="20px" fill="#fff">
                                <path d="M416 208c0 45.9-14.9 88.3-40 122.7L502.6 457.4c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L330.7 376c-34.4 25.2-76.8 40-122.7 40C93.1 416 0 322.9 0 208S93.1 0 208 0S416 93.1 416 208zM208 352a144 144 0 1 0 0-288 144 144 0 1 0 0 288z" />
                            </svg>
                        </li>
                        <li class="close humburgmenu">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="#fff" height="20px" width="20px">
                                <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                            </svg>
                        </li>

                    </ul>
                </div>
                <div class="modal fade" id="userLogin_form" tabindex="-1" role="dialog">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-body">
                                <!-- Form -->
                                <form id="loginUser" method="POST" autocomplete="on">
                                    <div class="customer_login py-lg-4 py-3">
                                        <h2 class="fs-30 fw-700 text-uppercase text-black text-center pb-lg-3 pb-2">login here</h2>
                                        <div class="form-group mb-lg-3 mb-2">
                                            <label>Username</label>
                                            <input type="email" class="form-control username" placeholder="Username" autocomplete="on" id="email">
                                        </div>
                                        <div class="form-group mb-lg-3 mb-2">
                                            <label>Password</label>
                                            <input type="password" class="form-control password" placeholder="password">
                                        </div>
                                        <input type="submit" name="login" class="btn-golden w-100 fs-20 fw-600 text-uppercase" value="login" />
                                        <span class="mt-lg-4 mt-4 text-gray fs-17 fw-500 text-strat">Don't Have an Account<a href="register.php" class="ms-lg-2 text-golden gw-700">Register</a></span>
                                    </div>
                                </form>
                                <!-- /Form -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Modal -->
            </div>
        </div>
    </div>
    <div id="header-menu" class="bg-black">
        <div class="container-fluid">
            <ul class="menu-list">
                <?php
                $sql1 = "SELECT cat_products, sub_cat_id, sub_cat_title FROM sub_categories WHERE cat_products > 0 AND show_in_header = '1'";
                $result1 = mysqli_query($conn, $sql1) or die("Query Failed");

                // Check if there are any rows returned
                if (mysqli_num_rows($result1) > 0) {
                    while ($row1 = mysqli_fetch_assoc($result1)) { ?>
                        <li><a href="category.php?cat=<?php echo $row1['sub_cat_id']; ?>"><?php echo $row1['sub_cat_title']; ?></a></li>
                <?php }
                }
                ?>
            </ul>

        </div>
    </div>