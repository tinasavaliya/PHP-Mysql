<?php
include 'config.php';
include 'header.php';
?>

<div class="product-cart-container section-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 clearfix">
                <h2 class="section-head">My Cart</h2>
                <?php
                if (isset($_COOKIE['user_cart'])) {
                    $pid = json_decode($_COOKIE['user_cart']);
                    if (is_object($pid)) {
                        $pid = get_object_vars($pid);
                    }
                    $pids = implode(',', $pid);
                    $products_query = "SELECT product_id, product_title, product_price, featured_image, qty FROM products WHERE product_id IN ($pids)";
                    $row = mysqli_query($conn, $products_query) or die("Query Failed");
                    $result = mysqli_fetch_all($row, MYSQLI_ASSOC);
                    if (count($result) > 0) { ?>
                        <table class="table table-bordered">
                            <thead>
                                <th>Product Image</th>
                                <th>Product Name</th>
                                <th width="120px">Product Price</th>
                                <th width="100px">Qty.</th>
                                <th width="100px">Sub Total</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php foreach ($result as $row) { ?>
                                    <tr class="item-row">
                                        <td><img src="product-images/<?php echo $row['featured_image']; ?>" alt="" width="70px" /></td>
                                        <td><?php echo $row['product_title']; ?></td>
                                        <td><?php echo $cur_format; ?> <span class="product-price"><?php echo $row['product_price']; ?></span></td>
                                        <td>
                                            <input class="form-control item-qty" type="number" value="1" />
                                            <input type="hidden" class="item-id" value="<?php echo $row['product_id']; ?>" />
                                            <input type="hidden" class="item-price" value="<?php echo $row['product_price']; ?>" />
                                        </td>
                                        <td><?php echo $cur_format; ?> <span class="sub-total"><?php echo $row['product_price']; ?></span></td>
                                        <td>
                                            <a class="btn btn-sm btn-primary remove-cart-item" href="" data-id="<?php echo $row['product_id']; ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512" fill="#fff" height="30px" width="30px">
                                                    <path d="M342.6 150.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0L192 210.7 86.6 105.4c-12.5-12.5-32.8-12.5-45.3 0s-12.5 32.8 0 45.3L146.7 256 41.4 361.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L192 301.3 297.4 406.6c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L237.3 256 342.6 150.6z" />
                                                </svg></a>
                                        </td>
                                    </tr>
                                <?php } ?>
                                <tr>
                                    <td colspan="5" align="right"><b>TOTAL AMOUNT (<?php echo $cur_format; ?>)</b></td>
                                    <td class="total-amount"></td>
                                </tr>
                            </tbody>
                        </table>
                        <a class="btn btn-sm btn-primary" href="<?php echo $hostname; ?>">Continue Shopping</a>
                        <?php if (isset($_SESSION['user_role'])) { ?>
                            <form action="instamojo.php" class="checkout-form pull-right" method="POST">
                                <?php
                                $product_id = '';
                                foreach ($result as $row) {
                                    $product_id .= $row['product_id'] . ',';
                                }
                                ?>
                                <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                <input type="hidden" name="product_total" class="total-price" value="">
                                <input type="hidden" name="product_qty" class="total-qty" value="1">
                                <input type="submit" class="btn btn-md btn-success float-end" value="Proceed to Checkout">
                            </form>
                        <?php } else { ?>
                            <a class="btn btn-sm btn-success pull-right float-end" href="#" data-toggle="modal" data-target="#userLogin_form">Proceed to Checkout</a>
                        <?php } ?>
                    <?php } else { ?>
                        <div class="empty-result">
                            Your cart is currently empty.
                        </div>
                    <?php }
                } else { ?>
                    <div class="empty-result">
                        Your cart is currently empty.
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>