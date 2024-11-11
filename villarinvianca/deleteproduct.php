<?php require_once 'core/models.php'; ?>
<?php require_once 'core/dbConfig.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Deletion</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php">Home</a>
	<h1>Are you sure you want to delete this?</h1>
	<?php $getOrderCategory = getOrderCategory($pdo, $_GET['productcategory_id']); ?>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>ID: <?php echo $getOrderCategory['productcategory_id']; ?></h2>
		<h2>Username: <?php echo $getOrderCategory['product_category']; ?></h2>
		<div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core/handleForms.php?productcategory_id=<?php echo $_GET['productcategory_id']; ?>" method="POST">
				<input type="submit" name="deleteCategory" value="Delete">
			</form>			
		</div>	

	</div>
</body>
</html>