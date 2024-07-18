<?php
include 'config.php';
session_start();
if (isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'user') {
    header("Location: " . $hostname . "/register.php");
} else {

    include 'header.php'; ?>
    <div class="container">
        <div class="row justify-content-center section-padding">
            <div class="col-md-6">
                <!-- Form -->
                <form id="register_sign_up" class="signup_form" method="POST" autocomplete="on">
                    <h2 class="fs-25 text-uppercase fw-700 text-center mb-lg-4 mb-3">register here</h2>
                    <div class="form-group mb-lg-3 mb-2">
                        <label>First Name</label>
                        <input type="text" name="f_name" class="form-control first_name" placeholder="First Name" autocomplete="on" id= "f_name"/>
                    </div>
                    <div class="form-group mb-lg-3 mb-2">
                        <label>Last Name</label>
                        <input type="text" name="l_name" class="form-control last_name" placeholder="Last Name" autocomplete="on" id= "l_name" />
                    </div>
                    <div class="form-group mb-lg-3 mb-2">
                        <label>Username / Email</label>
                        <input type="email" name="username" class="form-control user_name" placeholder="Email Address" autocomplete="on" id= "username" />
                    </div>
                    <div class="form-group mb-lg-3 mb-2">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control pass_word" placeholder="Password" autocomplete="on" id= "password" />
                    </div>
                    <div class="form-group mb-lg-3 mb-2">
                        <label>Mobile</label>
                        <input type="phone" name="mobile" class="form-control mobile" placeholder="Mobile" autocomplete="on" id= "mobile" />
                    </div>
                    <div class="form-group mb-lg-3 mb-2">
                        <label>Address</label>
                        <input type="text" name="address" class="form-control address" placeholder="Address" autocomplete="on" id= "address">
                    </div>
                    <div class="form-group mb-lg-3 mb-2">
                        <label>City</label>
                        <input type="text" name="city" class="form-control city" placeholder="City" autocomplete="on" id= "city">
                    </div>
                    <input type="submit" name="signup" class="btn-golden fs-22 fw-700" value="sign up" />
                </form>
                <!-- /Form -->
            </div>
        </div>
    </div>
<?php include 'footer.php';
}
?>