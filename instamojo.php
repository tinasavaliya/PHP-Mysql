<?php
// Include Database configuration  
// include 'config.php';
// session_start();
// $user = $_SESSION['username'];
//     // date_default_timezone_set("Asia/Kolkata");
//     $productId = $_POST['product_id'];
//     echo '<pre>';
//     print_r($productId);
//     echo '</pre>';
//     $product_id = (int) $_POST['product_id'];
//     $product_qty = $_POST['product_qty'];
//     $total_amount = $_POST['product_total'];
//     $orderId      = "WC" . rand(1111, 9999);
//     $order_date = date('Y-m-d');

//     $query ="SELECT * FROM products WHERE product_id = $product_id";
//     $row = mysqli_query($conn,$query);
//     $result = mysqli_fetch_all($row, MYSQLI_ASSOC);

//     if (count($result) > 0) {

//         $apiKey    = "test_57ecaeac4afa1b8ec3a663c264a"; // Your Private API Key
//         $authToken = "test_ae188282fc68981ca54f635684b";                     // Your Private Auth Token
//         $mojoURL   = "test.instamojo.com";   // Change development to production mode (https://www.instamojo.com)

//         //initialize session
//         $ch = curl_init();
//         //set the URL
//         curl_setopt($ch, CURLOPT_URL, "https://test.instamojo.com/api/1.1/payment-requests/");  // //https://api.instamojo.com/1.1/payment_requests/

//         //set options
//         curl_setopt($ch, CURLOPT_HEADER, false);
//         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//         curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
//         curl_setopt($ch, CURLOPT_HTTPHEADER, array("X-Api-Key:$apiKey", "X-Auth-Token:$authToken"));

//         $payload = array(
//             'purpose'      => 'Web Development',
//             'amount'       => $total_amount,
//             'buyer_name'   => $user,
//             'send_email'   => false,  // Pass true if you want to send email to customer email address
//             'send_sms'     => false,  // Pass true if you wany to send sms to customer mobile number
//             'redirect_url' => $hostname . '/success.php',
//             'webhook'      => '',
//             'allow_repeated_payments' => false
//         );

//         curl_setopt($ch, CURLOPT_POST, true);
//         curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));

//         //execution
//         $response = curl_exec($ch);
//         echo '<pre>';
//         print_r($response);
//         echo '</pre>';
//         //close
//         curl_close($ch);
   
//         //decode the json
//         $decode = json_decode($response);
    
//         if ($decode->success == true) {
//             $item_number = (int) $_POST['item_number'];
//             $txn_id = $decode->$payment_request_id->id;
//             $payment_gross = $_POST['payment_gross'];
//             $payment_status = 'credit';
        
//             $product_id = (int) $_POST['product_id'];
//             $product_qty = $_POST['product_qty'];
//             $total_amount = $_POST['product_total'];
//             $product_user = $_SESSION['user_id'];
//             $order_date = date('Y-m-d');
//             $pay_req_id = $decode->$payment_request_id->id;
//             $_SESSION['TID'] = $decode->$payment_request_id->id;
//             // $txnsId = $decode->payment_request->id;
//             // $paymentURL = $decode->payment_request->longurl;
//             // $txnsDate = $decode->payment_request->created_at;
//             // $status = $decode->payment_request->status;
//             // $_SESSION['TXNS_ID'] = $decode->payment_request->id;

//             // Insert Payment Transaction Details
//             $payments = "
//                 INSERT INTO payments (
//                     item_number, txn_id, payment_gross, payment_status) VALUES (
//                     '$item_number', '$txn_id', '$payment_gross', '$payment_status')";

//             $order_products = "
//                 INSERT INTO order_products (
//                     product_id, product_qty, product_total, user_id, order_date, pay_req_id) VALUES (
//                     '$product_id', '$product_qty', '$total_amount', '$product_user', '$order_date', '$pay_req_id')";

//             if (($con->query($payments)) && ($con->query($order_products))) {
//                 echo json_encode(['success' => 'Product Inserted successfully']);
//             } else {
//                 echo json_encode(['error' => 'Product Inserted failed: ' . mysqli_error($conn)]);
//             }

//             // if ($con->query($payments)) {
//             //     header("Location:$paymentURL");
//             //     exit();
//             // }
//         } else {
//             echo '<pre>';
//             print_r("response:". $response);
//             echo '</pre>';
//             echo "Contact the developer's email ID tv.agathiya@gmail.com with screenshot for technical support";
//         }
//     }

include 'config.php';
session_start();
$user = $_SESSION['username'];

$options = "SELECT site_name FROM options";
// $order_products = "SELECT product_total FROM order_products";
$row = mysqli_query($conn, $options);
$site_name = mysqli_fetch_assoc($row);

if (!$site_name) {
    die('Site name not found');
}

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'https://test.instamojo.com/api/1.1/payment-requests/');
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt(
    $ch,
    CURLOPT_HTTPHEADER,
    array(
        "X-Api-Key:test_57ecaeac4afa1b8ec3a663c264a",
        "X-Auth-Token:test_ae188282fc68981ca54f635684b",
        "Content-Type: application/json"
    )
);
// Path to the downloaded cacert.pem file
$certPath = 'D:\wamp\bin\php\cacert.pem';
curl_setopt($ch, CURLOPT_CAINFO, $certPath);

$payload = array(
    'purpose' => 'Payment to ' . $site_name['site_name'],
    'amount' => $_POST['product_total'],
    'redirect_url' => $hostname . '/success.php',
    'buyer_name' => $user,
    'allow_repeated_payments' => false
);

curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($payload));

$response = curl_exec($ch);
curl_close($ch);

//  decode the json
$decode = json_decode($response);
if ($decode->success == true) {
    $item_number = (int) $_POST['item_number'];
    $txn_id = $decode->$payment_request_id->id;
    $payment_gross = $_POST['payment_gross'];
    $payment_status = 'credit';

    $product_id = (int) $_POST['product_id'];
    $product_qty = $_POST['product_qty'];
    $total_amount = $_POST['product_total'];
    $product_user = $_SESSION['user_id'];
    $order_date = date('Y-m-d');
    $pay_req_id = $decode->$payment_request_id->id;
    $_SESSION['TID'] = $decode->$payment_request_id->id;

    $payments = "
INSERT INTO payments (
    item_number, txn_id, payment_gross, payment_status) VALUES (
    '$item_number', '$txn_id', '$payment_gross', '$payment_status')";

    $order_products = "
INSERT INTO order_products (
    product_id, product_qty, product_total, user_id, order_date, pay_req_id) VALUES (
    '$product_id', '$product_qty', '$total_amount', '$product_user', '$order_date', '$pay_req_id')";

    if (mysqli_query($conn, $payments) && mysqli_query($conn, $order_products)) {
        echo json_encode(['success' => 'Product Inserted successfully']);
    } else {
        echo json_encode(['error' => 'Product Inserted failed: ' . mysqli_error($conn)]);
    }

    header('Location: ' . $responseData['payment_request']['longurl']);
} else {
    echo '<pre>';
    print_r($response);
    echo '</pre>';
};
?>