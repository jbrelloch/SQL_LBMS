<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">

<head>
	<title>BookStore</title>
	<link rel="stylesheet" href="http://bootswatch.com/slate/bootstrap.css" media="screen">
    <link rel="stylesheet" href="./datepicket/css/datepicker.css">
	<link rel="stylesheet" href="http://bootswatch.com/assets/css/bootswatch.min.css">
	<link rel="shortcut icon" href="./Bootswatch_Slate_files/favicon.png">
	<script type="text/javascript" src="./Bootswatch_Slate_files/registrationFormValidation.js"></script>
	<script type="text/javascript" src="./Bootswatch_Slate_files/registrationFormValidation.js"></script>
	<script type="text/javascript" src="./datepicker/js/bootstrap-datepicker.js"></script>
</head>

<body onLoad="document.registration.userid.focus();">
	<h1>Registration Form</h1>
	<p>Use tab keys to move from one input field to the next.</p>
	<form name='registration' onSubmit="return formValidation();" class="form-horizontal" style="width:50%;margin-left:50px;" action="reg_submit.php" method="post">
		<legend>Personal Information</legend>
		<div class="form-group">
			<label for="firstName">First name</label>
			<input type="text" class="form-control" id="firstName" name="firstName" placeholder="Enter First name" size="20">
		</div>
		<div class="form-group">
			<label for="lastName">Last name</label>
			<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Enter Last name">
		</div>
		<div class="form-group">
			<label for="userId">User ID</label>
			<input type="text" class="form-control" id="userId" name="mid" placeholder="Enter userId">
		</div>
		<div class="form-group">
			<label for="password">Password</label>
			<input type="password" class="form-control" id="password" name="password" placeholder="Enter password">
		</div>
		<div class="form-group">
			<label for="dob">Date of Birth</label>
			<input type="text" class="form-control" id="dob" name="dob" placeholder="Enter date of birth mm/dd/yyyy">
		</div>
		<div class="form-group">
			<label for="email">Email</label>
			<input type="email" class="form-control" id="email" name="email" placeholder="Enter email">
		</div>
		<div class="form-group">
			<legend>Address</legend>
			<label for="line1">Line 1</label>
			<input type="text" class="form-control" id="line1" name="line1" placeholder="Enter line 1">
			<label for="line2">Line 2</label>
			<input type="text" class="form-control" id="line2" name="line2" placeholder="Enter line 2">
			<label for="line3">Line 3</label>
			<input type="text" class="form-control" id="line3" name="line3" placeholder="Enter line 3">
		</div>
		<div class="form-group">
			<label for="city">City</label>
			<input type="text" class="form-control" id="city" name="city" placeholder="Enter city">
		</div>
		<div class="form-group">
			<label for="state">State</label>
			<input type="text" class="form-control" id="state" name="state" placeholder="Enter state">
		</div>
		<div class="form-group">
			<label for="zip">ZIP</label>
			<input type="text" class="form-control" id="zip" name="zip" placeholder="Enter ZIP">
		</div>

		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
		<button type="submit" class="btn btn-primary">Reset</button>
		
	</form>
</body>
</html>