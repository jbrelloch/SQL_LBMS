<?php
	session_start();
	//connect database
	$dbHost = "localhost";
	$dbUser = "root";
	$dbPass = "";
	$dbname = "bookstore";
	$dbconnect = mysql_connect($dbHost,$dbUser,$dbPass)	or die("Unable to connect to MySQL");
	mysql_select_db($dbname,$dbconnect);

	// Check connection
	if (mysqli_connect_errno($con)){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
		header('Location: index.php');
	}

	foreach ($_SESSION['cart'] as $key => $value) {
		$result = mysql_query("SELECT * FROM books WHERE `b_id` = '".$key."'") or die("Unable to connect to query");
		$result_count = mysql_num_rows($result);

		$currentQuantity = 0;

		if($result_count == 1)
		{
			while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
				$currentQuantity = $row['quantity'];
			}
		}
		else
		{
			echo "Book retrieval error!";
			header('Location: cart.php?error=book');
		}

		if($currentQuantity >= $value)
		{
			$update = mysql_query("UPDATE books SET `quantity`=".($currentQuantity-$value)." WHERE `b_id` = '".$key."'");
		}
		else
		{
			echo "ERROR: Not enough books!";
			header('Location: cart.php?error=quantity');
		}
	}
	unset($_SESSION['cart']);
	header('Location: index.php');
?>