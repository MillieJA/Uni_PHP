<?php
	require 'header.php';
?>

<main>
<h1>Create a new auction</h1>
<?php 

// form to create an auction
?>
<form action="createauctioninfo.php" method="POST">
    <label for="item_name">Item Name: </label><input type="text" id="item_name" name="item_name" placeholder="Item Name">
    <label for="item_desc">Item Description: </label><input type="textarea" id="item_desc" name="item_desc" placeholder="Describe your item:">
    <label for="start_price">Item Starting Price: £</label><input type="number" min="0.01" step="0.01" max="9999" id="start_price" name="start_price" placeholder="0000.00">
    <label for="buy_now_price">Item Buy Now Price: £</label><input type="number" min="0.01" step="0.01" max="9999" id="buy_now_price" name="buy_now_price" placeholder="0000.00">
    <label for="item_category">Item Category: </label>
    <select name="catselect" id="catselect"> <?php 
    // provide drop down list of categories to assign to the auction being created
    require 'dbconnect.php';
    $catliststmt = $pdo->query("SELECT * FROM categories");       
    foreach ($catliststmt as $row) {
        echo '<option value="' . $row['category_name'] . '">' . $row['category_name'] . '</option>';
    } ?>
    </select> 
    <input type="submit" name="createauctioninfo-submit" value="Create Auction" />
</form>

</main>

<?php
	require 'footer.php';
?>