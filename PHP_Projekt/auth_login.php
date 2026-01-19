<?php
include "database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	exit("Invalid request");
}

$action = $_POST['action'] ?? '';

if ($action === "login") {
	
	$username = trim($_POST['username']);
	$password = trim($_POST['password']);

	if ($username === '' || $password === '') {
		$_SESSION['alert'] = "Username and password required";
		header("Location: index.php");
		exit;
	}

	$stmt = mysqli_prepare(
		$conn,
		"SELECT password FROM user WHERE username = ?"
	);

	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);

	mysqli_stmt_bind_result($stmt, $dbHashedPassword);
	
	if (!mysqli_stmt_fetch($stmt)) {
		$_SESSION['alert'] = "User not found";
		header("Location: index.php");
		exit;
	}

	if (!password_verify($password, $dbHashedPassword)) {
		$_SESSION['alert'] = "Invalid password";
		header("Location: index.php");
		exit;
	}

	$_SESSION['username'] = $username;
	$_SESSION['alert'] = "Logged in successfully";
	header("Location: index.php");
	exit;
}

?>