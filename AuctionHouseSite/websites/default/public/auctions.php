<?php
	require 'header.php';
?>

<main>
<?php 
?>
<h1>Auctions</h1>

<?php
// check which option the user has selected

if (isset($_POST['editauction-submit'])) {
    require 'dbconnect.php';
    ?><form action="editauction.php?" method="POST">
    <label for="auctionselect">Select Auction</label>
    <select name="auctionselect" id="auctionselect"> <?php 
    $auctionliststmt = $pdo->query('SELECT * FROM auction ORDER BY date ASC');       
    $auctionliststmt->execute();
    foreach ($auctionliststmt as $row) {
        echo '<option value="' . $row['lot_reference_number'] . '">' . $row['title'] . '</option>';
    } ?>
    </select> 
    <input type="submit" name="auctionname-submit" value="Edit Auction" />
    </form>
<?php }

else if (isset($_POST['deleteauction-submit'])) {
    // show delete auction form
    require 'dbconnect.php'; 
    ?><form action="deleteauction.php" method="POST">
    <label for="auctionselect">Select Auction</label>
    <select name="auctionselect" id="auctionselect"> <?php 
    $auctionliststmt = $pdo->query('SELECT * FROM auction ORDER BY date ASC');       
    $auctionliststmt->execute();
    foreach ($auctionliststmt as $row) {
        echo '<option value="' . $row['title'] . '">' . $row['title'] . '</option>';
    } ?>
    </select> 
    <input type="submit" name="deleteauctionfinal-submit" value="Delete Auction" />
    </form> 
    <?php
}
else { 
    // show auction options
    ?>

	<form action="createauction.php" method="POST"> <input type="submit" name="createauction-submit" value="Create a new auction" /> </form>
	<form action="auctions.php" method="POST"> <input type="submit" name="editauction-submit" value="Edit an auction" /> </form>
	<form action="auctions.php" method="POST"> <input type="submit" name="deleteauction-submit" value="Delete an auction" /> </form>
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
	}
}
?>
</main>

<?php
	require 'footer.php';
?>