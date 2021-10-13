<?php
	require 'header.php';
?>

<main>

<h1>My Account</h1>
<?php 
// my account page for logged in user
// check that the user got to this page the correct way
if (isset($_POST['myaccount-submit'])) {
    // make sure there is a user logged in
    if (isset($_SESSION['user_id'])) {
        // show the users details
        ?>
        <h3>Details:</h3><hr>
        <p>Username: <?=$_SESSION['username']?></p>
        <p>Email: <?=$_SESSION['email']?></p> <br><br>
        
        <?php
        // show admin options if user is an admin
        if (isset($_SESSION['is_admin'])) {
            if ($_SESSION['is_admin'] == "Y") {?>
                <br><br><p>You are an admin!</p>
                <form action="adminarea.php" method="POST"> <input type="submit" name="addcat-submit" value="Add Category" /> </form>
                <form action="adminarea.php" method="POST"> <input type="submit" name="editcat-submit" value="Edit Category" /> </form>
                <form action="adminarea.php" method="POST"> <input type="submit" name="deletecat-submit" value="Delete Category" /> </form>
            <?php }
        } 
        // show all the reviews the user has received
        ?>
        <h3>My reviews:</h3><hr>
        <?php
        require 'dbconnect.php';
        $reviewstmt = $pdo->prepare('SELECT * FROM reviews WHERE username = "' . $_SESSION['username'] . '"');        
        $reviewstmt->execute();
        foreach ($reviewstmt as $row) { ?>
            <p><?=$row['review_rating']?>/5</p><h2><?=$row['review_title']?></h2><p><?=$row['review_desc']?> <?=$row['review_date']?>. <br>Review by: <?=$row['reviewer_name']?>. Email: <?=$row['reviewer_email']?></p><hr>
        <?php }
        
    }
    else {
        header("Location: index.php");
        exit();
    }
}
else {
    header("Location: index.php");
    exit();
}

?>
</main>

<?php
	require 'footer.php';
?>