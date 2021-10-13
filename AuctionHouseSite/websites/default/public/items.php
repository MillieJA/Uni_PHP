<?php
	require 'header.php';
?>

<main>
<?php 
?>
<h1>Items</h1>

    <?php
    // check which option the user has selected


    // show auction options
    ?>

    <form action="items.php" method="POST"> <input type="submit" name="createitem-submit" value="Add a new item" /> </form>
    <form action="items.php" method="POST"> <input type="submit" name="edititem-submit" value="Edit an item" /> </form>
    <form action="items.php" method="POST"> <input type="submit" name="deleteitem-submit" value="Delete an item" /> </form>
    <?php
    require 'dbconnect.php';
    // show all auctions
	$itemstmt = $pdo->prepare('SELECT * FROM item ORDER BY title DESC');        
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