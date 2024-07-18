<?php include 'header.php'; ?>
<h2 class="admin-heading fs-30 fw-700 pb-lg-3 pb-2">Dashboard</h2>
<div class="row justify-content-center">
    <div class="col-12">
        <?php
        include 'php_files/config.php';
        $products = "SELECT * FROM products WHERE qty < 1";
        $result = mysqli_query($conn, $products) or die("Query failed");
        if (mysqli_num_rows($result) > 0) { ?>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th colspan="2">Out of stock</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) { ?>
                        <tr>
                            <td>Product Code</td>
                            <td><?php echo 'PDR00' . $row['product_id'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } ?>
    </div>
    <div class="col-md-4 col-sm-6 col-12">
        <?php
        $products2 = "SELECT COUNT(product_id) as p_count FROM products";
        $result = mysqli_query($conn, $products2) or die("Query failed");
        $row = mysqli_fetch_all($result, MYSQLI_ASSOC);
        ?>
        <div class="detail-box">
            <span class="count"><?php echo $row[0]['p_count']; ?></span>
            <span class="count-tag">Products</span>
        </div>
    </div>
    <div class="col-md-4 col-sm-6 col-12">
        <?php
        $categories = "SELECT COUNT(id) as c_count FROM categories";
        $result = mysqli_query($conn, $categories) or die("Query failed");
        $row2 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        ?>
        <div class="detail-box">
            <span class="count"><?php echo $row2[0]['c_count']; ?></span>
            <span class="count-tag">Categories</span>
        </div>
    </div>
    <!-- Sub Categories -->
    <div class="col-md-4 col-sm-6 col-12">
        <?php
        $sub_categories = "SELECT COUNT(sub_cat_id) as sub_count FROM sub_categories";
        $result = mysqli_query($conn, $sub_categories) or die("Query failed");
        $row3 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        ?>
        <div class="detail-box">
            <span class="count"><?php echo $row3[0]['sub_count']; ?></span>
            <span class="count-tag">Sub Categories</span>
        </div>
    </div>

     <!-- brands -->
    <div class="col-md-4 col-sm-6 col-12">
        <?php
        $brands = "SELECT COUNT(brand_id) as b_count FROM brands";
        $result = mysqli_query($conn, $brands) or die("Query failed");
        $row4 = mysqli_fetch_all($result, MYSQLI_ASSOC);
        ?>
        <div class="detail-box">
            <span class="count"><?php echo $row4[0]['b_count']; ?></span>
            <span class="count-tag">Brands</span>
        </div>
    </div>
    <!-- Orders -->
    <div class="col-md-4 col-sm-6 col-12">
        <div class="detail-box">
            <?php
            $orders = "SELECT COUNT(order_id) as o_count from order_products";
            $result = mysqli_query($conn, $orders) or die("Query failed");
            $row5 = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>
            <span class="count"><?php echo $row5[0]['o_count']; ?></span>
            <span class="count-tag">Orders</span>
        </div>
    </div>
    <!-- Users -->
    <div class="col-md-4 col-sm-6 col-12">
        <div class="detail-box">
            <?php
            $user = "SELECT COUNT(user_id) as u_count from user";
            $result = mysqli_query($conn, $user) or die("Query failed");
            $row6 = mysqli_fetch_all($result, MYSQLI_ASSOC);
            ?>
            <span class="count"><?php echo $row6[0]['u_count']; ?></span>
            <span class="count-tag">Users</span>
        </div>
    </div>
   
   

</div>
<?php
include 'footer.php' ?>