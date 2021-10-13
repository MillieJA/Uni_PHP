<?php
	require 'header.php';
?>

<main>
<h1>Create a new auction</h1>
<?php 

// form to create an auction
?>
<form action="createauctioninfo.php" method="POST">
    <label for="title">Auction Title: </label><input type="text" id="title" name="title" placeholder="Auction Title">
    <label for="date">Auction Date: </label><input type="date" id="date" name="date">
    <label for="period">Auction Period: </label><input type="text" id="period" name="period" placeholder="Auction Period">
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
    <input type="submit" name="createauctioninfo-submit" value="Create Auction" />
</form>

</main>

<?php
	require 'footer.php';
?>