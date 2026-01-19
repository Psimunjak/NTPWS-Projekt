		<form method="post" action="auth_register.php">
			<label for="first-name">First Name</label><br>
			<input type="text" id="first-name" name="first-name" required><br/>
			
			<label for="last-name">Last Name</label><br>
			<input type="text" id="last-name" name="last-name" required><br/>
			
			<label for="username">Username</label><br>
			<input type="text" id="username" name="username"><br/>
			
			<label for="email">Email Address</label><br>
			<input type="email" id="email" name="email" required><br/>
			
			<label for="dob">Date of Birth</label><br>
			<input type="date" id="dob" name="dob" required><br/>
			
			<label for="country">County</label><br>
			<input type="text" id="country" name="country" required><br/>
			
			<label for="city">City</label><br>
			<input type="text" id="city" name="city" required><br/>
			
			<label for="street">Street</label><br>
			<input type="text" id="street" name="street" required><br/>
			
			<label for="password">Password</label><br>
			<input type="password" id="password" name="password"><br/>
			
			<button type="submit" name="action" value="register">Register</button>
		</form>