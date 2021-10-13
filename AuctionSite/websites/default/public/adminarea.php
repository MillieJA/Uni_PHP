<?php
	require 'header.php';
?>

<main>
<?php

// error checking (mmtuts, 2018)
if (isset($_GET['newcat'])) {
    if ($_GET['newcat'] == "success") {
        echo '<p class="newcat">New category created!</p>';
    }
}

// check what option the user has selected
if (isset($_POST['addcat-submit'])) { 
    // display form depending on selected option
    ?>
    <form action="adminadd.php" method="POST">
    <input type="text" name="newcategory" placeholder="New Category">
    <input type="submit" name="newcat-submit" value="Add Category" />
    </form> <?php 
}
if (isset($_POST['editcat-submit'])) {
    // display form depending on selected option
    ?>
    <form action="adminedit.php" method="POST">
    <label for="catselect">Select Category</label>
    <select name="catselect" id="catselect"> <?php 
    require 'dbconnect.php';
    // display a list of categories to edit
    $catliststmt = $pdo->query("SELECT * FROM categories");       
    foreach ($catliststmt as $row) {
        echo '<option value="' . $row['category_name'] . '">' . $row['category_name'] . '</option>';
    } ?>
    </select> 
    <input type="submit" name="catname-submit" value="Edit Category" />
    </form>
    <?php 
}
if (isset($_POST['deletecat-submit'])) {
    // display form depending on selected option
    require 'dbconnect.php'; 
    // display a list of categories to delete
    ?>
    <form action="admindelete.php" method="POST">
    <label for="catselect">Select Category</label>
    <select name="catselect" id="catselect"> <?php 
    $catliststmt = $pdo->query("SELECT * FROM categories");       
    foreach ($catliststmt as $row) {
        echo '<option value="' . $row['category_name'] . '">' . $row['category_name'] . '</option>';
    } ?>
    </select> 
    <input type="submit" name="deletecatfinal-submit" value="Delete Category" />
    </form> 
    <?php
}
        
?>
</main>

<?php
	require 'footer.php';
?>