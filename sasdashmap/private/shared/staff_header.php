<?php

	if (!isset($page_title)) {$page_title= 'Staff Area';}

?>

<!doctype html>

<html lang="en">
	<head>
		<title> WCU - <?php echo h($page_title) ?> </title>
		<meta charset="utf-8">
		<link rel="stylesheet" type="text/css" media="all" href="<?php echo url_for('/stylesheets/staff.css'); ?>" />
		<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'>
        </script>
	</head>

	<body>
		<header>
			<h1>WCU SAS Staff Area</h1>
				<div class="nav_menu"> 
				 <a id="ini" href="<?php echo url_for('/staff/index.php'); ?>"> Staff Menu </a>
				 <a href="<?php echo url_for('/index.php') ?>">Home</a>
				 <a href="<?php echo url_for('/staff/logout.php') ?>">Logout</a>
				 <a href=""> User: <?php echo $_SESSION['username'] ?? '' ; ?> </a>
		</div>
		</header>

		<message> <?php echo display_session_message() ; ?> </message>