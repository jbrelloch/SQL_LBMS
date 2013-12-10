<?php 
	require 'core.php';

	if(isset($_GET['bid']))//book to add to cart
	{
		if(isset($_SESSION['cart']) && array_key_exists($_GET['bid'], $_SESSION['cart']))//cart exists and book already in cart
		{
			if(isset($_GET['count']))
			{
				if($_GET['count'] == -1)
					unset($_SESSION['cart'][$_GET['bid']]);
				else
					$_SESSION['cart'][$_GET['bid']] += $_GET['count'];
			}
			else
				$_SESSION['cart'][$_GET['bid']] += 1;
			}
		else
		{
			if(isset($_GET['count']))
				$_SESSION['cart'][$_GET['bid']] = $_GET['count'];
			else
				$_SESSION['cart'][$_GET['bid']] = 1;
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

	<div class="row">
		<div class="col-lg-4">
		</div>
          <div class="col-lg-4">
          	<p>
          		<?php
          		if(isset($_GET['error']))
          		{
          			if($_GET['error'] == 'quantity')
          				echo "ERROR: Not enough books in store!";
          			elseif($_GET['error'] == 'quantity')
          				echo "ERROR: Book in cart does not exist!";
          			else
          				echo "ERROR: I don't know!";
          		}
          		?>
          	</p>
            <div class="page-header">
              <h1 id="tables">Book Cart</h1>
            </div>

            <div class="bs-example table-responsive">
              <table class="table table-striped table-bordered table-hover">
                <thead>
                  <tr>
                    <th>Title</th>
                    <th>Author</th>
                    <th>Quantity</th>
                  </tr>
                </thead>
                <tbody>
                	<?php
						require 'connect.php';

						if(isset($_SESSION['cart']))
						{
							foreach ($_SESSION['cart'] as $key => $value) {
								$result = mysql_query("SELECT * FROM books WHERE `b_id` = '".$key."'") or die("Unable to connect to query");
								$result_count = mysql_num_rows($result);

								if($result_count == 1)
								{
									while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
									    //printf("ID: %s  Name: %s", $row[0], $row[1]);
									    echo '<tr>'.
									    		'<td>'.$row["title"].'</td>'.
									    		'<td>'.$row["author"].'</td>'.
									    		'<td>'.$value.'</td>'.
									    		'<td>'.
									    			'<div class="btn-group">'.
			    										'<button type="button" class="btn btn-default">Actions</button>'.
			      										'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>'.
			     										'<ul class="dropdown-menu">'.
                    										'<li><a href="details.php?bid='.$row["b_id"].'">View Details</a></li>'.
										                    '<li class="divider"></li>'.
										                    '<li><a href="cart.php?bid='.$row["b_id"].'">Add 1</a></li>'.
										                    '<li><a href="cart.php?bid='.$row["b_id"].'&count=5">Add 5</a></li>'.
										                    '<li class="divider"></li>'.
										                    '<li><a href="cart.php?bid='.$row["b_id"].'&count=-1">Remove All</a></li>'.
			      										'</ul>'.
			    									'</div>'.
									    		'</td>'.
									    	'</tr>';
									}
								}
								else
								{
									echo '<tr>'.
								    		'<td>ERROR</td>'.
								    		'<td>ERROR</td>'.
								    		'<td>ERROR</td>'.
								    		'<td>ERROR</td>'.
								    	'</tr>';
								}
									
							}
						}
					?>
                </tbody>
              </table>
              <?php 
              	echo (isset($_SESSION['userType']) && isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) ? '<div class="btn-group btn-group-justified">
                <a href="index.php" class="btn btn-default btn-lg">Continue Shopping</a>
                <a href="order_submit.php" class="btn btn-success btn-lg" onclick="return confirm(\'Are you sure?\')">Checkout</a>
              </div>' : "";
              ?>
            </div><!-- /example -->
          </div>
		<div class="col-lg-4">
		</div>
    </div>

	<script src="./Bootswatch_Slate_files/jquery.min.js"></script>
    <script src="./Bootswatch_Slate_files/bootstrap.min.js"></script>
    <script src="./Bootswatch_Slate_files/bootswatch.js"></script>
</body>

</html>