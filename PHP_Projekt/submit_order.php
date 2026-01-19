<?php 
	include("database.php");

	session_start();
?>

<?php
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
	exit("Invalid request");
}

$firstname = trim($_POST['first-name'] ?? '');
$lastname = trim($_POST['last-name'] ?? '');
$address = trim($_POST['address'] ?? '');
$email = trim($_POST['email'] ?? '');
$date = $_POST['delivery_date'] ?? '';
$time = $_POST['delivery_time'] ?? '';
$country = trim($_POST['country'] ?? '');
$pizza = trim($_POST['pizza'] ?? '');

$errors = [];

if ($firstname === '' || $lastname === '') {
	$errors[] = "First and last name are required.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
	$errors[] = "Invalid email address.";
}

if ($date === '' || $time === '') {
	$errors[] = "Delivery date and time are required.";
}

if ($country === '') {
	$errors[] = "Country is required.";
}

if ($pizza === '') {
	$errors[] = "Pizza is required.";
}

if ($errors) {
	echo implode("<br>", $errors);
	exit;
}

$sql = "INSERT INTO delivery
		(firstname, lastname, address, email, date, time, country, pizza)
		VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
			
$stmt = mysqli_prepare($conn, $sql);

	mysqli_stmt_bind_param(
		$stmt,
		"ssssssss",
		$firstname,
		$lastname,
		$address,
		$email,
		$date,
		$time,
		$country,
		$pizza
    );

    mysqli_stmt_execute($stmt);

echo "Pizza order saved successfully";

