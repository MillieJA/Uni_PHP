<?php
	require 'header.php';
?>

<main>
<h1>Search results</h1><hr>
<?php
// error checking
if (isset($_GET['error'])) {
	if ($_GET['error'] == "noresults") {
		echo '<p class="error">No results found</p>';
	}
}
?>
<ul>
<?php 
require 'dbconnect.php';
// make sure the user got to this page from the correct place
if (isset($_POST['search-submit'])) {
	
	// what has been searched for
	$searchterm = $_POST['search-value'];
	// query to match the search term with the database information
	$query = 'SELECT * FROM auction WHERE title LIKE ? OR category LIKE ?';
	$params = array("%$searchterm%", "%$searchterm%");
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
	$searchresults = $stmt->rowCount();
	// error checking
	// checking for no results
    if (empty($searchterm)) {
        header("Location: search.php?error=noresults");
	}
	if ($searchresults == 0) {
        header("Location: search.php?error=noresults");
    }
	// display each search result
	foreach ($stmt as $row) {?>
		<a href="auctionview.php?&lot_reference_number=<?=$row['lot_reference_number']?>" class="product">
        <h2 class="name"><?=$row['title']?></h2><p><?=$row['date']?>.</p><p>Category: <?=$row['category']?>.</p><p>Location: <?=$row['location']?>.</p>
        </a><hr><?php
		}
}
?>
</ul>
</main>

<?php
	require 'footer.php';
?>