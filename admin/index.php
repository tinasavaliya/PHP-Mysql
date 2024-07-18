<?php
include_once 'php_files/config.php';
//checking session
session_start();
if (isset($_SESSION['admin_name'])) {
    header("Location: " . $base_url . "admin/dashboard.php");
}
?>
<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin : OnlineShop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" integrity="sha512-jnSuA4Ss2PkkikSOLtYs8BlYIeeIK1h99ty4YfvRPAlzr377vr3CXDb7sb7eEEBYjDtcYj+AjBH3FLv5uSJuXg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../css/stylesheet.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="offset-3 col-md-6">
                <div class="login-form">
                    <h1 class="fs-30 fw-700 text-uppercase text-black text-center pb-lg-3 pb-2">Online Shop</h1>
                    <!-- Form -->
                    <form id="adminLogin" method="POST">
                        <div class="admin-login-form">
                            <div class="form-group mb-lg-3 mb-2">
                                <label>Username</label>
                                <input type="name" class="form-control username" placeholder="Username">
                            </div>
                            <div class="form-group mb-lg-3 mb-2">
                                <label>Password</label>
                                <input type="password" class="form-control password" placeholder="password">
                            </div>
                            <input type="submit" name="login" class="btn-golden w-100 fs-20 fw-600 text-uppercase" value="login" />
                        </div>
                    </form>
                    <!-- /Form -->
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="js/admin_actions.js"></script>
</body>

</html>