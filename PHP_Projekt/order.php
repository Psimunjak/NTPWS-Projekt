        <h2>Order</h2>
        <section>
			<iframe
			src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2781.9301640214016!2d15.97798431556882!3d45.81501097910627!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4765d7bda1f1b3a5%3A0x400f7d1c6973f30!2sZagreb!5e0!3m2!1sen!2shr!4v0000000000"
			width="100%"
			height="300"
			style="border:0;">
			</iframe>
		</section>
		
		<form method="post" action="submit_order.php">
			<label for="first-name">First Name</label><br>
			<input type="text" id="first-name" name="first-name" required><br/>
			
			<label for="last-name">Last Name</label><br>
			<input type="text" id="last-name" name="last-name" required><br/>
			
			<label for="address">Address</label><br>
			<input type="text" id="address" name="address" required><br/>
			
			<label for="email">Email Address</label><br>
			<input type="email" id="email" name="email" required><br/>
			
			<label for="delivery_date">Delivery Date</label><br>
			<input type="date" id="delivery_date" name="delivery_date" required><br/>
			
			<label for="delivery_time">Delivery Time</label><br>
			<input type="time" id="delivery_time" name="delivery_time" required><br/>
			
			<label for="pizza">Pizza</label><br>
			<input type="text" id="pizza" name="pizza" required><br/>
			
			<label for="country">Country</label><br>
			<select id="country" name="country" required>
				<option value="hr">Croatia</option>
				<option value="si">Slovenia</option>
				<option value="rs">Serbia</option>
				<option value="ba">Bosnia and Herzegovina</option>
				<option value="al">Albania</option>
				<option value="other">Other</option>
			</select><br/>
			
			<button type="submit">Continue Order</button>
		</form>
