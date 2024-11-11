

<?php 
require_once 'dbConfig.php'; 
require_once 'models.php';



if (isset($_POST['insertOrderCategory'])) {
	$product_name = $_POST['product_category'];
    $product_category = trim($_POST['product_category']);
    if (!empty($product_category)) {
        $query = insertNewCategory($pdo, $product_category);

        if ($query) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Insert failed. Please try again.";
        }
    } else {
        echo "Make sure that all fields are filled.";
    }
};



if (isset($_POST['insertOrderDetails'])) {
    $customer = trim($_POST['customer_name']);
    $date = trim($_POST['date_ordered']);
    $location = trim($_POST['shipping_location']);
    $productID = trim($_POST['product_category']); 

    if (!empty($customer) && !empty($date) && !empty($location) && !empty($productID)) {
      
        $query = insertIntoUsersRecords($pdo, $customer, $date, $location, $productID);

        if ($query) {
            header("Location: ../index.php");
            exit();
        } else {
            echo "Insert failed. Please try again.";
        }
    } else {
        echo "Make sure that all fields are filled.";
    }
};

if (isset($_POST['editDetails'])) {
	$query = updateProjects($pdo, $_POST['customer_name'], $_POST['Location'], $_GET['customer_id']);

	if ($query) {
		header("Location: ../viewbusiness.php?productcategory_id=".$_GET['productcategory_id']);
	}
	else {
		echo "Update failed";
	}

}


if (isset($_POST['deletebusiness'])) {
	$query = deletebusiness($pdo, $_GET['customer_id']);

	if ($query) {
		header("Location: ../viewbusiness.php?productcategory_id=".$_GET['productcategory_id']);
	}
	else {
		echo "Deletion failed";
	}
}



if (isset($_POST['editCategory'])) {
	$query = updateCategory($pdo, $_POST['product_category'], $_GET['productcategory_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Update failed";;
	}

}


if (isset($_POST['deleteCategory'])) {
	$query = deleteCategory($pdo, $_GET['productcategory_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Delete failed";;
	}

}

if (isset($_POST['registerUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$insertQuery = insertNewUser($pdo, $username, $password);

		if ($insertQuery) {
			header("Location: ../login.php");
		}
		else {
			header("Location: ../register.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for registration!";

		header("Location: ../login.php");
	}

}




if (isset($_POST['loginUserBtn'])) {

	$username = $_POST['usernames'];
	$password = sha1($_POST['passwords']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);
	
		if ($loginQuery) {
			header("Location: ../index.php");
			$_SESSION['user'] = $username;
		}
		else {
			header("Location: ../login.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		header("Location: ../login.php");
	}
 
}



if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}

?>