<?php
	require 'header.php';
?>

<main>
<?php 
// error checking (mmtuts, 2018)
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
    $item_name = $_POST['item_name'];
    $item_desc = $_POST['item_desc'];
    $start_price = $_POST['start_price'];
    $buy_now_price = $_POST['buy_now_price'];
    $catselect = $_POST['catselect'];
    // (Hasib32, 2015) - used to get the time which the auction is created
    $start_date = date('Y-m-d H:i:s');
    // (mamta, 2016) - used to find the time the auction will end
    $end_date = date('Y-m-d H:i:s',strtotime('+7 days',strtotime($start_date)));
    $username = $_SESSION['username']; 

    // error checking (mmtuts, 2018)
    if (empty($item_name) || empty($start_price) || empty($buy_now_price) || empty($catselect)) {
        header("Location: createauctioninfo.php?error=emptydetails&item_name=".$item_name."&item_desc=".$item_desc);
        exit();
    }

    // create auction
    $stmt = $pdo->prepare('INSERT INTO items (item_name, item_desc, start_price, buy_now_price, start_date, end_date, item_category, username) VALUES (?, ?, ?, ?, ?, ?, ?, ?)');
    unset($_POST['createauctioninfo-submit']);
    $stmt->execute([$item_name, $item_desc, $start_price, $buy_now_price, $start_date, $end_date, $catselect, $username]);
    // error checking (mmtuts, 2018)
    header("Location: createauctioninfo.php?create=success");
    exit();
}
?>
</main>

<?php
	require 'footer.php';
?>