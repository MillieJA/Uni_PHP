<?php
	require 'header.php';
?>

<main><?php
// error checking (mmtuts, 2018)
if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptyreview") {
        echo '<p class="error">Please fill in all fields!</p>';
    }
}
if (isset($_GET['review'])) {
    if ($_GET['review'] == "success") {
        echo '<p class="review">Review Submitted!</p>';
    }
}

// make sure the user accessed this page from the correct place
if (isset($_POST['review-submit'])) {
    //connect to the database
    require 'dbconnect.php';

    // set all variables
    $rating = $_POST['rating'];
    $review_title = $_POST['review_title'];
    $review_desc = $_POST['review_desc'];
    $review_date = new DateTime();
    $review_date = $review_date->format('Y-m-d h:i:s'); 
    $reviewer_name = $_SESSION['username'];
    $reviewer_email = $_SESSION['email'];
    $username = $_POST['review_of'];

    // error checking (mmtuts, 2018)
    if (empty($rating) || empty($review_title) || empty($review_desc)) {
        header("Location: review.php?error=emptyreview");
        exit();
    }
    // create sql statement to insert the review
    $stmt = $pdo->prepare('INSERT INTO reviews (review_rating, review_title, review_desc, review_date, reviewer_name, reviewer_email, username) VALUES (?, ?, ?, ?, ?, ?, ?)');
    unset($_POST['review-submit']);
    $stmt->execute([$rating, $review_title, $review_desc, $review_date, $reviewer_name, $reviewer_email, $username]);
    header("Location: review.php?review=success");
    exit();
}?>

</main>

<?php
	require 'footer.php';
?>