<?php
	require 'header.php';
?>

<main>
<?php
    require 'dbconnect.php';
    // show all auctions
	$auctionstmt = $pdo->prepare('SELECT * FROM auction ORDER BY date ASC');        
	$auctionstmt->execute();
	$auctionresults = $auctionstmt->rowCount();
	
	foreach ($auctionstmt as $row) { ?>
		<a href="auctionview.php?&lot_reference_number=<?=$row['lot_reference_number']?>" class="product">
        <h2 class="name"><?=$row['title']?></h2><p><?=$row['date']?>.</p><p>Category: <?=$row['category']?>.</p><p>Location: <?=$row['location']?>.</p>
        </a><hr> <?php
	} ?>
<hr />
</main>
<?php
	require 'footer.php';
?>