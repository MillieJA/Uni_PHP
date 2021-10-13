<?php 
// navigation for the header
// connect to the database
require 'dbconnect.php';
// find all categories
$navitems = $pdo->query('SELECT * FROM categories');
// display each category in the navigation bar
foreach ($navitems as $row) {
	echo '<li class="catList"><a href="category.php?category=' . $row['category_name'] . '">' . $row['category_name'] . '</a></li>';
}
?>