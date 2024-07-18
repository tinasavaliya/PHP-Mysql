<?php
 include 'config.php';
 include 'header.php';
?>

<div class="product-section content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-head">All Products</h2>
                <?php
                // calculate page
                $limit = 8;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 2;
                }
                $offset = ($page - 1) * $limit;

                $sql2 = "SELECT * FROM products WHERE product_status = 1 AND qty > 0 ORDER BY product_id DESC LIMIT {$limit}";
                $result = mysqli_query($conn, $sql2) or die("Query Failed");

                if (mysqli_num_rows($result) > 0) {
                ?>
                    <div class="row">
                        <?php
                        while ($res = mysqli_fetch_assoc($result)) { ?>

                            <div class="col-lg-3 col-sm-6">
                                <div class="product-grid">
                                    <div class="product-image latest">
                                        <a class="image" href="single_product.php?pid=<?php echo $res['product_id']; ?>">
                                            <img class="pic-1" src="product-images/<?php echo $res['featured_image']; ?>" alt="<?php echo $res['product_title']; ?>">
                                        </a>
                                        <div class="product-button-group">
                                            <a href="single_product.php?pid=<?php echo $res['product_id']; ?>"><i class="fa fa-eye"></i></a>
                                            <a href="" class="add-to-cart" data-id="<?php echo $res['product_id']; ?>"><i class="fa fa-shopping-cart"></i></a>
                                            <a href="" class="add-to-wishlist" data-id="<?php echo $res['product_id']; ?>"><i class="fa fa-heart"></i></a>
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="title">
                                            <a href="single_product.php?pid=<?php echo $res['product_id']; ?>"><?php echo $res['product_title']; ?></a>
                                        </h3>
                                        <div class="price"><?php echo $cur_format; ?> <?php echo $res['product_price']; ?></div>
                                    </div>
                                </div>
                            </div>


                        <?php }
                        ?>
                    </div><?php
                        } else {
                            echo "<p>No products found.</p>";
                        }
                            ?>
                <div class="col-md-12">
                    <div class="pagination-outer">
                        <?php
                        $sql1 = "SELECT * FROM products WHERE product_status = 1 AND qty > 0";
                        $result1 = mysqli_query($conn, $sql1) or die("Query Failed.");

                        if (mysqli_num_rows($result1) > 0) {

                            $total_records = mysqli_num_rows($result1);

                            $total_page = ceil($total_records / $limit);

                            echo '<ul class="pagination admin-pagination">';
                            if ($page > 1) {
                                echo '<li><a href="all_products.php?page=' . ($page - 1) . '">Prev</a></li>';
                            }
                            for ($i = 1; $i <= $total_page; $i++) {
                                if ($i == $page) {
                                    $active = "active";
                                } else {
                                    $active = "";
                                }
                                echo '<li class="' . $active . '"><a href="all_products.php?page=' . $i . '">' . $i . '</a></li>';
                            }
                            if ($total_page > $page) {
                                echo '<li><a href="index.php?page=' . ($page + 1) . '">Next</a></li>';
                            }

                            echo '</ul>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'footer.php'; ?>