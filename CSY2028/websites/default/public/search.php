<?php
	require 'header.php';
?>

<main>
<h1>Search results</h1><hr>
<?php
// error checking (mmtuts, 2018)
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
	$query = 'SELECT * FROM items WHERE item_name LIKE ? OR item_desc LIKE ?';
	$params = array("%$searchterm%", "%$searchterm%");
	$stmt = $pdo->prepare($query);
	$stmt->execute($params);
	$searchresults = $stmt->rowCount();
	// error checking (mmtuts, 2018)
	// checking for no results
    if (empty($searchterm)) {
        header("Location: search.php?error=noresults");
	}
	if ($searchresults == 0) {
        header("Location: search.php?error=noresults");
    }
	// display each search result
	foreach ($stmt as $row) {?>
		<a href="product.php?&id=<?=$row['item_id']?>" class="product">
		<img src="product.png" alt="<?=$row['item_name']?>">
        <h2 class="name"><?=$row['item_name']?></h2><p><?=$row['item_desc']?>. </p><p>Posted by: <?=$row['username']?>. </p>
		<p class="price">£<?=$row['start_price']?>.00</p>
    	</a><hr><?php
		}
}
?>
</ul>
</main>

<?php
	require 'footer.php';
?>