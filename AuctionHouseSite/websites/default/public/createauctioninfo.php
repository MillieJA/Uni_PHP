<?php
	require 'header.php';
?>

<main>
<?php 
// error checking
if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptydetails") {
        echo '<p class="error">Please fill in all fields!</p>';
    }
}
if (isset($_GET['create'])) {
    if ($_GET['create'] == "success") {
        echo '<p class="create">Auction Created!</p>';
    }
}

if (isset($_POST['createauctioninfo-submit'])) {
    require 'dbconnect.php';
    // get variables from creation form
    $title = $_POST['title'];
    $date = $_POST['date'];
    $period = $_POST['period'];
    $category = $_POST['category'];
    $location = $_POST['location'];

    // error checking
    if (empty($title) || empty($date) || empty($period) || empty($category) || empty($location)) {
        header("Location: createauctioninfo.php?error=emptydetails&title=".$title);
        exit();
    }

    // create auction
    $stmt = $pdo->prepare('INSERT INTO auction (title, date, period, category, location) VALUES (?, ?, ?, ?, ?)');
    unset($_POST['createauctioninfo-submit']);
    $stmt->execute([$title, $date, $period, $category, $location]);
    // error checking
    header("Location: createauctioninfo.php?create=success");
    exit();
}
?>
</main>

<?php
	require 'footer.php';
?>