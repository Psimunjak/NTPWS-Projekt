		<?php
			$sql = "SELECT firstname, lastname, username, email, dob, country, city, street, valid, perm 
			FROM user";
		
			$result = mysqli_query($conn, $sql);
		?>
		
		<h2>Registered Users</h2>
		
		<table border="1" cellpadding="8" cellspacing="0">
			<thead>
				<tr>
					<th>First Name</th>
					<th>Last Name</th>
					<th>Username</th>
					<th>Email</th>
					<th>Date of Birth</th>
					<th>Country</th>
					<th>City</th>
					<th>Street</th>
					<th>Valid</th>
					<th>Perm</th>
				</tr>
			</thead>
			<tbody>
				
				<?php if ($result && mysqli_num_rows($result) > 0): ?>
					<?php while ($row = mysqli_fetch_assoc($result)): ?>
						<tr>
							<td><?= htmlspecialchars($row['firstname']) ?></td>
							<td><?= htmlspecialchars($row['lastname']) ?></td>
							<td><?= htmlspecialchars($row['username']) ?></td>
							<td><?= htmlspecialchars($row['email']) ?></td>
							<td><?= htmlspecialchars($row['dob']) ?></td>
							<td><?= htmlspecialchars($row['country']) ?></td>
							<td><?= htmlspecialchars($row['city']) ?></td>
							<td><?= htmlspecialchars($row['street']) ?></td>
							<td><?= $row['valid'] ? 'Yes' : 'No' ?></td>
							<td><?= htmlspecialchars($row['perm']) ?></td>
						</tr>
					<?php endwhile; ?>
				<?php else: ?>
					<tr>
						<td colspan="10">No users found.</td>
					</tr>
				<?php endif; ?>
				
			</tbody>
		</table>
		
		<hr>
		
		<form method="post" action="auth_admin.php">
			<label for="firstname">First Name</label><br>
			<input type="text" id="firstname" name="firstname"><br/>
			
			<label for="last-name">Last Name</label><br>
			<input type="text" id="lastname" name="lastname"><br/>
			
			<label for="username">Username</label><br>
			<input type="text" id="username" name="username"><br/>
			
			<label for="email">Email Address</label><br>
			<input type="email" id="email" name="email" required><br/>
			
			<label for="dob">Date of Birth</label><br>
			<input type="date" id="dob" name="dob"><br/>
			
			<label for="country">County</label><br>
			<input type="text" id="country" name="country"><br/>
			
			<label for="city">City</label><br>
			<input type="text" id="city" name="city"><br/>
			
			<label for="street">Street</label><br>
			<input type="text" id="street" name="street"><br/>
			
			<label for="password">Password</label><br>
			<input type="text" id="password" name="password"><br/>
			
			<label for="valid">Valid</label><br>
			<input type="number" id="valid" name="valid"><br/>
			
			<label for="perm">Perm</label><br>
			<input type="number" id="perm" name="perm"><br/>
			
			<button type="submit" name="action" value="update">Update</button>
			<button type="submit" name="action" value="delete">Delete</button>
		</form>