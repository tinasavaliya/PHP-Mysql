<?php
include 'config.php';

$brand = $_GET['brand'];
$brands = "SELECT brand_id, brand_title FROM brands WHERE brand_id = '{$brand}' ";
$result = mysqli_query($conn, $brands) or die("Query failed");
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $title = $row['brand_title'] . ' : Buy ' . $row['brand_title'] . ' Products at Best Price';
} else {
    $title = "Result Not Found";
}
$page_head = $row['brand_title'];
?>
<?php include 'header.php'; ?>
<div class="product-section content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-head"><?php echo $page_head; ?> </h2>
            </div>
        </div>
        <?php if (!empty($result)) { ?>
            <div class="row">
                <div class="col-lg-2 col-md-6 col-12 left-sidebar">

                    <h3>Related Categories</h3>
                    <ul>
                        <?php
                        $brands2 = "SELECT sub_categories.sub_cat_id,sub_categories.sub_cat_title from brands left join sub_categories ON sub_categories.cat_parent = brands.brand_cat WHERE brands.brand_id = '{$brand}' ";
                        $row3 = mysqli_query($conn, $brands2) or die("Query failed");
                        $sub_categories = mysqli_fetch_all($row3, MYSQLI_ASSOC);


                        if (!empty($sub_categories) && count($sub_categories) > 0) {
                            foreach ($sub_categories as $row2) { ?>
                                <li><a href="category.php?cat=<?php echo $row2['sub_cat_id']; ?>"><?php echo $row2['sub_cat_title']; ?></a></li>
                        <?php }
                        }
                        ?>
                    </ul>
                </div>
                <div class="col-md-9 col-12">
                    <?php
                    $limit = 8;

                    $products3 = "SELECT * FROM products WHERE  product_brand = '{$brand}' AND product_status = 1 AND qty > 0";
                    $row = mysqli_query($conn, $products3) or die("Query failed");
                    $result3 = mysqli_fetch_all($row, MYSQLI_ASSOC);

                    if (count($result3) > 0) {
                        foreach ($result3 as $row3) { ?>
                            <div class="col-md-4 col-sm-6">
                                <div class="product-grid">
                                    <div class="product-image">
                                        <a class="image" href="single_product.php?pid=<?php echo $row3['product_id']; ?>">
                                            <img class="pic-1" src="product-images/<?php echo $row3['featured_image']; ?>">
                                        </a>
                                        <div class="product-button-group">
                                            <a href="single_product.php?pid=<?php echo $row3['product_id']; ?>"><i class="fa fa-eye"></i></a>
                                            <a href="" class="add-to-cart" data-id="<?php echo $row3['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a>
                                            <a href="" class="add-to-wishlist" data-id="<?php echo $row3['product_id']; ?>"><i class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title">
                                            <a href="single_product.php?pid=<?php echo $row3['product_id']; ?>"><?php echo substr($row3['product_title'], 0, 30) . '...'; ?></a>
                                        </h3>
                                        <div class="price"><?php echo $cur_format; ?> <?php echo $row3['product_price']; ?></div>
                                    </div>
                                </div>
                            </div>
                    <?php    }
                    } ?>
                    <div class="col-md-12 pagination-outer">
                       
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include 'footer.php'; ?>