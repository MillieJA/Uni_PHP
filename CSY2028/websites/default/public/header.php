<?php
	session_start();
?>
<!DOCTYPE html>
<html>
	<head>
		<title>ibuy Auctions</title>
		 <meta charset="UTF-8" />
		<link rel="stylesheet" href="ibuy.css" />
	</head>
	<body>

	<header>
		<a href="index.php"><h1><span class="i">i</span><span class="b">b</span><span class="u">u</span><span class="y">y</span></h1></a>

		<?php 
		// create search abr
		?>
		<form class="search" action="search.php" method="POST">
			<input type="text" name="search-value" placeholder="Search for anything" />
			<input type="submit" name="search-submit" value="Search" />
		</form>
	</header>

	<nav class="login">
		<?php 
		// error checking (mmtuts, 2018)
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
		if (isset($_SESSION['user_id'])) {?>
			<p>Hello <?=$_SESSION['username']?>!</p>
			<form action="myaccount.php" method="POST"> <input type="submit" name="myaccount-submit" value="My Account" /> </form>
			<form action="auctions.php" method="POST"> <input type="submit" name="auction-submit" value="Auctions" /> </form>
			<form action="logout.php" method="POST"> <input type="submit" name="logout-submit" value="Log out" /> </form>
		<?php }
		// otherwise show log in form/signup button
		else {
			?><form action="login.php" method="POST">
        	<input type="text" name="loginemailusername" placeholder="Email or Username">
        	<input type="password" name="loginpassword" placeholder="Password">
        	<input type="submit" name="login-submit" value="Log in" />
			</form>

			<p>You are not signed in. <a href="signup.php"><input type="submit" name="signup" value="Sign Up" /></a></p>
			<?php
		}
		?>
	</nav>

	<nav>
		<ul class="navList">
		<?php
		// display the nav bar
	    	require 'nav.php';
	    ?>
		</ul>
	</nav>
	<a href="index.php"><img src="images/randombanner.php" alt="Banner" /></a>