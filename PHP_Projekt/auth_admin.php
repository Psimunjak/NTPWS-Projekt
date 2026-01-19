<?php
include("database.php");
session_start();

if (!isset($_POST['action'], $_POST['email'])) {
	header("Location: index.php");
	exit;
}

$action = $_POST['action'];
$email  = trim($_POST['email']);

if ($action === "delete") {
	$stmt = mysqli_prepare($conn, "DELETE FROM user WHERE email = ?");
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	header("Location: index.php");
	exit;
}

if ($action === "update") {
	$fields = [];
	$params = [];
	$types  = "";

	function addField(&$fields, &$params, &$types, $name, $value, $type = "s") {
		if ($value !== "") {
			$fields[] = "$name = ?";
			$params[] = $value;
			$types   .= $type;
		}
	}

	addField($fields, $params, $types, "firstname", trim($_POST['firstname'] ?? ""));
	addField($fields, $params, $types, "lastname", trim($_POST['lastname'] ?? ""));
	addField($fields, $params, $types, "username", trim($_POST['username'] ?? ""));
	addField($fields, $params, $types, "country", trim($_POST['country'] ?? ""));
	addField($fields, $params, $types, "city", trim($_POST['city'] ?? ""));
	addField($fields, $params, $types, "street", trim($_POST['street'] ?? ""));
	addField($fields, $params, $types, "dob", trim($_POST['dob'] ?? ""));
	addField($fields, $params, $types, "valid", $_POST['valid'] ?? "", "i");
	addField($fields, $params, $types, "perm", $_POST['perm'] ?? "", "i");

	if (!empty($_POST['password'])) {
		$fields[] = "password = ?";
		$params[] = password_hash($_POST['password'], PASSWORD_DEFAULT);
		$types   .= "s";
	}

	if (empty($fields)) {
		header("Location: index.php");
		exit;
	}

	$params[] = $email;
	$types   .= "s";

	$sql = "UPDATE user SET " . implode(", ", $fields) . " WHERE email = ?";
	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param($stmt, $types, ...$params);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	header("Location: index.php");
	exit;
}
