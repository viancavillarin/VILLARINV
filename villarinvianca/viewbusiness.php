<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Viewing</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<a href="index.php">Home</a>


	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="customer_name">Customer Name</label> 
			<input type="text" name="customer_name">
		</p>
		<p>
			<label for="date_ordered">Date Ordered</label> 
			<input type="date" name="date_ordered">
		</p>
		<p>
			<label for="shipping_location">Location</label> 
			<input type="text" name="shipping_location">
		</p>
		<p>

		<?php $getProductCategories = getProductCategories($pdo); ?>
		<div>
			<label for="OrderCategory">Product Type</label>
			<select name="product_category" id="OrderCategory" onchange="toggleOtherInput()">
				<?php foreach ($getProductCategories as $row): ?>
					<option value="<?php echo ($row['productcategory_id']); ?>">
						<?php echo ($row['product_category']); ?>
					</option>
				<?php endforeach; ?>
			</select>
		</div>
        </p>
		<p>
			<input type="submit" name="insertOrderDetails">
		</p>
	</form>


	<table style="center;">
	  <tr>
	    <th>Customer ID</th>
	    <th>Customer Name</th>
	    <th>Date Added</th>
	    <th>Location</th>
	    <th>Product</th>   
	    <th>Product ID</th>
		<th>Payment</th>
	  </tr>
	  <?php $getproduct_details = getproduct_details($pdo, $_GET['productcategory_id']); ?>
	  <?php foreach ($getproduct_details as $row) { ?>
	  <tr>
        <td><?php echo ($row['customer_id']); ?></td>
        <td><?php echo ($row['customer_name']); ?></td>
        <td><?php echo ($row['date_ordered']); ?></td>
        <td><?php echo ($row['Location']); ?></td>
        <td><?php echo ($row['product_category']); ?></td>
        <td><?php echo ($row['productcategory_id']); ?></td>
		<td>
	  		<a href="editproductdetails.php?customer_id=<?php echo $row['customer_id']; ?>&productcategory_id=<?php echo $_GET['productcategory_id']; ?>">Edit</a>
	  		<a href="deleteproductdetails.php?customer_id=<?php echo $row['customer_id']; ?>&productcategory_id=<?php echo $_GET['productcategory_id']; ?>">Delete</a>


	  	</td>	  


	  </tr>
	<?php } ?>
	</table>

	
</body>
</html>