<?php include 'config.php'; ?>
<?php include 'header.php';
?>

<div class="product-section content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-head">Popular Products</h2>
                <?php
                // calculate page
                $limit = 8;
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 2;
                }
                $offset = ($page - 1) * $limit;
                $products = "select * from products order by product_id DESC, product_status = 1 AND qty > 0";
                $result = mysqli_query($conn, $products) or die("Query Failed"); ?>
                <div class="row">
                    <?php if (mysqli_num_rows($result) > 0) { ?>
                        <?php
                        while ($res = mysqli_fetch_assoc($result)) { ?>
                            <div class="col-md-3 col-sm-6">
                                <div class="product-grid">
                                    <div class="product-image latest">
                                        <a class="image" href="single_product.php?pid=<?php echo $res['product_id']; ?>">
                                            <img class="pic-1" src="product-images/<?php echo $res['featured_image']; ?>">
                                        </a>
                                        <div class="product-button-group">
                                            <a href="single_product.php?pid=<?php echo $res['product_id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" height="15px" width="15px">
                                                    <path d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z" />
                                                </svg></a>
                                            <a href="" class="add-to-cart" data-id="<?php echo $res['product_id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" height="15px" width="15px">
                                                    <path d="M0 24C0 10.7 10.7 0 24 0H69.5c22 0 41.5 12.8 50.6 32h411c26.3 0 45.5 25 38.6 50.4l-41 152.3c-8.5 31.4-37 53.3-69.5 53.3H170.7l5.4 28.5c2.2 11.3 12.1 19.5 23.6 19.5H488c13.3 0 24 10.7 24 24s-10.7 24-24 24H199.7c-34.6 0-64.3-24.6-70.7-58.5L77.4 54.5c-.7-3.8-4-6.5-7.9-6.5H24C10.7 48 0 37.3 0 24zM128 464a48 48 0 1 1 96 0 48 48 0 1 1 -96 0zm336-48a48 48 0 1 1 0 96 48 48 0 1 1 0-96z"></path>
                                                </svg></a>
                                            <a href="" class="add-to-wishlist" data-id="<?php echo $res['product_id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="15px" width="15px">
                                                    <path d="M47.6 300.4L228.3 469.1c7.5 7 17.4 10.9 27.7 10.9s20.2-3.9 27.7-10.9L464.4 300.4c30.4-28.3 47.6-68 47.6-109.5v-5.8c0-69.9-50.5-129.5-119.4-141C347 36.5 300.6 51.4 268 84L256 96 244 84c-32.6-32.6-79-47.5-124.6-39.9C50.5 55.6 0 115.2 0 185.1v5.8c0 41.5 17.2 81.2 47.6 109.5z"></path>
                                                </svg></a>
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
                    } ?>


                </div>
            </div>

            <div class="col-md-12 pagination-outer">
                <?php
                $total_pages_sql = "SELECT COUNT(*) FROM products WHERE product_status = 1 AND qty > 0";
                $result5 = mysqli_query($conn, $total_pages_sql);
                $total_rows = mysqli_fetch_array($result5)[0];
                $total_pages = ceil($total_rows / $limit);

                echo '<ul class="pagination">';
                for ($i = 1; $i <= $total_pages; $i++) {
                    if ($total_rows == $limit) {
                        echo '';
                    } else {
                        echo '<li><a href="?cats =' . $total_rows . '&page=' . $i . '">' . $i . '</a></li>';
                    }
                }
                echo '</ul>';
                ?>
            </div>
        </div>
    </div>
</div>
</div>
<?php include 'footer.php'; ?>