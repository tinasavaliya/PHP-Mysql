<?php
// Include header file
include 'header.php';
?>
<div class="admin-content-container">
    <h2 class="admin-heading">All Products</h2>
    <a class="add-new pull-right" href="add_product.php">Add New</a>
    <?php
    $limit = 10;
    $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($page - 1) * $limit;

    // Query to fetch products with pagination
    $products_sql = "SELECT 
        products.product_id,
        products.product_code,
        products.product_cat,
        products.product_sub_cat,
        products.product_brand,
        products.product_title,
        products.product_price,
        products.qty,
        products.product_status,
        products.featured_image,
        sub_categories.sub_cat_title,
        brands.brand_title 
        FROM products
        LEFT JOIN sub_categories ON products.product_sub_cat = sub_categories.sub_cat_id 
        LEFT JOIN brands ON products.product_brand = brands.brand_id
        ORDER BY products.product_id DESC 
        LIMIT $limit OFFSET $offset";
    $products_result = mysqli_query($conn, $products_sql) or die("Query failed");

    if (mysqli_num_rows($products_result) > 0) { ?>
        <table id="productsTable" class="table table-striped table-hover table-bordered">
            <thead>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Status</th>
                <th width="100px">Action</th>
            </thead>
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($products_result)) { ?>
                    <tr>
                        <td><b><?php echo 'PDR00' . $row['product_id']; ?></b></td>
                        <td><?php echo $row['product_title']; ?></td>
                        <td><?php echo $row['sub_cat_title']; ?></td>
                        <td><?php echo $row['brand_title']; ?></td>
                        <td><?php echo $currency_format . $row['product_price']; ?></td>
                        <td><?php echo $row['qty']; ?></td>
                        <td>
                            <?php if ($row['featured_image'] != '') { ?>
                                <img src="../product-images/<?php echo $row['featured_image']; ?>" alt="<?php echo $row['featured_image']; ?>" width="50px" />
                            <?php } else { ?>
                                <img src="images/index.png" alt="" width="50px" />
                            <?php } ?>
                        </td>
                        <td>
                            <?php
                            if ($row['product_status'] == '1') {
                                echo '<span class="label label-success">Active</span>';
                            } else {
                                echo '<span class="label label-danger">Inactive</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $row['product_id'];  ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="15px" width="15px">
                                    <path d="M441 58.9L453.1 71c9.4 9.4 9.4 24.6 0 33.9L424 134.1 377.9 88 407 58.9c9.4-9.4 24.6-9.4 33.9 0zM209.8 256.2L344 121.9 390.1 168 255.8 302.2c-2.9 2.9-6.5 5-10.4 6.1l-58.5 16.7 16.7-58.5c1.1-3.9 3.2-7.5 6.1-10.4zM373.1 25L175.8 222.2c-8.7 8.7-15 19.4-18.3 31.1l-28.6 100c-2.4 8.4-.1 17.4 6.1 23.6s15.2 8.5 23.6 6.1l100-28.6c11.8-3.4 22.5-9.7 31.1-18.3L487 138.9c28.1-28.1 28.1-73.7 0-101.8L474.9 25C446.8-3.1 401.2-3.1 373.1 25zM88 64C39.4 64 0 103.4 0 152V424c0 48.6 39.4 88 88 88H360c48.6 0 88-39.4 88-88V312c0-13.3-10.7-24-24-24s-24 10.7-24 24V424c0 22.1-17.9 40-40 40H88c-22.1 0-40-17.9-40-40V152c0-22.1 17.9-40 40-40H200c13.3 0 24-10.7 24-24s-10.7-24-24-24H88z" />
                                </svg></a>
                            <a class="delete_product" href="javascript:void(0)" data-id="<?php echo $row['product_id'] ?>" data-subcat="<?php echo $row['product_sub_cat'] ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="15px" width="15px">
                                    <path d="M170.5 51.6L151.5 80h145l-19-28.4c-1.5-2.2-4-3.6-6.7-3.6H177.1c-2.7 0-5.2 1.3-6.7 3.6zm147-26.6L354.2 80H368h48 8c13.3 0 24 10.7 24 24s-10.7 24-24 24h-8V432c0 44.2-35.8 80-80 80H112c-44.2 0-80-35.8-80-80V128H24c-13.3 0-24-10.7-24-24S10.7 80 24 80h8H80 93.8l36.7-55.1C140.9 9.4 158.4 0 177.1 0h93.7c18.7 0 36.2 9.4 46.6 24.9zM80 128V432c0 17.7 14.3 32 32 32H336c17.7 0 32-14.3 32-32V128H80zm80 64V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16zm80 0V400c0 8.8-7.2 16-16 16s-16-7.2-16-16V192c0-8.8 7.2-16 16-16s16 7.2 16 16z" /></svg>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <div class="not-found clearfix">!!! No Products Found !!!</div>
    <?php } ?>

    <div class="col-md-12 pagination-outer">
        <?php
        $total_pages_sql = "SELECT COUNT(*) FROM products";
        $total_pages_result = mysqli_query($conn, $total_pages_sql);
        $total_rows = mysqli_fetch_array($total_pages_result)[0];
        $total_pages = ceil($total_rows / $limit);

        echo '<ul class="pagination">';
        for ($i = 1; $i <= $total_pages; $i++) {
            echo '<li><a href="?page=' . $i . '">' . $i . '</a></li>';
        }
        echo '</ul>';
        ?>
    </div>
</div>
<?php
// Include footer file
include "footer.php";
?>