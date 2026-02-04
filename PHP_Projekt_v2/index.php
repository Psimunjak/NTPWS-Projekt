<?php
$menu = isset($_GET['menu']) ? $_GET['menu'] : 1;

?>

<?php 
	include("database.php");

	session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Pizzeria</title>
    <link rel="stylesheet" href="style.css">
	
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Great+Vibes&display=swap" rel="stylesheet">

</head>
<body>
	<?php
		if (isset($_SESSION['alert'])) {
			echo "<script>alert('" . addslashes($_SESSION['alert']) . "');</script>";
			unset($_SESSION['alert']);
		}
	?>
	
	<?php include 'header.php'; ?>
	<?php include 'nav.php'; ?>

    <main class="article">
        <?php
			switch ($menu) {
				case 1:
					include 'home.php';
					break;
				case 2:
					include 'news.php';
					break;
				case 3:
					include 'menu.php';
					break;
				case 4:
					include 'order.php';
					break;
				case 5:
					include 'gallery.php';
					break;
				case 6:
					include 'about.php';
					break;
				case 7:
					include 'register.php';
					break;
				case 8:
					include 'login.php';
					break;
				case 9:
					include 'admin.php';
					break;
				case 31:
					include 'mar.php';
					break;
				case 32:
					include 'pep.php';
					break;
				case 33:
					include 'ha.php';
					break;
				case 34:
					include 'veg.php';
					break;
				case 35:
					include 'sea.php';
					break;
				default:
					include 'home.php';
    }
?>
    </main>

	<?php include 'footer.php'; ?>

</body>
</html>
