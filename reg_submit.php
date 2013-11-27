<?php

	//connect database
	$dbHost = "localhost";
	$dbUser = "root";
	$dbPass = "";
	$dbname = "bookstore";
	$con=mysqli_connect($dbHost, $dbUser, $dbPass, $dbname);

	// Check connection
	if (mysqli_connect_errno($con)){
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}

	 $mid= $_POST['mid'];
	 $fname = $_POST['firstName'];
	 $lname = $_POST['lastName'];
	 $passwd = md5($_POST['password']);
	 $line1 = $_POST['line1'];
	 $line2 = $_POST['line2'];
	 $line3 = $_POST['line3'];
	 $city = $_POST['city'];
	 $state = $_POST['state'];
	 $zipcode = $_POST['zip'];
	 $email = $_POST['email'];
	 $dob = $_POST['dob'];
	 	 
	 
	  $query1 = "select * from members where m_id = '$mid' ";
	  $query2 = "insert into members(m_id, email, password, first_name, last_name, date_of_birth) VALUES ('$mid' ,'$email', 'passwd', '$fname','$lname','$dob')";
	  $query3 = "insert into addresses(m_id, line_1, city, state) VALUES ('$mid', '$line1', '$city', '$state')";
	  

	  echo 'query1'.$query1.'<br><br>';
	  
	 
	  $result1 = mysqli_query($con,$query1);

	  $row_cnt = mysqli_num_rows($result1);
	 if(mysqli_num_rows($result1)){
	 	echo "Member Id already exists. Please select a different one";
		mysqli_close($con);
	 }else{ 
	 	echo 'query2'.$query2.'<br><br>';
	    $result2 = mysqli_query($con,$query2);
		if($result2){
			echo 'query3'.$query3.'<br><br>';
	   		$result3 = mysqli_query($con,$query3);
			if($result3){
				mysqli_query('commit');
				session_start();
				$_SESSION['mid'] = $mid;
				$_SESSION['fname'] = $fname;
	   			header('Location: index.php'); 	
			}else{						 						  
		  		die('Could not insert into database');
		 		echo "Registration failed";
				mysqli_close($con);
			}
		}
		else{
			echo 'database insertion problem';
		}
	}
?>
