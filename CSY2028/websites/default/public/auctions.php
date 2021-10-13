<?php
	require 'header.php';
?>

<main>
<?php 
?>
<h1>My Auctions</h1>

<?php
// check which option the user has selected

if (isset($_POST['editauction-submit'])) {
    // show edit auction form
    ?><form action="editauction.php" method="POST">
    <label for="auctionselect">Select Auction</label>
    <select name="auctionselect" id="auctionselect"> <?php 
    $auctionliststmt = $pdo->query('SELECT * FROM items WHERE username ="' . $_SESSION['username'] . '"');       
    foreach ($auctionliststmt as $row) {
        echo '<option value="' . $row['item_name'] . '">' . $row['item_name'] . '</option>';
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
    $auctionliststmt = $pdo->query('SELECT * FROM items WHERE username ="' . $_SESSION['username'] . '"');       
    foreach ($auctionliststmt as $row) {
        echo '<option value="' . $row['item_name'] . '">' . $row['item_name'] . '</option>';
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
    // show all users items
	$auctionstmt = $pdo->prepare('SELECT * FROM items WHERE username = "' . $_SESSION['username'] . '"');        
	$auctionstmt->execute();
	$auctionresults = $auctionstmt->rowCount();
	
	foreach ($auctionstmt as $row) { ?>
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