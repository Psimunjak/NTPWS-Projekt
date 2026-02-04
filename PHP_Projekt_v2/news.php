		<?php
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
		?>
		
		<?php if ($isAdmin): ?>

			<h2>All News (Admin Overview)</h2>

			<table border="1" cellpadding="6" cellspacing="0">
				<thead>
					<tr>
						<th>ID</th>
						<th>Title</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$result = mysqli_query(
						$conn,
						"SELECT id, title FROM news ORDER BY id DESC"
					);

					if ($result && mysqli_num_rows($result) > 0):
						while ($row = mysqli_fetch_assoc($result)):
					?>
						<tr>
							<td><?= (int)$row['id'] ?></td>
							<td><?= htmlspecialchars($row['title']) ?></td>
						</tr>
					<?php
						endwhile;
					else:
					?>
						<tr>
							<td colspan="2">No news entries found.</td>
						</tr>
					<?php endif; ?>
				</tbody>
			</table>

			<hr>

			<?php endif; ?>

		
		<?php if ($isAdmin): ?>
		<form method="post" action="news_create.php">
			<label for="id">Id</label><br>
			<input type="number" id="id" name="id" required><br/>
			
			<label for="valid">Valid</label><br>
			<input type="number" id="valid" name="valid"><br/>
			
			<label for="archive">Archive</label><br>
			<input type="number" id="archive" name="archive"><br/>
			
			<button type="submit" name="action" value="adminnewsch">Change</button>
			<button type="submit" name="action" value="adminnewsdel">Delete</button>
		</form>
		<hr>
		<?php endif; ?>
		
		
		<form method="post" action="news_create.php" enctype="multipart/form-data">
			<label for="title">Title</label><br>
			<input type="text" id="title" name="title" required><br/>
			
			<label for="image">Main Image</label><br>
			<input type="file"
				id="image"
				name="image"
				accept="image/*"
				required><br/>

			<label for="gallery">Gallery Images</label><br>
			<input type="file"
				id="gallery"
				name="gallery[]"
				accept="image/*"
				multiple><br/>

			<label for="contents">Contents</label><br>
			<textarea id="contents" name="contents" rows="4" cols="50"></textarea><br/>

			<button type="submit" name="action" value="postnews">Post</button>
		</form>
		<hr>
		
<?php
function displayNews($conn, $where, $title) {
	echo "<h2>$title</h2>";

	$sql = "
		SELECT * FROM news
		WHERE $where
		ORDER BY date DESC
	";
	$result = mysqli_query($conn, $sql);

	while ($news = mysqli_fetch_assoc($result)) {
		echo "<h3>" . htmlspecialchars($news['title']) . "</h3>";
		echo "<img src='" . htmlspecialchars($news['image']) . "' style='max-width:300px'><br>";
		echo "<p>" . nl2br(htmlspecialchars($news['contents'])) . "</p>";
		echo "<small>" . $news['date'] . "</small><br>";

		$stmt = mysqli_prepare($conn, "SELECT image FROM images WHERE news_id = ?");
		mysqli_stmt_bind_param($stmt, "i", $news['id']);
		mysqli_stmt_execute($stmt);
		mysqli_stmt_bind_result($stmt, $img);

		while (mysqli_stmt_fetch($stmt)) {
			echo "<img src='" . htmlspecialchars($img) . "' style='max-width:150px; margin:5px'>";
		}
		mysqli_stmt_close($stmt);

		echo "<hr>";
    }
}
?>

<?php
if ($isAdmin) {
	displayNews($conn, "valid = 0", "Pending");
}

displayNews($conn, "valid = 1 AND archive = 0", "News");

if ($isAdmin) {
	displayNews($conn, "valid = 1 AND archive = 1", "Archived");
}
?>
