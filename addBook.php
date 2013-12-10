<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<?php 
	require 'core.php';
	//echo $_GET["category"];
?>
<head>
	<title>Add Book Form</title>
	<link rel="stylesheet" type="text/css" href="./select/select2.css">
	<link rel="stylesheet" href="http://bootswatch.com/slate/bootstrap.css" media="screen">
	<link rel="stylesheet" href="http://bootswatch.com/assets/css/bootswatch.min.css">

	
	
	<link rel="shortcut icon" href="./Bootswatch_Slate_files/favicon.png">
	<script type="text/javascript" src="./Bootswatch_Slate_files/addBookValidation.js"></script>
	<style>


	</style>
</head>

<body onLoad="document.registration.userid.focus();">

	<div class="navbar navbar-default navbar-fixed-top">
		<div class="container">
	        <div class="navbar-header">
	          	<a href="index.php" class="navbar-brand">Home</a>
	        </div>
			
	        <div class="navbar-collapse collapse" id="navbar-main">
	        	<ul class="nav navbar-nav">
	        		<?php
	        			if(isset($_SESSION['userType']) && $_SESSION['userType'] == 1)
	        			{
			        		echo '<li>'.
			        				'<a href="addBook.php">Add Books</a>'.
			        			'</li>'.
			        			'<li>'.
			        				'<a href="userManage.php">Manage Users</a>'.
			        			'</li>';
	        			}
	        			else if (!isset($_SESSION['userType']))
	        			{
	        				echo '<li>'.
	          						'<a href="registration.php" >Sign Up</a>'.
	        					'</li>';
	        			}
	        			echo '<li class="dropdown">'.
		            			'<a class="dropdown-toggle" data-toggle="dropdown" id="browse">Browse Books <span class="caret"></span></a>'.
		            			'<ul class="dropdown-menu" aria-labelledby="browse">'.
			                		'<li><a tabindex="-1" href="browse.php?category=None">All Books</a></li>'.
			                		'<li class="divider"></li>'.
			                		'<li><a tabindex="-1" href="browse.php?category=Textbook">Textbooks</a></li>'.
			                		'<li><a tabindex="-1" href="browse.php?category=Historical">Historical</a></li>'.
			                		'<li><a tabindex="-1" href="browse.php?category=Biography">Biographies</a></li>'.
			                		'<li class="divider"></li>'.
			                		'<li><a tabindex="-1" href="browse.php?category=Fantasy">Fantasy</a></li>'.
			                		'<li><a tabindex="-1" href="browse.php?category=ScienceFiction">Science Fiction</a></li>'.
			                		'<li><a tabindex="-1" href="browse.php?category=Romance">Romance</a></li>'.
		            			'</ul>'.
		            		'</li>';
	        		?>
		            
				</ul>
				<label><?php //echo $error_arr['emailId'];?></label>
				<label><?php //echo $error_arr['passwd'];?></label>
				<ul class="nav navbar-nav navbar-right">
					<li><a href="cart.php">Book Cart<?php echo (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) ? "(".count($_SESSION['cart']).")" : ""; ?></a></li>
					<li>		
					<?php echo (isset($_SESSION['fname']) ? "<a href=\"logout.php\">Logout ".$_SESSION['fname']."</a>" : "<a onclick=\"showHide();\">Login</a>"); ?> 
					</li>
				</ul>
				<div id="hidden_div" style="display:none;padding-top:10px;padding-left:20px;" class="navbar-header">
					<form name='registration' class="form-inline" action="index.php<?php //$_SERVER['PHP_SELF'];?>" method="POST">

						<input type="text" id="eid" name="emailId" size="20" class="input-small" placeholder="Email"/>&nbsp;
					
						<input type="password" id="pid" name="passwd" size="20" class="input-small" placeholder="Password"/>&nbsp;
						
						<input type="submit" value="Submit" class="btn-small"/></td>
						<input type="submit" value="Cancel" onclick="Clear(); showHide(); return false;" class="btn-mini">
					</form>
				</div>
				
				
	        </div>
		

      	</div>
	</div>
	
	<h1 style="padding-left:15px;">Add Book Form</h1>
	<p style="padding-left:15px;">Use tab keys to move from one input field to the next.</p>
	<form name='addBook' onSubmit="return formValidation();" class="form-horizontal" style="width:50%;margin-left:50px;" action="addBook_submit.php" method="post">
		<legend>Enter Book Information</legend>
		<div class="form-group">
			<label for="title">Title</label>
			<input type="text" class="form-control" id="title" name="title" placeholder="Enter book name" size="20">
		</div>
		<div class="form-group">
			<label for="author">Author</label>
			<input type="text" class="form-control" id="author" name="author" placeholder="Enter author name">
		</div>
		<div class="form-group">
			<label for="isbn">ISBN</label>
			<input type="text" class="form-control" id="isbn" name="isbn" placeholder="Enter ISBN">
		</div>
		<div class="form-group">
			<label for="quantity">Quantity</label>
			<input type="quantity" class="form-control" id="quantity" name="quantity" placeholder="Enter Quantity">
		</div>
		<div class="form-group">
			<label for="subject">Subject</label>
			<br/>
			<select name="subject" class="dropdown" id="subject">
				<option value="TextBooks">TextBooks</option>
				<option value="Historical">Historical</option>
				<option value="Biography">Biography</option>
				<option value="Fantasy">Fantasy</option>
				<option value="Fiction">Fiction</option>
				<option value="Romance">Romance</option>
				<option value="Sports">Sports</option>
				<option value="Cooking">Cooking</option>
			</select>
		</div>
		<button type="submit" name="submit" class="btn btn-primary">Submit</button>
	</form>

	<script src="./Bootswatch_Slate_files/jquery.min.js"></script>
    <script src="./Bootswatch_Slate_files/bootstrap.min.js"></script>
    <script src="./Bootswatch_Slate_files/bootswatch.js"></script>
</body>
</html>