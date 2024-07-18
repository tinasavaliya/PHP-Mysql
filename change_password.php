<?php
include 'config.php';
session_start();
if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'user') {
include 'header.php'; ?>
<div id="user_profile-content"  class="section-padding">
    <div class="container"> 
        <div class="row justify-content-center">
            <div class="col-md-offset-3 col-md-6">
                <?php
                //if(isset($_GET['user'])) {

                    $user = $_SESSION['user_id'];
                    $users= "SELECT username FROM user WHERE user_id = $user";
                    $row = mysqli_query($conn, $users) or die("Query failed");
                    $result = mysqli_fetch_all($row, MYSQLI_ASSOC);
                    if (count($result) > 0) {
                        ?>

                        <div class="signup_form">
                            <h2>Change Password</h2>
                            <!-- Form -->
                            <form id="modify-password" method="POST">
                                <?php foreach($result as $row) { ?>
                                    <div class="form-group mb-lg-3 mb-2">
                                        <label>Username</label>
                                        <input type="text" class="form-control" disabled
                                               value="<?php echo $row['username']; ?>" requried/>
                                    </div>
                                    <div class="form-group mb-lg-3 mb-2">
                                        <label>Old Password</label>
                                        <input type="password" name="old_pass" class="form-control old_pass"
                                               placeholder="Enter Old Password" requried/>
                                    </div>
                                    <div class="form-group mb-lg-3 mb-2">
                                        <label>New Password</label>
                                        <input type="password" name="new_pass" class="form-control new_pass"
                                               placeholder="Enter Old Password" requried/>
                                    </div>
                                    <input type="submit" name="submit" class="btn btn-golden mt-lg-4 mt-2" value="Submit"/>
                                <?php } ?>
                            </form>
                            <!-- /Form -->
                        </div>
                    <?php
                    }
                //}else{
                 //   header("location: {$hostname}/user_profile.php");
                  //  ob_flush();
                //}
                    ?>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';
}
?>