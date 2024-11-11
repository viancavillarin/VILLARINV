<?php



function insertIntoUsersRecords($pdo, $customer, $date, $location, $productID){
    $sql = "INSERT INTO product_details (customer_name, date, Location, 
		product_category_id) VALUES(?,?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer, $date, $location, 
		$productID]);

	if ($executeQuery) {
		return true;
	}

} 


function insertNewCategory($pdo, $product_category){
    $sql = "INSERT INTO product (product_category) VALUES(?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$product_category]);

	if ($executeQuery) {
		return true;
	}

}


function getBusinessCategories($pdo) {
    $sql = "SELECT * FROM product";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll();
}


function getAllproduct_category($pdo) {
	$sql = "SELECT * FROM product";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}
function getproduct_details($pdo, $productcategory_id) {
    $sql = "SELECT 
                product_details.customer_id AS `customer_id`,
                product_details.customer_name AS `customer_name`,
                product_details.date_ordered AS `date_ordered`,
               product_details.Location AS `Location`,
                product_details.productcategory_id AS `productcategory_id`,
                product_details category AS `product_category`
            FROM product_details
            JOIN product ON product_details.productcategory_id = product.productcategory_id
            WHERE product_details.productcategory_id = ? 
            ";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$productcategory_id]);

    if ($executeQuery) {
        return $stmt->fetchAll(); 
    }
    return []; 
}
function getOrderbyId($pdo, $customer_id) {
    $sql = "SELECT 
                product_details.customer_id AS customer_id,
                product_details.customer_name AS customer_name,
                product_details.date_ordered AS date_ordered,
                product_details.Location AS Location,
                product.product_category AS Business_Category
            FROM product_details
            JOIN product ON product.productcategory_id = product_details.productcategory_id
            WHERE product_details.customer_id = ? 
            GROUP BY product_details.date_ordered";

    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_id]);
    if ($executeQuery) {
        return $stmt->fetch();
    }
    return null; 
}


function updateProject($pdo, $customer_name,$Location, $customer_id){
        $sql = "UPDATE product_details
        SET customer_name = ?,
        Location =?
        WHERE customer_id = ?
        ";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$customer_name,$Location, $customer_id]);

    if ($executeQuery) {
    return true;
    }
}


function deletebusiness($pdo, $customer_id){
    $sql = "DELETE FROM product_details WHERE customer_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$customer_id]);
	if ($executeQuery) {
		return true;
	}
}

function getOrderCategory($pdo,$productcategory_id){
    $sql = "SELECT * FROM product WHERE productcategory_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$productcategory_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateCategory($pdo, $product_category, $productcategory_id){
    $sql = "UPDATE product
				SET product_category = ?
				WHERE productcategory_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$product_category, $productcategory_id ]);
	
	if ($executeQuery) {
		return true;
	}
    
    
}
function deleteCategory($pdo,$productcategory_id){
    $sql = "DELETE FROM product WHERE productcategory_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$productcategory_id]);
	if ($executeQuery) {
		return true;
	}
}

function logAction($pdo, $action_type, $affected_id, $affected_type, $user) {
    $sql = "INSERT INTO action_logs (action_type, affected_id, affected_type, user) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$action_type, $affected_id, $affected_type, $user]);
}

function getAllActionLogs($pdo) {
    $sql = "SELECT * FROM action_logs ORDER BY timestamp DESC";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    
    return $stmt->fetchAll();
}


function insertNewUser($pdo, $username, $password) {

	$checkUserSql = "SELECT * FROM user_passwords WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {

		$sql = "INSERT INTO user_passwords (username,password) VALUES(?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $password]);

		if ($executeQuery) {
			$_SESSION['message'] = "User successfully inserted";
			return true;
		}

		else {
			$_SESSION['message'] = "An error occured from the query";
		}

	}
	else {
		$_SESSION['message'] = "User already exists";
	}

	
}



function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM user_passwords WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]); 

	if ($stmt->rowCount() == 1) {
		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username']; 
		$passwordFromDB = $userInfoRow['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	}

	
	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database. Please register first";
	}

}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_passwords";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM user_passwords WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

?>