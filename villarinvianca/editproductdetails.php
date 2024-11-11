<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	
	<a href="viewbusiness.php?productcategory_id=<?php echo $_GET['productcategory_id']; ?>">
	Back</a>
	<h1>Edit Product Details</h1>
	<?php $getOrderbyId = getOrderbyId($pdo, $_GET['customer_id']); ?>
	<form action="core/handleForms.php?productcategory_id=<?php echo $_GET['productcategory_id']; ?>
	&customer_id=<?php echo $_GET['customer_id']; ?>" method="POST">
		<p>
			<label for="Owner">Name</label> 
			<input type="text" name="customer_name" 
			value="<?php echo $getOrderbyId['customer_name']; ?>">
		</p>
		<p>
			<label for="Location">Location</label> 
			<input type="text" name="Location" 
			value="<?php echo $getOrderbyId['Location']; ?>">
			<input type="submit" name="editBusiness">
		</p>
	</form>
</body>
</html>