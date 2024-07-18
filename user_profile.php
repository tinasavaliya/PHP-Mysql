<?php
include 'config.php';
session_start();
if (!isset($_SESSION['user_id']) && $_SESSION['user_role'] != 'user') {
    header("Location: " . $hostname);
}
include 'header.php'; ?>
<div id="user_profile-content" class="section-padding bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-offset-3 col-md-6">
                <h2 class="section-head">My Profile</h2>
                <?php
                $user_id = $_SESSION["user_id"];
                $sql = "SELECT * FROM user WHERE user_id = '{$user_id}'";
                $result = mysqli_query($conn, $sql) or die("Query Failed");
                if ($row2 = mysqli_fetch_assoc($result)) {
                    ?>
                    <table class="table table-bordered table-responsive">
                        <tr>
                            <td><b>First Name :</b></td>
                            <td><?php echo $row2["f_name"]; ?></td>
                        </tr>
                        <tr>
                            <td><b>Last Name :</b></td>
                            <td><?php echo $row2["l_name"]; ?></td>
                        </tr>
                        <tr>
                            <td><b>Username :</b></td>
                            <td><?php echo $row2["username"]; ?></td>
                        </tr>
                        <tr>
                            <td><b>Mobile :</b></td>
                            <td><?php echo $row2["mobile"]; ?></td>
                        </tr>
                        <tr>
                            <td><b>Address :</b></td>
                            <td><?php echo $row2["address"]; ?></td>
                        </tr>
                        <tr>
                            <td><b>City :</b></td>
                            <td><?php echo $row2["city"]; ?></td>
                        </tr>
                    </table>
                    <?php
                } else {
                    echo "No user found.";
                }
                ?>
                <a class="btn btn-dark" href="edit_user.php?user=<?php echo $_SESSION['user_id']; ?>">Modify Details</a>
                <a class="btn btn-dark" href="change_password.php">Change Password</a>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php';


?>