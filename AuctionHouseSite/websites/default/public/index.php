<?php
	require 'header.php';
?>

<main>

<div class="popAuc"> 
    <h1>Popular Auctions</h1><hr>
    <a href=auctions.php><img src="images/books-unsplash.jpg" alt="Popular Auction" class="popAuction"></a>
    <?php
    require 'dbconnect.php';
    $stmt = $pdo->query('SELECT * FROM auction WHERE lot_reference_number = 100001');
    foreach ($stmt as $row) {?>
        <h1><?=$row['title']?></h1>
        <h3>
            Fotheby’s presents Drawings From the Early and Middle Ages, an exciting online auction encompassing works from the 1st to the 15th century. This auction features a huge range of drawings including medieval cartography, and important scientific drawings. The auction also includes original artworks by Leonardo da Vinci.
        </h3>
        <br><br><br>
        <h3>Location: <?=$row['location']?></h3>
        <h3>Period: <?=$row['period']?></h3>
        <h3>Category: <?=$row['category']?></h3>
        <h3>Date: <?=$row['date']?></h3><?php
        }
        ?>
    <a href="auctionview.php?lot_reference_number=100001">View Auction</a>
    
</div>
<div class="upcomingAuc">
    <h2>Upcoming Auctions</h2>
    <ul class="auctionList">
        <?php
        require 'dbconnect.php';
        $stmt = $pdo->query('SELECT * FROM auction ORDER BY date ASC LIMIT 0, 5');
        foreach ($stmt as $row) {?>
            <div class="upcoming"><a href="auctionview.php?&lot_reference_number=<?=$row['lot_reference_number']?>" class="product">
            <h2 class="name"><?=$row['title']?></h2><p><?=$row['date']?>. </p><p><?=$row['period']?>. <?=$row['location']?>.</p>
            <p>Category: <?=$row['category']?></p>
            </a></div> <?php
        }
        ?>
    </ul>
</div>
<hr />
	</main>
<?php
	require 'footer.php';
?>