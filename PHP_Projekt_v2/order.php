        <script
			src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDwYs4fxj9gC7JKU6dkdRXXbeaHwlqaHI&libraries=places&callback=initAutocomplete"
			async
			defer
		></script>

		
		<h2>Order</h2>
		
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
			<select id="pizza" name="pizza" required>
				<option value="margherita">Margherita</option>
				<option value="pepperoni">Pepperoni</option>
				<option value="hawaiian">Hawaiian</option>
				<option value="vegetarian">Vegetarian</option>
				<option value="seafood">Seafood</option>
			</select><br/>
			
			<label for="country">Country</label><br>
			<input type="text" id="country" name="country" required><br/>
			
			<button type="submit">Continue Order</button>
		</form>
		
		<script>
			function initAutocomplete() {
				const addressInput = document.getElementById("address");
				const countryInput = document.getElementById("country");

				const autocomplete = new google.maps.places.Autocomplete(addressInput, {
					types: ["geocode"]
				});

				autocomplete.addListener("place_changed", function () {
					const place = autocomplete.getPlace();

					countryInput.value = "";

					if (!place.address_components) {
						return;
					}

					place.address_components.forEach(component => {
						const types = component.types;

						if (types.includes("country")) {
							countryInput.value = component.long_name;
						}
					});
				});
			}
		</script>