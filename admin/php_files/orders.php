<?php 
include 'database.php';

if(isset($_POST['complete'])){

    $order_id = (int)($_POST['complete']);
    $result ="update order_products set delivery = 1 where order_id='{$order_id}' ";
	if($result[0] == '1'){
		echo 'true'; exit;
	}
}

 ?>
