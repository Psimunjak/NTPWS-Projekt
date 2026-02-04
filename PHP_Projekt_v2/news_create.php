<?php
include("database.php");
session_start();

$perm = 0;
if (isset($_SESSION['username'])) {
	$stmt = mysqli_prepare($conn, "SELECT perm FROM user WHERE username = ?");
	mysqli_stmt_bind_param($stmt, "s", $_SESSION['username']);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $perm);
	mysqli_stmt_fetch($stmt);
	mysqli_stmt_close($stmt);
}
$isAdmin = ($perm > 0);

if ($_POST['action'] === 'postnews') {

	$title    = $_POST['title'];
	$contents = $_POST['contents'] ?? '';
	$date     = date("Y-m-d");
	$valid    = $isAdmin ? 1 : 0;
	$archive  = 0;

	$mainImage = "uploads/" . uniqid() . "_" . basename($_FILES['image']['name']);
	move_uploaded_file($_FILES['image']['tmp_name'], $mainImage);

	$stmt = mysqli_prepare($conn, "
		INSERT INTO news (title, image, contents, date, archive, valid)
		VALUES (?, ?, ?, ?, ?, ?)
	");
	mysqli_stmt_bind_param($stmt, "ssssii",
		$title, $mainImage, $contents, $date, $archive, $valid
	);
	mysqli_stmt_execute($stmt);
	$newsId = mysqli_insert_id($conn);
	mysqli_stmt_close($stmt);

	if (!empty($_FILES['gallery']['name'][0])) {
		foreach ($_FILES['gallery']['tmp_name'] as $i => $tmp) {
			$path = "uploads/" . uniqid() . "_" . basename($_FILES['gallery']['name'][$i]);
			move_uploaded_file($tmp, $path);

			$stmt = mysqli_prepare($conn, "INSERT INTO images (news_id, image) VALUES (?, ?)");
			mysqli_stmt_bind_param($stmt, "is", $newsId, $path);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_close($stmt);
		}
	}

	header("Location: index.php");
	exit;
}

if ($_POST['action'] === 'adminnewsch' && $isAdmin) {
	$id      = (int)$_POST['id'];
	$valid   = (int)$_POST['valid'];
	$archive = (int)$_POST['archive'];

	$stmt = mysqli_prepare($conn, "
		UPDATE news SET valid = ?, archive = ? WHERE id = ?
	");
	mysqli_stmt_bind_param($stmt, "iii", $valid, $archive, $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_close($stmt);

	header("Location: index.php");
	exit;
}

if ($_POST['action'] === 'adminnewsdel' && $isAdmin) {
	$id = (int)$_POST['id'];

	$stmt = mysqli_prepare($conn, "SELECT image FROM images WHERE news_id = ?");
	mysqli_stmt_bind_param($stmt, "i", $id);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $img);

	while (mysqli_stmt_fetch($stmt)) {
		if (file_exists($img)) unlink($img);
	}
	mysqli_stmt_close($stmt);

	mysqli_query($conn, "DELETE FROM images WHERE news_id = $id");

	$res = mysqli_query($conn, "SELECT image FROM news WHERE id = $id");
	if ($row = mysqli_fetch_assoc($res)) {
		if (file_exists($row['image'])) unlink($row['image']);
	}

	mysqli_query($conn, "DELETE FROM news WHERE id = $id");

	header("Location: index.php");
	exit;
}
?>