<?php
	require 'header.php';
?>

<main>
<h1>Delete auction</h1>

<?php
// get selected auction and remove it from the database
if (isset($_POST['deleteauctionfinal-submit'])) {
    require 'dbconnect.php';
    $auctionselect = $_POST['auctionselect'];
    $auctionstmt = $pdo->prepare("DELETE FROM auction WHERE title =?");        
    $auctionstmt->execute([$auctionselect]);
    echo '<p>Auction Deleted</p>';
}
    
?>

</main>

<?php
	require 'footer.php';
?>