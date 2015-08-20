<!DOCTYPE html>
<html lang="en">
<head>
	<title><?php echo $pageTitle; ?></title>
	<meta charset="utf-8">
	<link rel="stylesheet" href="css/normalize.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
	<nav class="navbar navbar-inverse navbar-static-top" role="navigation">
		<div class="container">
			<a href="index.php" class="navbar-brand">Apps by Jordan</a>	

			<button class="navbar-toggle" data-toggle="collapse" data-target=".navHeaderCollapse">  <!-- Navbar Expand Button on Mobile -->
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>

			<div class="collapse navbar-collapse navHeaderCollapse">

				<ul class="nav navbar-nav navbar-right">
					<li class="<?php if ($section == "text app") {echo "active"; } ?>"><a href="index.php">Text App</a></li>
					<li><a href="#">Page 2</a></li>
					<li><a href="#">Page 3</a></li>
				</ul>
			</div>
		</div>  	<!-- End Container -->
	</nav>	
		
	
		
	