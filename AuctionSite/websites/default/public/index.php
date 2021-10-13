<?php
	require 'header.php';
?>

<main>

<h1>Latest Listings</h1><hr>
<ul class="productList">
	<?php
	// show list of 10 most recent listings in descending order
	require 'dbconnect.php';
	$stmt = $pdo->query('SELECT * FROM items ORDER BY end_date DESC LIMIT 0, 10');
	foreach ($stmt as $row) {?>
		<a href="product.php?&item_id=<?=$row['item_id']?>" class="product">
		<img src="product.png" alt="<?=$row['item_name']?>">
        <h2 class="name"><?=$row['item_name']?></h2><p><?=$row['item_desc']?>. </p><p>Posted by: <?=$row['username']?>. Ends on <?=$row['end_date']?>.</p>
		<p class="price">£<?=$row['start_price']?></p>
        </a><hr> <?php
	}
	?>
</ul>
<hr />
	</main>
<?php
	require 'footer.php';
?>