<?php 
// navigation for the header

echo '<li><a href="index.php" class="logo"><img src="images/logo.jpg" alt="Logo" /></a></li>';
echo '<li class="catList"><a href="auctionlist.php">Auctions</a></li>';
echo '<li class="catList"><a href="sell.php">Sell</a></li>';
echo '<li class="catList"><a href="enquire.php">Enquire</a></li>';

// create search bar
echo '<li><form class="search" action="search.php" method="POST">
    <input type="text" name="search-value" />
    <input type="submit" name="search-submit" value="Search" />
</form></li>';