<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<?php
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Management System</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<form>
	<?php if (isset($_SESSION['message'])) { ?>
        <h1 class="message"> <?php echo $_SESSION['message']; ?></h1>
    <?php } unset($_SESSION['message']); ?>

    <?php if (isset($_SESSION['username'])) { ?>
		<h1></h1>
		<a href="core/handleForms.php?logoutAUser=1" class="btn logout">Logout</a>
        <h1>Welcome <?php echo $_SESSION['username']; ?>!</h1>
    <?php } else { echo "<h1>No user logged in</h1>"; } ?>

    <h3>Users List:</h3>
	<h1></h1>
    <ul>
        <?php $getAllUsers = getAllUsers($pdo); ?>
        <?php foreach ($getAllUsers as $row) { ?>
            <li>
                <a href="viewuser.php?user_id=<?php echo $row['user_id']; ?>"><?php echo $row['username'];?></a>
            </li>
        <?php } ?>
    </ul>
	</form>



<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<center><title>Badminton Store PH</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>BADMINTON STORE PH</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="product_category">Select a Product</label> 
			<select name="product_category" id="product_category" required onchange="toggleCustomInput()">
				<option value="">Select</option>
				<option value="Badminton Racket">Badminton Racket</option>
				<option value="Badminton Shoes">Badminton Shoes</option>
                <option value="Badminton Strings">Badminton Strings</option>
			</select>
			
			<input type="submit" name="insertOrderCategory" value="Submit">
		</p>
	</form>

	<script>
	function toggleCustomInput() {
		var productSelect = document.getElementById("product cateogry");
	}
	</script>


	
    <?php $getAllproduct_category =  getAllproduct_category($pdo)?>

	<?php foreach ($getAllproduct_category as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 120px; margin-top: 20px; padding-left: 10px;">
		<h3>Product ID: <?php echo $row['productcategory_id']; ?></h3>
		<h3>Product: <?php echo $row['product_category']; ?></h3>
		<a href="viewbusiness.php?productcategory_id=<?php echo $row['productcategory_id']; ?>">Show Product</a>
		<a href="editProduct.php?productcategory_id=<?php echo $row['productcategory_id']; ?>">Edit</a>
		<a href="deleteProduct.php?productcategory_id=<?php echo $row['productcategory_id']; ?>">Delete</a>


	</div> 
	<?php } ?>



</body>
</html>