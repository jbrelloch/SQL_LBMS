<?php 
	require 'core.php';
	if(!isset($_GET["category"]))
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
			<div class="row">
				<div class="col-lg-12">
					<h1 id="tables"><?php echo ($_GET["category"] == 'None') ? "All Books" : $_GET["category"]; ?></h1>
					
		            <div class="well">
		            	<form class="bs-example form-horizontal" action="browse.php" method="get">
		                	<fieldset>
		                		<legend>Search</legend>
		                		<div class="form-group">
		                    		<div class="col-lg-4">
		                      			<input type="text" class="form-control" id="inputEmail" placeholder="ISBN" name="ISBN">
		                   			</div>
		                    		<div class="col-lg-4">
		                      			<input type="text" class="form-control" id="inputTitle" placeholder="Title" name="Title">
		                   			</div>
		                    		<div class="col-lg-4">
		                      			<input type="text" class="form-control" id="inputAuthor" placeholder="Author" name="Author">
		                   			</div>
		                   			<input type="hidden" id="inputCategory" value="<?php echo $_GET['category']?>" name="category">
		                    		<div class="col-lg-4">
		                   			</div>
		                    		<div class="col-lg-4" style="text-align:center;"><br/>
  										<input type="submit" class="btn btn-primary" value="Submit">	
		                   			</div>
		                    		<div class="col-lg-4">
		                   			</div>
		                  		</div>
		                  	</fieldset>
		                </form>
		            </div>

					<div class="bs-example table-responsive">
						<table class="table table-striped table-bordered table-hover">
							<thead>
								<tr>
									<th>ISBN</th>
									<th>Title</th>
									<th>Author</th>
									<th>Subject</th>
									<th>Quantity Remaining</th>
								</tr>
							</thead>
							<tbody>
								<?php
									require 'connect.php';
									$cat = $_GET['category'];

									$queryStr = "SELECT * FROM books";
									$where = false;
									if($cat != 'None')
									{
										if(!$where)
										{
											$queryStr = $queryStr." WHERE `subject` = '$cat'";
											$where = true;
										}
										else
										{
											$queryStr = $queryStr." AND `subject` = '$cat'";											
										}
									}
									if(isset($_GET['ISBN']) && $_GET['ISBN'] != "")
									{
										$isbn = $_GET['ISBN'];
										if(!$where)
										{
											$queryStr = $queryStr." WHERE `isbn` = '$isbn'";	
											$where = true;
										}
										else
										{
											$queryStr = $queryStr." AND `isbn` = '$isbn'";											
										}
									}
									if(isset($_GET['Title']) && $_GET['Title'] != "")
									{
										$title = $_GET['Title'];
										if(!$where)
										{
											$queryStr = $queryStr." WHERE `title` = '$title'";	
											$where = true;
										}
										else
										{
											$queryStr = $queryStr." AND `title` = '$title'";											
										}
									}
									if(isset($_GET['Author']) && $_GET['Author'] != "")
									{
										$author = $_GET['Author'];
										if(!$where)
										{
											$queryStr = $queryStr." WHERE `author` = '$author'";	
											$where = true;
										}
										else
										{
											$queryStr = $queryStr." AND `author` = '$author'";										
										}
									}
									if(isset($_GET['offset']))
									{
										$offsetVal = $_GET['offset'];
										$totalOffset = $offsetVal * 20;

										$queryStr = $queryStr." LIMIT $totalOffset,20";	
									}
									else
									{
										$queryStr = $queryStr." LIMIT 20";	
									}
									echo $queryStr;

									$result = mysql_query($queryStr) or die("Unable to connect to query");
									$result_count = mysql_num_rows($result);

									while ($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
									    //printf("ID: %s  Name: %s", $row[0], $row[1]);
									    echo '<tr>'.
									    		'<td>'.$row["isbn"].'</td>'.
									    		'<td>'.$row["title"].'</td>'.
									    		'<td>'.$row["author"].'</td>'.
									    		'<td>'.$row["subject"].'</td>'.
									    		'<td>'.$row["quantity"].'</td>'.
									    		'<td>'.
									    			'<div class="btn-group">'.
                										'<button type="button" class="btn btn-default">Actions</button>'.
                  										'<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="caret"></span></button>'.
                 										'<ul class="dropdown-menu">'.
                    										'<li><a href="details.php?bid='.$row["b_id"].'">View Details</a></li>'.
										                    '<li class="divider"></li>'.
										                    '<li><a href="cart.php?bid='.$row["b_id"].'">Add 1</a></li>'.
										                    '<li><a href="cart.php?bid='.$row["b_id"].'&count=5">Add 5</a></li>'.
                  										'</ul>'.
                									'</div>'.
									    		'</td>'.
									    	'</tr>';
									}
								?>
							</tbody>
						</table>
						<?php 
							require 'connect.php';
							$str = $_GET['category'];

							$queryStr = "SELECT * FROM books";
							if($str != 'None')
							{
								$queryStr = $queryStr." WHERE `subject` = '$str'";
							}

							$result = mysql_query($queryStr) or die("Unable to connect to query");
							$result_count = mysql_num_rows($result);

							if(isset($_GET['offset']))
							{
								$offsetVal = $_GET['offset'];
								if($offsetVal == 1)
								{
									if((($offsetVal+1)*20) < $result_count)
										echo '<ul class="pager">
									            <li class="previous"><a href="browse.php?category='.$str.'">&lt Prev</a></li>
									            <li class="next"><a href="browse.php?category='.$str.'&offset='.($offsetVal+1).'">Next &gt</a></li>
									          </ul>';
									else
										echo '<ul class="pager">
									            <li class="previous"><a href="browse.php?category='.$str.'">&lt Prev</a></li>
									            <li class="next disabled"><a href="#">Next &gt</a></li>
									          </ul>';
								}
								else
								{
									if((($offsetVal+1)*20) < $result_count)
										echo '<ul class="pager">
									            <li class="previous"><a href="browse.php?category='.$str.'&offset='.($offsetVal-1).'"">&lt Prev</a></li>
									            <li class="next"><a href="browse.php?category='.$str.'&offset='.($offsetVal+1).'">Next &gt</a></li>
									          </ul>';
									else
										echo '<ul class="pager">
									            <li class="previous"><a href="browse.php?category='.$str.'&offset='.($offsetVal-1).'"">&lt Prev</a></li>
									            <li class="next disabled"><a href="#">Next &gt</a></li>
									          </ul>';
								}
							}
							else
							{
								if($result_count > 20)
									echo '<ul class="pager">
								            <li class="previous disabled"><a href="#">&lt Prev</a></li>
								            <li class="next"><a href="browse.php?category='.$str.'&offset=1">Next &gt</a></li>
								          </ul>';
								else
									echo '<ul class="pager">
								            <li class="previous disabled"><a href="#">&lt Prev</a></li>
								            <li class="next disabled"><a href="#">Next &gt</a></li>
								          </ul>';
							}
						?>
					</div><!-- /example -->
				</div>
			</div>
	</div>


	<script src="./Bootswatch_Slate_files/jquery.min.js"></script>
    <script src="./Bootswatch_Slate_files/bootstrap.min.js"></script>
    <script src="./Bootswatch_Slate_files/bootswatch.js"></script>
</body>

</html>