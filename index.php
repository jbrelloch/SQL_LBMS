<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php
	session_start();
	$userSet = false;	
	
	if (isset($_SESSION['mid'])){
		$userSet = true; // user exists in session !!
		$mid = $_SESSION['mid'];
		$fname = $_SESSION['fname'];
	}
	echo $userSet;
?>

<html>
<head>

	<title>Jason Brelloch CSC 8711</title>
	<link rel="stylesheet" href="http://bootswatch.com/slate/bootstrap.css" media="screen">
    <link rel="stylesheet" href="http://bootswatch.com/assets/css/bootswatch.min.css">

    <script type="text/javascript" src="./Bootswatch_Slate_files/ga.js"></script>
	<script type="text/javascript" src="./Bootswatch_Slate_files/bsa.js"></script>
	<script type="text/javascript" id="_bsap_js_c466df00a3cd5ee8568b5c4983b6bb19" src="./Bootswatch_Slate_files/s_c466df00a3cd5ee8568b5c4983b6bb19.js"></script>

</head>

<body style="">
	
	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
	        <div class="navbar-header">
	          	<a href="index.php" class="navbar-brand">Home</a>
	        </div>
	        <div class="navbar-collapse collapse" id="navbar-main">
	        	<ul class="nav navbar-nav">
		            <li class="dropdown">
		            	<a class="dropdown-toggle" data-toggle="dropdown" id="browse">Browse Books <span class="caret"></span></a>
		            	<ul class="dropdown-menu" aria-labelledby="browse">
			                <li><a tabindex="-1" href="#">Textbooks</a></li>
			                <li><a tabindex="-1" href="#">Historical</a></li>
			                <li><a tabindex="-1" href="#">Biographies</a></li>
			                <li class="divider"></li>
			                <li><a tabindex="-1" href="#">Fantasy</a></li>
			                <li><a tabindex="-1" href="#">Science Fiction</a></li>
			                <li><a tabindex="-1" href="#">Romance</a></li>
		            	</ul>
		            </li>
				</ul>

				<ul class="nav navbar-nav navbar-right">
					<li><a href="#">Book Cart</a></li>
					<li>		
					<?php echo ($userSet == true ? "You are logged in as '$fname' &nbsp; 
					<a href=\"logout.php\">Logout</a>" : "<a href=\"registration.php\">Profile/Login</a>"); ?> 
					</li>
					
					
				</ul>

	        </div>
      	</div>
	</div>

	<div class="container">

		<div class="page-header" id="banner">
			<div class="row">
				<div class="col-lg-6">
					<h1>Library Manangement Systems</h1>
					<p class="lead">Browse and Checkout Books</p>
					<br/><br/>
					<br/><br/>
					<blockquote class="pull-right">
		            	<p>The best Library Management System ever!</p>
		            	<small>Some Guy <cite title="Source Title">Somewhere</cite></small>
		            </blockquote>
				</div>
				<div class="col-lg-6">
					<div class="container">
						<div class="row">
							<div class="col-lg-1">
							</div>
							<div class="col-lg-11">
								<img src="./Bootswatch_Slate_files/books.png" id="bsap_1277971" class="bsap_1277971 bsap"></img>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="bs-docs-section">

	        <div class="row">
	          <div class="col-lg-12">
	            <div class="bs-example">
	              <div class="jumbotron">
	                <h1>Jumbotron</h1>
	                <p>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
	                <p><a class="btn btn-primary btn-lg">Learn more</a></p>
	              </div>
	            </div>
	          </div>
	        </div>
	    </div>
    </div>

	<script src="./Bootswatch_Slate_files/jquery.min.js"></script>
    <script src="./Bootswatch_Slate_files/bootstrap.min.js"></script>
    <script src="./Bootswatch_Slate_files/bootswatch.js"></script>
</body>

</html>

