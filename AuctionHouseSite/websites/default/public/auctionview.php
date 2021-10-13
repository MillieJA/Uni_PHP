<?php
	require 'header.php';
?>

<main>
<?php
// error checking
if (isset($_GET['error'])) {
    if ($_GET['error'] == "auctionnotfound") {
        echo '<p class="error">Auction not found</p>';
	}
}?>
<h1>Auction Page</h1>

<?php
// get auction to display on the page
if (isset($_GET['lot_reference_number'])) {
    require 'dbconnect.php';
	$stmt = $pdo->prepare('SELECT * FROM auction WHERE lot_reference_number =? LIMIT 1');
	$stmt->execute(array($_GET['lot_reference_number']));
	$auctionresults = $stmt->rowCount();
	foreach ($stmt as $row) {
		// error checking
    	if ($auctionresults = 0) {
    	    header("Location: auctionview.php?error=auctionnotfound");
    	    exit();
		}
		// display information about the product
		else { ?>
			<section class="details">
			<h2><?=$row['title']?></h2>
			<p>Date: <?=$row['date']?></p>
			<p>Period: <?=$row['period']?></p>
            <p>Category: <?=$row['category']?></p>
            <p>Location: <?=$row['location']?></p>
            <h3>Items in Auction: </h3>
                <ul class="itemList">
                    
                <?php
                $itemstmt = $pdo->prepare(
                'SELECT i.* FROM item i 
                JOIN auction_item ai 
                ON i.lot_number = ai.lot_number 
                JOIN auction a 
                ON ai.lot_reference_number = a.lot_reference_number 
                WHERE a.lot_reference_number=?');
              
                $itemstmt->execute(array($row['lot_reference_number']));
                foreach ($itemstmt as $item) {?>
                    <li class="auctionItem"><div><a href="itemview.php?&lot_number=<?=$item['lot_number']?>" class="product">
                    <h2 class="name"><?=$item['title']?></h2><p>Created by: <?=$item['artist']?>. </p><p>Estimated Price: <?=$item['estimated_price']?>. Created in: <?=$item['date_of_creation']?>.</p>
                    <p>Description: <?=$item['description']?></p>
                    <p>Category: <?=$item['category']?></p>
                        <p>Era: <?=$item['era']?></p>
                        <p>Medium: <?=$item['medium']?></p>
                        <p>Dimensions: <?=$item['dimensions']?></p>
                        <p>Framed: <?=$item['framed']?></p>
                        </a></div></li> <?php
                }
                ?>
                </ul>
			<?php
			
		}
	}
}
?>

</main>

<?php
	require 'footer.php';
?>