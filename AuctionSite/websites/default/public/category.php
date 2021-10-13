<?php
	require 'header.php';
?>

<main>
<h1><?=$_GET['category']?> Listings</h1>

<?php 

// error checking (mmtuts, 2018)
if (isset($_GET['error'])) {
	if ($_GET['error'] == "noresults") {
		echo '<p class="error">No products found in this category.</p>';
	}
}

$category = $_GET['category'];
// get all items that are in this category
$catstmt = $pdo->prepare('SELECT * FROM items WHERE item_category =? ORDER BY end_date DESC');
$catstmt->execute([$category]);
$catresults = $catstmt->rowCount();
if ($catresults = 0) {
	// error checking (mmtuts, 2018)
    header("Location: category.php?error=noresults");
    exit();
}
else {
	// display items 
	foreach ($catstmt as $row) { ?>
		<a href="product.php?&item_id=<?=$row['item_id']?>" class="product">
		<img src="product.png" alt="<?=$row['item_name']?>">
        <h2 class="name"><?=$row['item_name']?></h2><p><?=$row['item_desc']?>. </p><p>Posted by: <?=$row['username']?>. Ends on <?=$row['end_date']?>.</p>
		<p class="price">£<?=$row['start_price']?></p>
        </a><hr> <?php
	}
}

?>

</main>

<?php
	require 'footer.php';
?>