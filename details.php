<?php 
	require 'core.php';
	if(!isset($_GET["bid"]))
	{
		header('Location: index.php');
	}
	//echo $_GET["category"];
?>

<html>
<head>

	<title>Library Management System</title>
	<link rel="stylesheet" href="http://bootswatch.com/slate/bootstrap.css" media="screen">
    <link rel="stylesheet" href="http://bootswatch.com/assets/css/bootswatch.min.css">
	<link rel="shortcut icon" href="./Bootswatch_Slate_files/favicon.png">
    <script type="text/javascript" src="./Bootswatch_Slate_files/ga.js"></script>
	<script type="text/javascript" src="./Bootswatch_Slate_files/bsa.js"></script>
	<script type="text/javascript" id="_bsap_js_c466df00a3cd5ee8568b5c4983b6bb19" src="./Bootswatch_Slate_files/s_c466df00a3cd5ee8568b5c4983b6bb19.js"></script>
	<script type="text/javascript">
    function showHide() {
        var div = document.getElementById("hidden_div");
        if (div.style.display == 'none') {
            div.style.display = '';
        }

        else {
            div.style.display = 'none';
        }
    }
	
	function Clear(){    
		document.getElementById("eid").value= "";
		document.getElementById("pid").value= "";
	}
	</script>

</head>

<body>
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


    <div class="container">

		<div class="page-header" id="banner">
			<div class="row">
				<div class="col-lg-6">
					<h1 id='bookTitle'>Library Management Systems</h1>
					<p class="lead" id='bookSubject'>Browse and Checkout Books</p>
				</div>
				<div class="col-lg-6">
					<div class="container">
						<div class="row">
							<div class="col-lg-1">
							</div>
							<div class="col-lg-11">
								<img src="./Bootswatch_Slate_files/books.png" id="bookImage" style="max-height:300;max-width:300;"></img>
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
	                <h1>Summary</h1>
	                <p id='bookSummary'>This is a simple hero unit, a simple jumbotron-style component for calling extra attention to featured content or information.</p>
	                <p>
	                	<?php 
                			if(isset($_GET['bid']))
	                		{
	                			echo '<a href="cart.php?bid='.$_GET['bid'].'" class="btn btn-primary btn-md">Add to Cart</a>';
	                		}
	                		else
	                		{
	                			echo '<a href="#" class="btn btn-primary btn-md">Add to Cart</a>';
	                		}
	                	?>
	                </p>
	              </div>
	            </div>
	          </div>
	        </div>
	    </div>



	    <div class="row">
			<div class="col-lg-12">
				<div class="bs-example">
					<div class="jumbotron">
						<h2>Users who ordered this also ordered...</h2>
						<?php
							require 'connect.php';
							$query4 = mysql_query("SELECT * FROM frequentitems4 where (`b_id1` = '{$_GET['bid']}' OR `b_id2` = '{$_GET['bid']}' OR `b_id3` = '{$_GET['bid']}' OR `b_id4` = '{$_GET['bid']}') LIMIT 1") or die("Unable to connect to query");
							$query_num_rows4 = mysql_num_rows($query4);

							if($query_num_rows4 == 0){
								$query3 = mysql_query("SELECT * FROM frequentitems3 where (`b_id1` = '{$_GET['bid']}' OR `b_id2` = '{$_GET['bid']}' OR `b_id3` = '{$_GET['bid']}') LIMIT 1") or die("Unable to connect to query");
								$query_num_rows3 = mysql_num_rows($query3);

								if($query_num_rows3 == 0)
								{
									echo "<p>No frequent items found!</p>";
								}
								else
								{
									while($row = mysql_fetch_array($query3)) {
										for ($i=0; $i < 3; $i++) {
											$book3_query = mysql_query("SELECT * FROM books where `b_id` = '{$row[$i]}'") or die("Unable to connect to query");
											$query_num_rows = mysql_num_rows($book3_query);

											if($query_num_rows == 0){
												echo "Book Not Found!";
											}
											else if($query_num_rows == 1){
												//echo "here4";
												while($innerRow = mysql_fetch_array($book3_query)) {
													echo '<div class="col-lg-4">
															<div class="panel panel-primary">
																<a href="./browse.php?category=Textbook">
																	<div class="panel-heading btn-primary">
																		<h3 class="panel-title">'.$innerRow['title'].'</h3>
																	</div>
																	<div class="panel-body" style="height:280;text-align: center;">
																		<img src="'.$innerRow['imageurl'].'" style="max-height:250;max-width:250;"></img>
																	</div>
																</a>
															</div>
														</div>';
												}
												//header('Location: index.php');
											}
											else{
												echo 'Error Occured';
											}
										}
									}
								}
							}
							else
							{
								while($row = mysql_fetch_array($query4)) {
									for ($i=0; $i < 4; $i++) {
										$book4_query = mysql_query("SELECT * FROM books where `b_id` = '{$row[$i]}'") or die("Unable to connect to query");
										$query_num_rows = mysql_num_rows($book4_query);

										if($query_num_rows == 0){
											echo "Book Not Found!";
										}
										else if($query_num_rows == 1){
											//echo "here4";
											while($innerRow = mysql_fetch_array($book4_query)) {
												echo '<div class="col-lg-3">
														<div class="panel panel-primary">
															<a href="./browse.php?category=Textbook">
																<div class="panel-heading btn-primary">
																	<h3 class="panel-title">'.$innerRow['title'].'</h3>
																</div>
																<div class="panel-body" style="height:180;text-align: center;">
																	<img src="'.$innerRow['imageurl'].'" style="max-height:180;max-width:180;"></img>
																</div>
															</a>
														</div>
													</div>';
											}
											//header('Location: index.php');
										}
										else{
											echo 'Error Occured';
										}
									}
								}
							}
						?>
						<p>
						&nbsp
						</p>
					</div>
				</div>
			</div>
		</div>
    </div>


	<script src="./Bootswatch_Slate_files/jquery.min.js"></script>
    <script src="./Bootswatch_Slate_files/bootstrap.min.js"></script>
    <script src="./Bootswatch_Slate_files/bootswatch.js"></script>
    <script type="text/javascript">
	    var book_title;
		var book_author;
		var book_isbn;
		var book_quantity;
		var book_subject;
		var book_details;
		var book_imageurl;

		<?php
			require 'connect.php';
			$user_query = mysql_query("SELECT * FROM books where `b_id` = '{$_GET['bid']}'") or die("Unable to connect to query");
			$query_num_rows = mysql_num_rows($user_query);

			if($query_num_rows == 0){
				echo "Book Not Found!";
			}
			else if($query_num_rows == 1){
				//echo "here4";
				while($row = mysql_fetch_array($user_query)) {
					echo "book_title='".$row['title']."';\n";
					echo "book_author='".$row['author']."';\n";
					echo "book_isbn='".$row['isbn']."';\n";
					echo "book_quantity='".$row['quantity']."';\n";
					echo "book_subject='".$row['subject']."';\n";
					echo "book_details='".$row['details']."';\n";
					echo "book_imageurl='".$row['imageurl']."';\n";
				}
				$userSet = true; // user exists in session !!
				//header('Location: index.php');
			}
			else{
				echo 'Error Occured';
			}
		?>

		$('#bookTitle').html(book_title);
		$('#bookSubject').html(book_subject);
		$('#bookImage').attr("src",book_imageurl);
		$('#bookSummary').html(book_details);
	</script>
</body>

</html>