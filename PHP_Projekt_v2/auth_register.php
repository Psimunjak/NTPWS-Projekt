<?php
include "database.php";
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	exit("Invalid request");
}

$action = $_POST['action'] ?? '';

function generateUsername($conn, $firstname, $lastname) {
	$base = strtolower(substr($firstname, 0, 1) . substr($lastname, 0, 1));
	$username = $base;
	$i = 1;

	while (true) {
		$stmt = mysqli_prepare($conn, "SELECT 1 FROM user WHERE username = ?");
		mysqli_stmt_bind_param($stmt, "s", $username);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_store_result($stmt);

		if (mysqli_stmt_num_rows($stmt) === 0) {
			return $username;
		}

		$username = $base . $i++;
	}
}

function generatePassword($length = 10) {
	return substr(bin2hex(random_bytes(8)), 0, $length);
}


if ($action === "register") {

	$firstname = trim($_POST['first-name']);
	$lastname = trim($_POST['last-name']);
	$email = trim($_POST['email']);
	$country = trim($_POST['country']);
	$city = trim($_POST['city']);
	$street = trim($_POST['street']);
	$dob = $_POST['dob'];

	$stmt = mysqli_prepare($conn, "SELECT 1 FROM user WHERE email = ?");
	mysqli_stmt_bind_param($stmt, "s", $email);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_store_result($stmt);

	if (mysqli_stmt_num_rows($stmt) > 0) {
		$_SESSION['alert'] = "An account with this email already exists";
		header("Location: index.php");
		exit;
	}

	$username = trim($_POST['username']);
	if ($username === '') {
		$username = generateUsername($conn, $firstname, $lastname);
	}

	$plainPassword = trim($_POST['password']);
	if ($plainPassword === '') {
		$plainPassword = generatePassword();
		$generatedPassword = true;
	} else {
		$generatedPassword = false;
	}

	$hashedPassword = password_hash($plainPassword, PASSWORD_DEFAULT);

	$sql = "INSERT INTO user
		(firstname, lastname, email, country, city, street, dob, password, username, valid, perm)
		VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0, 0)";

	$stmt = mysqli_prepare($conn, $sql);
	mysqli_stmt_bind_param(
		$stmt,
		"sssssssss",
		$firstname,
		$lastname,
		$email,
		$country,
		$city,
		$street,
		$dob,
		$hashedPassword,
		$username
	);

	mysqli_stmt_execute($stmt);

	$_SESSION['username'] = $username;

	if ($generatedPassword) {
		$_SESSION['alert'] = "Registered successfully. Your username is: $username Your generated password is: $plainPassword";
	} else {
		$_SESSION['alert'] = "Registered and logged in successfully";
	}

	header("Location: index.php");
	exit;
}
?>