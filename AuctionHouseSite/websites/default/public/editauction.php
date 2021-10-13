<?php
	require 'header.php';
?>

<main>
<?php 
// error checking
if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptyinfo") {
        echo '<p class="error">Please fill in all fields.</p>';
        exit();
        
    }
}

// check that the user got to this page the correct way
if (isset($_POST['auctionname-submit'])) {
    // create form for editing the auction selected
        $auctionselect = $_POST['auctionselect']; ?>
        <form action="editauction.php" method="POST">

        <?php require 'dbconnect.php';
        $stmt = $pdo->prepare('SELECT * FROM auction WHERE lot_reference_number =? LIMIT 1');
        $stmt->execute(array($auctionselect));
        $auctionresults = $stmt->rowCount();
        foreach ($stmt as $row) { ?>
            
        <label for="title">Auction Title: </label><input type="text" id="title" name="title" value=<?=$row['title']?>>
        <label for="date">Auction Date: </label><input type="date" id="date" name="date" value=<?=$row['date']?>>
        <label for="period">Auction Period: </label><input type="text" id="period" name="period" value=<?=$row['period']?>>
        <label for="category">Auction Category: </label><select id="category" name="category">
            <option value="Drawings">Drawings</option>
            <option value="Paintings">Paintings</option>
            <option value="Photographic Images">Photographic Images</option>
            <option value="Sculptures">Sculptures</option>
            <option value="Carvings">Carvings</option>
        </select>
        <label for="location">Location: </label><select id="location" name="location">
            <option value="London">London</option>
            <option value="Paris">Paris</option>
            <option value="New York">New York</option>
        </select>
        <input type="hidden" id="lot_reference_number" name="lot_reference_number" value=<?=$auctionselect?>/>
        <input type="submit" name="editauction-submit" value="Save Changes" />
        </form> 
        <?php
        }
}

if (isset($_POST['editauction-submit'])) {     
    // create variables
    $title = $_POST['title'];
    $date = $_POST['date'];
    $period = $_POST['period'];
    $category = $_POST['category'];
    $location = $_POST['location'];
    $lot_reference_number = $_POST['lot_reference_number'];
    // error checking
    if (empty($title) || empty($date) || empty($period) || empty($category) || empty($location)) {
        // error checking
        header("Location: editauction.php?error=emptyinfo");
        exit();
    }
    // update information in the database
    require 'dbconnect.php';
    $auctionupdatestmt = $pdo->prepare('UPDATE auction SET title =?, date =?, period =?, category =?, location =?  WHERE lot_reference_number =?');
    unset($_POST['editauction-submit']);
    $auctionupdatestmt->execute(array($title, $date, $period, $category, $location, $lot_reference_number));
    echo '<p>Auction Updated</p>';
} ?>
</main>

<?php
	require 'footer.php';
?>