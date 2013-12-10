<?php
	session_start();
	$userSet = false;	
	
	if (isset($_SESSION['mid'])){
		$userSet = true; // user exists in session !!
		$mid = $_SESSION['mid'];
		$fname = $_SESSION['fname'];
	}else{
		//connect database
		$dbHost = "localhost";
		$dbUser = "root";
		$dbPass = "";
		$dbname = "bookstore";
		$dbconnect = mysql_connect($dbHost,$dbUser,$dbPass)	or die("Unable to connect to the MySQL");
		mysql_select_db($dbname,$dbconnect);
		
		if($_SERVER['REQUEST_METHOD']=='POST'){
			$emailId = $_POST['emailId'];
			$passwd = $_POST['passwd'];
			//echo $emailId;
			//echo $passwd;
			$error_arr = array();

			if($emailId == ''){
				$error_arr['emailId'] = 'Email ID Required';
			}
			else if($passwd == ''){
				$error_arr['passwd'] = 'Password Required';
			}else{
				$valid_arr['emailId'] = $emailId;
				$valid_arr['passwd'] = $passwd;
			}

			//echo "<br>counter "+count($error_arr);
			if(count($error_arr) == 0){
					//echo "here";
				$_SESSION['emailId'] = $valid_arr['emailId'];
				$_SESSION['passwd'] = $valid_arr['passwd'];
				//$password = md5($valid_arr['passwd']);
				$password = $valid_arr['passwd'];
				//echo $password;
				//$user_query = mysql_query("SELECT * FROM members where email = '{$_SESSION['emailId']}'") or die("Unable to connect to query");
				$usertype_query = mysql_query("SELECT admin FROM members where `email` = '{$_SESSION['emailId']}' AND `password` = '$password'") or die("Unable to connect to query");
				$user_query = mysql_query("SELECT * FROM members where `email` = '{$_SESSION['emailId']}' AND `password` = '$password'") or die("Unable to connect to query");
				$query_num_rows = mysql_num_rows($user_query);
					//echo "here2";

				if($query_num_rows == 0){
					//echo "here3";
						echo "Invalid Email ID/Password";
						$error_arr['passwd'] = 	'Invalid Email ID/Password';
				}
				else if($query_num_rows == 1){
					//echo "here4";
					while($row = mysql_fetch_array($user_query)) {
						if ($row['email'] == $_SESSION['emailId']){
							$_SESSION['userType'] = $row['admin'];
							echo 'the usertype is '+$_SESSION['userType'];
							$_SESSION['mid'] = $row['m_id'];
							$_SESSION['fname'] = $row['first_name'];
							$error_arr['passwd'] = $_SESSION['fname'];
						}
					}
					$userSet = true; // user exists in session !!
					header('Location: index.php');
				}
				else{
					echo 'Error Occured';
				}
			}
		}
	}
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

	<div class="container">

		<div class="page-header" id="banner">
			<div class="row">
				<div class="col-lg-6">
					<h1>Library Management Systems</h1>
					<p class="lead">Browse and Checkout Books</p>
					<br/><br/>
					<blockquote class="pull-right">
		            	<p>The best Library Management System ever!</p>
		            	<small>Some Guy, <cite title="Source Title">Somewhere</cite></small>
		            </blockquote>
				</div>
				<div class="col-lg-6">
					<div class="container">
						<div class="row">
							<div class="col-lg-1">
							</div>
							<div class="col-lg-11">
								<img src="./Bootswatch_Slate_files/books.png" id="bsap_1277971" class="bsap_1277971 bsap" style="max-height:300;max-width:300;"></img>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

        <div class="row">
          <div class="col-lg-12">
            <div class="bs-example">
              <div class="jumbotron">
                <div class="col-lg-4">
					<div class="panel panel-primary">
						<a href="./browse.php?category=Textbook">
							<div class="panel-heading btn-primary">
								<h3 class="panel-title">Textbooks</h3>
							</div>
							<div class="panel-body" style="height:280;text-align: center;">
								<img src="http://www.webweaver.nu/clipart/img/education/stack-of-books.png" style="max-height:250;max-width:250;"></img>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="panel panel-primary">
						<a href="./browse.php?category=Historical">
							<div class="panel-heading btn-primary">
								<h3 class="panel-title">Historical</h3>
							</div>
							<div class="panel-body" style="height:280;text-align: center;">
								<img src="http://www-tc.pbs.org/wgbh/aia/part2/images/2cris2378b.jpg" style="max-height:250;max-width:250;"></img>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="panel panel-primary">
						<a href="./browse.php?category=Biography">
							<div class="panel-heading btn-primary">
								<h3 class="panel-title">Biographies</h3>
							</div>
							<div class="panel-body" style="height:280;text-align: center;">
								<img src="http://www.biography.com/imported/images/Biography/Images/Profiles/E/Albert-Einstein-9285408-1-402.jpg" style="max-height:250;max-width:250;"></img>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="panel panel-primary">
						<a href="./browse.php?category=Fantasy">
							<div class="panel-heading btn-primary">
								<h3 class="panel-title">Fantasy</h3>
							</div>
							<div class="panel-body" style="height:280;text-align: center;">
								<img src="http://s3.amazonaws.com/rapgenius/1362582359_unicorn.jpg" style="max-height:250;max-width:250;"></img>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="panel panel-primary">
						<a href="./browse.php?category=ScienceFiction">
							<div class="panel-heading btn-primary">
								<h3 class="panel-title">Science Fiction</h3>
							</div>
							<div class="panel-body" style="height:280;text-align: center;">
								<img src="http://static4.wikia.nocookie.net/__cb20130310133315/starwars/images/5/58/Soldier_stub.png" style="max-height:250;max-width:250;"></img>
							</div>
						</a>
					</div>
				</div>
				<div class="col-lg-4">
					<div class="panel panel-primary">
						<a href="./browse.php?category=Romance">
							<div class="panel-heading btn-primary">
								<h3 class="panel-title">Romance</h3>
							</div>
							<div class="panel-body" style="height:280;text-align: center;">
								<img src="http://nyoobserver.files.wordpress.com/2013/01/50-shades-of-grey-cover-thumbnail.jpeg" style="max-height:250;max-width:250;"></img>
							</div>
						</a>
					</div>
				</div>
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
</body>

</html>

