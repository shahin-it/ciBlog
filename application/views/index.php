<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<h3>Address Book</h3>
<form class="was-validate" action="#">
	<div class="form-group">
		<label>Name</label>
		<input class="form-control" placeholder="Type name" required="" type="text">
		<div class="invalid-feedback">That field is required</div>
	</div>
	<div class="form-group">
		<label>Phone Number</label>
		<input class="form-control" placeholder="Type phone number" type="text">
	</div>
	<div class="form-group">
		<label>Address</label>
		<input class="form-control" placeholder="Type address" type="text">
	</div>
	<div class="form-group">
		<label></label>
		<button class="submit-button btn btn-primary" type="button">Submit</button>
	</div>
</form>
<div class="data-table">
	<table class="table">
		<thead>
			<tr>
				<th scope="col">#</th>
				<th scope="col">Name</th>
				<th scope="col">Phone Number</th>
				<th scope="col">Address</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<th scope="row">1</th>
				<td>Mark</td>
				<td>Otto</td>
				<td>@mdo</td>
			</tr>
		</tbody>
	</table>
</div>