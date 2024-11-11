
<?php require_once 'core/handleForms.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
    <a href="index.php">Home</a>
	<?php $getOrderCategory = getOrderCategory($pdo, $_GET['productcategory_id']); ?>
	<h1>EditProduct</h1>
	<form action="core/handleForms.php?productcategory_id=<?php echo $_GET['productcategory_id']; ?>" method="POST">
		<p>
			<label for="Category">Category</label> 
			<select name="product_category" value="<?php echo $getOrderCategory['product_category']; ?>">
			<option value="Badminton Racket">Badminton Racket</option>
			<option value="Badminton Shoes">Badminton Shoes</option>
			<option value="Badminton Strings">Badminton Strings</option>
		</p>
		<p>
			<input type="submit" name="editCategory">
		</p>
	</form>
</body>
</html>