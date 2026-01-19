	<nav class="main-nav">
        <ul>
            <li><a href="index.php?menu=1">Home</a></li>
			<li><a href="index.php?menu=2">News</a></li>
            <li><a href="index.php?menu=3">Menu</a></li>
            <li><a href="index.php?menu=4">Order</a></li>
            <li><a href="index.php?menu=5">Gallery</a></li>
            <li><a href="index.php?menu=6">About</a></li>
        </ul>
    </nav>
	
	<br/>
	
<?php
include "database.php";

if (isset($_SESSION['username'])) {

	$username = $_SESSION['username'];

	$stmt = mysqli_prepare($conn, "SELECT perm FROM user WHERE username = ?");
	mysqli_stmt_bind_param($stmt, "s", $username);
	mysqli_stmt_execute($stmt);
	mysqli_stmt_bind_result($stmt, $perm);
	mysqli_stmt_fetch($stmt);

	$perm = (int) $perm;
	mysqli_stmt_close($stmt);

?>
	<nav>
		<ul>
			<?php if ($perm >= 2): ?>
				<li><a href="index.php?menu=9">Admin Page</a></li>
			<?php endif; ?>
			<li>
				<form method="post" action="logout.php" style="display:inline;">
					<button type="submit"><?php echo htmlspecialchars($username); ?> Logout</button>
				</form>
			</li>
		</ul>
	</nav>
	<?php

} else {
?>
	<nav>
		<ul>
			<li><a href="index.php?menu=7">Register</a></li>
			<li><a href="index.php?menu=8">Login</a></li>
		</ul>
	</nav>
	<?php
}
?>
