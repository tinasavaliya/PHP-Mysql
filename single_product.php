<?php
include 'config.php';  // Config file

$p_id = intval($_GET['pid']);

// Update the product view count
$sql = "UPDATE products SET product_views = product_views + 1 WHERE product_id = $p_id";
$res = mysqli_query($conn, $sql) or die("Query Failed");

// Fetch the product details
$sql1 = "SELECT * FROM products WHERE product_id = $p_id";
$single_product = mysqli_query($conn, $sql1) or die("Query Failed");

if (mysqli_num_rows($single_product) > 0) {
    $single_product = mysqli_fetch_assoc($single_product);
    $title = $single_product['product_title']; // Set dynamic header

    // Fetch the category details
    $sql2 = "SELECT * FROM sub_categories WHERE sub_cat_id = {$single_product['product_sub_cat']}";
    $result2 = mysqli_query($conn, $sql2) or die("Query Failed");
    $category = mysqli_fetch_assoc($result2);

    // Include header
    include 'header.php'; ?>
    <div class="single-product-container section-padding">
        <div class="container">
            <div class="row">
                <div class="offset-md-5 col-md-7">
                    <ul class="breadcrumb">
                        <li><a href="<?php echo $hostname; ?>">Home</a></li>
                        <li><a href="category.php?cat=<?php echo htmlspecialchars($category['sub_cat_id']); ?>"><?php echo htmlspecialchars($category['sub_cat_title']); ?></a></li>
                        <li class="active fs-16 fw-500 text-gray"><?php echo htmlspecialchars(substr($title, 0, 30)) . '.....'; ?></li>
                    </ul>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-2">
                    <div class="product-image single-img">
                        <img id="product-img" src="product-images/<?php echo htmlspecialchars($single_product['featured_image']); ?>" alt="<?php echo htmlspecialchars($single_product['product_title']); ?>" />
                        
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5">
                    <div class="product-content">
                        <h3 class="title fs-25 fw-700 mb-3"><?php echo htmlspecialchars($single_product['product_title']); ?></h3>
                        <span class="price fs-25 mb-2 fw-500"><?php echo $cur_format; ?> <?php echo htmlspecialchars($single_product['product_price']); ?></span>
                        <p class="description fs-17 mb-4"><?php echo html_entity_decode($single_product['product_desc']); ?></p>
                        <a class="add-to-cart btn btn-dark" data-id="<?php echo htmlspecialchars($single_product['product_id']); ?>" href="">Add to cart</a>
                        <a class="add-to-wishlist btn btn-dark" data-id="<?php echo htmlspecialchars($single_product['product_id']); ?>" href="">Add to Wishlist</a>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </div>
<?php include 'footer.php';
} else {
    echo 'Page Not Found';
}
?>