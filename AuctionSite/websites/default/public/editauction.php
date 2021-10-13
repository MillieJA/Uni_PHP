<?php
	require 'header.php';
?>

<main>
<?php 
// error checking (mmtuts, 2018)
if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptyinfo") {
        echo '<p class="error">Please fill in all fields.</p>';
        exit();
        
    }
}

// check that the user got to this page the correct way
if (isset($_POST['auctionname-submit'])) {
    $_SESSION['auctionselect'] = $_POST['auctionselect'];
    // create form for editing the auction selected
    ?>
    <form action="editauction.php" method="POST">
    
    <label for="item_name">Item Name: </label><input type="text" id="item_name" name="item_name" placeholder="Item Name">
    <label for="item_desc">Item Description: </label><input type="textarea" id="item_desc" name="item_desc" placeholder="Describe your item:">
    <label for="start_price">Item Starting Price: £</label><input type="number" min="0.01" step="0.01" max="9999" id="start_price" name="start_price" placeholder="0000.00">
    <label for="buy_now_price">Item Buy Now Price: £</label><input type="number" min="0.01" step="0.01" max="9999" id="buy_now_price" name="buy_now_price" placeholder="0000.00">
    <label for="item_category">Item Category: </label>
    <select name="catselect" id="catselect"> <?php 
    // create drop down to assign category
    require 'dbconnect.php';
    $catliststmt = $pdo->query("SELECT * FROM categories");       
    foreach ($catliststmt as $row) {
        echo '<option value="' . $row['category_name'] . '">' . $row['category_name'] . '</option>';
    } ?>

    </select> 
    <input type="submit" name="editauction-submit" value="Save Changes" />
    </form> 
    <?php  
}

if (isset($_POST['editauction-submit'])) {     
    // create variables
    $item_name = $_POST['item_name'];
    $item_desc = $_POST['item_desc'];
    $start_price = $_POST['start_price'];
    $buy_now_price = $_POST['buy_now_price'];
    $catselect = $_POST['catselect'];
    // error checking
    if ((empty($item_name)) || (empty($start_price)) || (empty($buy_now_price)) || (empty($catselect))) {
        // error checking (mmtuts, 2018)
        header("Location: editauction.php?error=emptyinfo");
        exit();
    }
    // update information in the database
    $auctionupdatestmt = $pdo->prepare('UPDATE items SET item_name =?, item_desc =?, start_price =?, buy_now_price =?, item_category =?  WHERE item_name =?');
    unset($_POST['editauction-submit']);
    $auctionupdatestmt->execute(array($item_name, $item_desc, $start_price, $buy_now_price, $catselect, $_SESSION['auctionselect']));
    echo '<p>Auction Updated</p>';
} ?>
</main>

<?php
	require 'footer.php';
?>