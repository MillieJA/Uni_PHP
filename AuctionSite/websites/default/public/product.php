<?php
	require 'header.php';
?>

<main>
<?php
// error checking (mmtuts, 2018)
if (isset($_GET['error'])) {
    if ($_GET['error'] == "productnotfound") {
        echo '<p class="error">Product not found</p>';
	}
	if ($_GET['error'] == "emptyamount") {
        echo '<p class="error">Please enter a bid amount</p>';
	}
}?>
<h1>Product Page</h1>

<?php
// get item to display on the page
if (isset($_GET['item_id'])) {
	$stmt = $pdo->prepare('SELECT * FROM items WHERE item_id =? LIMIT 1');
	$stmt->execute(array($_GET['item_id']));
	$productresults = $stmt->rowCount();
	foreach ($stmt as $row) {
		// error checking (mmtuts, 2018)
    	if ($productresults = 0) {
    	    header("Location: product.php?error=productnotfound");
    	    exit();
		}
		// display information about the product
		else { ?>
			<section class="details">
			<h2><?=$row['item_name']?></h2>
			<img src="product.png" alt="<?=$row['item_name']?>">
			<h3><?=$row['item_category']?></h3>
			<p>Auction created by <?=$row['username']?></p>
			<section class="description">
			<p><?=$row['item_desc']?></p>
			</section>
			<p class="price">Current bid: £<?=$row['start_price']?></p>
			<p class="price">Buy now for: £<?=$row['buy_now_price']?></p>
			<?php
			
			// if there is a user logged in, allow the to place a bid
			if (isset($_SESSION['user_id'])) { ?>
				<form action="product.php?&item_id=<?=$row['item_id']?>" class="bid">
				<label for="bid_amount">£</label><input type="text" name="bid_amount" id="bid_amount" placeholder="Enter bid amount:" />
				<input type="submit" name="bid-submit" value="Place bid" />
				</form> <?php
				// if bid submitted, update the current bid value
				if (isset($_POST['bid-submit'])) {
					if (empty($_POST['bid_amount'])) {
						// error checking (mmtuts, 2018)
						header("Location: product.php?error=enteramount");
						exit();
					}
					$new_price = $_POST['bid_amount'];
					$item = $row['item_name'];
					$bidstmt = $pdo->prepare('UPDATE items SET start_price =? WHERE item_name =?');
    				$bidstmt->execute([$new_price, $item]);
					echo '<p>Thank you for your bid!</p>';
				}
			}	

			// (Php.net) - used to find the different in time between the current time and the products end time
			// show how much time is remaining
			$end = new DateTime($row['end_date']);
			$date = new DateTime();
			$remaining = $date->diff($end);
			?>
			<time>Time left: <?=$remaining->format('%dD %hH %iM %sS ');?></time><br><hr><br>
			
			</section>
			<section class="reviews">
			<h2>Reviews of <?=$row['username']?></h2>
			
			<ul>
			<?php
			// show all reviews for the poster of the product
			$reviewstmt = $pdo->prepare('SELECT * FROM reviews WHERE username = :username');
			$values = [
				'username' => $row['username']
			];

			$reviewstmt->execute($values);
			foreach ($reviewstmt as $review) { ?>
				<li><p><?=$review['review_rating']?>/5</p><h2><?=$review['review_title']?></h2><p><?=$review['review_desc']?> <?=$review['review_date']?>. <br>Review by: <?=$review['reviewer_name']?>. Email: <?=$review['reviewer_email']?></p></li><hr>
			<?php }
			?>
			</ul>

			<?php
			// if there is a user logged in, allow them to review the poster of the product
			if (isset($_SESSION['user_id'])) { ?>
				<form action="review.php" method="POST">
				<label for="review_of">Reviewing: </label><input type="text" value="<?=$row['username']?>" name="review_of" readonly="readonly">
				<label for="review_title">Review title: </label><input type="text" name="review_title">
				<label for="review_desc">Review Description: </label><input type="text" name="review_desc">
				<label for="rating">Rating out of 5: </label>
				<select name="rating" id="rating">    
    				<option value="5">5</option>
					<option value="4">4</option>
					<option value="3">3</option>
					<option value="2">2</option>
					<option value="1">1</option>
				</select>
				<input type="submit" name="review-submit" value="Submit Review" />
   				</form> 
				<?php
			} ?>
			</section>
			<hr />
			<?php
		}
	}
}
?>

</main>

<?php
	require 'footer.php';
?>