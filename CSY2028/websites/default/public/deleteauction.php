<?php
	require 'header.php';
?>

<main>
<h1>Delete auction</h1>

<?php
// get selected auction and remove it from the database
if (isset($_POST['deleteauctionfinal-submit'])) {
    $auctionselect = $_POST['auctionselect'];
    $auctionstmt = $pdo->prepare("DELETE FROM items WHERE item_name =?");        
    $auctionstmt->execute([$auctionselect]);
    echo '<p>Auction Deleted</p>';
}
    
?>

</main>

<?php
	require 'footer.php';
?>