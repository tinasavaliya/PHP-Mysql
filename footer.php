<div id="footer" class="float-start w-100 bg-black py-lg-3 py-2">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <?php
                $sql1 = "SELECT site_name, footer_text, site_desc, contact_phone, contact_email, contact_address FROM options";
                $row = mysqli_query($conn, $sql1) or die("Query Failed");
                $result = mysqli_fetch_assoc($row); ?>

                <h3><?php echo $result['site_name']; ?></h3>
                <p><?php echo $result['site_desc']; ?></p>
            </div>
            <div class="col-md-3">
                <h3 class="fs-20 fw-700">Categories</h3>
                <ul class="menu-list pb-lg-3 pb-2">
                    <?php
                    $sql2 = "select * from sub_categories where cat_products > 0 AND show_in_footer ='1'";
                    $result2 = mysqli_query($conn, $sql2) or die("Query Failed");


                    if (mysqli_num_rows($result2) > 0) {
                        while ($res = mysqli_fetch_assoc($result2)) { ?>
                            <li><a href="category.php?cat=<?php echo $res['sub_cat_id']; ?>"><?php echo $res['sub_cat_title']; ?></a></li>
                    <?php }
                    } ?>
                </ul>
            </div>
            <div class="col-md-3 col-12">
                <h3>Useful Links</h3>
                <ul class="menu-list pb-lg-3 pb-2">
                    <li><a href="<?php echo $hostname; ?>">Home</a></li>
                    <li><a href="all_products.php">All Products</a></li>
                    <li><a href="latest_products.php">Latest Products</a></li>
                    <li><a href="popular_products.php">Popular Products</a></li>
                </ul>
            </div>
            <div class="col-md-3 col-12">
                <h3>Contact Us</h3>
                <ul class="menu-list pb-lg-3 pb-2">
                    <?php if (!empty($result['contact_address'])) { ?>
                        <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" fill="#fff" height="15px" height="15px">
                                <path d="M575.8 255.5c0 18-15 32.1-32 32.1h-32l.7 160.2c0 2.7-.2 5.4-.5 8.1V472c0 22.1-17.9 40-40 40H456c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1H416 392c-22.1 0-40-17.9-40-40V448 384c0-17.7-14.3-32-32-32H256c-17.7 0-32 14.3-32 32v64 24c0 22.1-17.9 40-40 40H160 128.1c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2H104c-22.1 0-40-17.9-40-40V360c0-.9 0-1.9 .1-2.8V287.6H32c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z" />
                            </svg><span>: <?php echo $result['contact_address']; ?></span></li>
                    <?php } ?>
                    <?php if (!empty($result['contact_phone'])) { ?>
                        <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#fff" height="15px" height="15px">
                                <path d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64C0 311.4 200.6 512 448 512c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368C234.3 334.7 177.3 277.7 144 207.3L193.3 167c13.7-11.2 18.4-30 11.6-46.3l-40-96z" />
                            </svg></i><span>: <?php echo $result['contact_phone']; ?></span></li>
                    <?php } ?>
                    <?php if (!empty($result['contact_email'])) { ?>
                        <li><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="#fff" height="15px" height="15px">
                                <path d="M48 64C21.5 64 0 85.5 0 112c0 15.1 7.1 29.3 19.2 38.4L236.8 313.6c11.4 8.5 27 8.5 38.4 0L492.8 150.4c12.1-9.1 19.2-23.3 19.2-38.4c0-26.5-21.5-48-48-48H48zM0 176V384c0 35.3 28.7 64 64 64H448c35.3 0 64-28.7 64-64V176L294.4 339.2c-22.8 17.1-54 17.1-76.8 0L0 176z" />
                            </svg><span>: <?php echo $result['contact_email']; ?></span></li>
                    <?php } ?>
                </ul>
            </div>
            <div class="col-md-12">
                <span class="text-white text-center d-flex align-items-center justify-content-center pb-2"><?php echo $result['footer_text'] ?> | Created by <a href="https://www.yahoobaba.net" target="_blank" class="text-white ms-2"> Tina Savaliya</a></span>
            </div>
        </div>


    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
<script src="./js/popper.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.min.js" integrity="sha512-HGOnQO9+SP1V92SrtZfjqxxtLmVzqZpjFFekvzZVWoiASSQgSr4cw9Kqd2+l8Llp4Gm0G8GIFJ4ddwZilcdb8A==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js" integrity="sha512-ykZ1QQr0Jy/4ZkvKuqWn4iF3lqPZyij9iRv6sGqLRdTPkY69YX6+7wvVGmsdBbiIfN/8OdsI7HABjvEok6ZopQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<script src="./js/slick_slider.js"></script>
<script src="./js/searchbar.js"></script>
<script src="./js/action.js"></script>
<script src="./js/okzoom.min.js"></script>
<script src="https://js.stripe.com/v2/"></script>
<script type="text/javascript">
    $(document).ready(function() {

        $('#product-img').okzoom({
            width: 200,
            height: 200,
            scaleWidth: 800
        });
    });
    // Set your publishable key
    Stripe.setPublishableKey('pk_test_18lgnnPV3SZZn36tyAFO131T00P2pCl90m');

    // Callback to handle the response from stripe
    function stripeResponseHandler(status, response) {
        if (response.error) {
            // Enable the submit button
            $('#payBtn').removeAttr("disabled");
            // Display the errors on the form
            $(".payment-status").html('<p>' + response.error.message + '</p>');
        } else {
            var form$ = $("#payment-form");
            // Get token id
            var token = response.id;
            // Insert the token into the form
            form$.append("<input type='hidden' name='stripeToken' value='" + token + "' />");
            // Submit form to the server
            form$.get(0).submit();
        }
    }

    $(document).ready(function() {
        // On form submit
        $("#payment-form").submit(function() {
            // Disable the submit button to prevent repeated clicks
            $('#payBtn').attr("disabled", "disabled");

            // Create single-use token to charge the user
            Stripe.createToken({
                number: $('#card_number').val(),
                exp_month: $('#card_exp_month').val(),
                exp_year: $('#card_exp_year').val(),
                cvc: $('#card_cvc').val()
            }, stripeResponseHandler);

            // Submit from callback
            return false;
        });
    });
</script>
</body>

</html>