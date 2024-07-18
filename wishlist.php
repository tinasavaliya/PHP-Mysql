<?php include 'config.php'; ?>
<?php include 'header.php'; ?>

<div class="product-wishlist-container section-padding bg-white">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="section-head">My Wishlist</h2>
                <?php
                if (isset($_COOKIE['user_wishlist']) && !empty($_COOKIE['user_wishlist'])) {
                    // $pid = array();
                    $pid = json_decode($_COOKIE['user_wishlist'], true);
                    if (is_array($pid) && !empty($pid)) {
                        $pids = implode(',', $pid);
                        $products = "SELECT * FROM products WHERE product_id IN ($pids)";
                        $row = mysqli_query($conn, $products) or die("Query failed: ");
                        $result = mysqli_fetch_all($row, MYSQLI_ASSOC);
                   
                  
                    if (count($result) > 0) { ?>
                        <table class="table table-bodered">1
                            <thead>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th>Product Price</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $row) { ?>
                                    <tr>
                                        <td><img src="product-images/<?php echo $row['featured_image']; ?>" alt="" width="100px" /></td>
                                        <td><?php echo $row['product_title']; ?></td>
                                        <td><?php echo $cur_format; ?> <?php echo $row['product_price']; ?></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary remove-wishlist-item" href="" data-id="<?php echo $row['product_id']; ?>"> <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="#fff" height="30px" width="30px">
                                <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                            </svg></a>
                                        </td>
                                    </tr>

                                <?php    } ?>
                            </tbody>
                        </table>
                        <a class="btn btn-sm btn-primary proceed-to-cart" href="javascript:void(0)">Proceed to Cart</a>
                    <?php   } }
                } else { ?>
                    <div class="empty-result">
                        No products were added to the wishlist.
                    </div>

                <?php } ?>


                <?php //} 
                ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>