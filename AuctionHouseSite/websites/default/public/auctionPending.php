<?php
	require 'header.php';
?>

<main>
<?php 
?>
<h1>Items With Auction Pending</h1>

    <?php
    require 'dbconnect.php';
    // show all auctions
	$itemstmt = $pdo->query('SELECT i.* FROM item i WHERE i.lot_number NOT IN (SELECT ai.lot_number FROM auction_item ai)');        
	$itemstmt->execute();

    foreach ($itemstmt as $item) {?>
        <div><a href="itemview.php?&lot_number=<?=$item['lot_number']?>" class="product">
        <h2 class="name"><?=$item['title']?></h2><p>Created by: <?=$item['artist']?>. </p><p>Estimated Price: <?=$item['estimated_price']?>. Created in: <?=$item['date_of_creation']?>.</p>
        <p>Description: <?=$item['description']?></p>
        <p>Category: <?=$item['category']?></p>
        <p>Era: <?=$item['era']?></p>
        <p>Medium: <?=$item['medium']?></p>
        <p>Dimensions: <?=$item['dimensions']?></p>
        <p>Framed: <?=$item['framed']?></p>
            </a></div><hr /> <?php
    } ?>
        
    
    
</main>

<?php
	require 'footer.php';
?>