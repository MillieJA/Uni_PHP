<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Fotheby's</title>
		 <meta charset="UTF-8" />
		<link rel="stylesheet" href="fothebys.css" />
	</head>
	<body>

	<header> <nav class="login">
		<?php 
		// error checking
		if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p class="error">Please fill in all fields.</p>';
            }
            else if ($_GET['error'] == "nouser") {
                echo '<p class="error">User not found.</p>';
			}
		}
		if (isset($_GET['login'])) {
            if ($_GET['login'] == "success") {
                echo '<p class="login">Login successful!</p>';
            }
		}
		// show account/auction/log out options if there is a user logged in
		if (isset($_SESSION['username'])) {?>
			<p>Hello <?=$_SESSION['username']?>!</p>
			<form action="auctions.php" method="POST"> <input type="submit" name="auction-submit" value="Auctions" /> </form>
            <form action="items.php" method="POST"> <input type="submit" name="item-submit" value="Items" /> </form>
            <form action="auctionPending.php" method="POST"><input type="submit" name="pending-submit" value="Items Pending Auction"/> </form>
			<form action="logout.php" method="POST"> <input type="submit" name="logout-submit" value="Log out" /> </form>
		<?php }
		// otherwise show log in form/signup button
		else {
			?><form action="login.php" method="POST">
        	<input type="text" name="loginemailusername" placeholder="Email or Username">
        	<input type="password" name="loginpassword" placeholder="Password">
        	<input type="submit" name="login-submit" value="Log in" />
			</form>

			<p>You are not signed in.</p>
			<?php
		}
		?>
	</nav>
        </header>
	<nav>
		<ul class="navList">
		<?php
		// display the nav bar
	    	require 'nav.php';
	    ?>
		</ul>
	</nav>