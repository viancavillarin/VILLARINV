<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Deletion</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	
	<?php $getOrderbyId = getOrderbyId($pdo, $_GET['customer_id']); ?>
	<h1>Are you sure you want to delete this customer?</h1>
	<div class="container" style="border-style: solid; height: 400px;">

		<h2>Customer Name<?php echo $getOrderbyId['customer_name'] ?></h2>
		<h2>Date Ordered <?php echo $getOrderbyId['date_ordered'] ?></h2>
		<h2>Location: <?php echo $getOrderbyId['Location'] ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">

			<form action="core/handleForms.php?customer_id=<?php echo $_GET['customer_id']; ?>&productcategory_id=<?php echo $_GET['productcategory_id']; ?>" method="POST">
				<input type="submit" name="deleteBusiness" value="Delete">
			</form>			
			
		</div>	

	</div>
</body>
</html>