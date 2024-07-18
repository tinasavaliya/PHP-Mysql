<?php

include 'config.php';

if (isset($_POST['user_view'])) {
	$user_id = (int) $_POST['user_view'];
	$query = "SELECT * FROM users WHERE id = $user_id";
	$result = mysqli_query($conn, $query);

	if ($result) {
		$user_details = mysqli_fetch_all($result, MYSQLI_ASSOC);
		echo json_encode($user_details);
	} else {
		echo json_encode([]);
	}
}

if (isset($_POST['status_id']) && isset($_POST['user_id'])) {
	$id = $_POST['user_id'];
	$status_id = $_POST['status_id'];

	// Fix the SQL update statement to correct the typo
	if ($status_id == '1') {
		$update = "UPDATE users SET user_role = '0' WHERE user_id = '{$id}'";

	} else {
		$update = "UPDATE users SET user_role = '1' WHERE user_id = '{$id}'";
	}
	$response = mysqli_query($conn, $update);
	if ($response) {
		echo json_encode(array('success' => 'success'));
	} else {
		echo json_encode(array('error' => 'Failed to update user role'));
	}
}


if (isset($_POST['delete_id'])) {
	$id = isset($_POST['delete_id']) ? mysqli_real_escape_string($conn, $_POST['delete_id']) : null;
	$delete = "DELETE FROM user where user_id = '{$id}'";
	$response = mysqli_query($conn, $delete) or die("Query Failed");
	if (!empty($response)) {
		echo json_encode(array('success' => $response));
		exit;
	}
}
