<?php
	require 'header.php';
?>

<main>
<?php

// error checking (mmtuts, 2018)
if (isset($_GET['error'])) {
    if ($_GET['error'] == "emptycat") {
        echo '<p class="error">Please enter a category name.</p>';
        exit();
        
    }
}
// check that the user got to this page the correct way
if (isset($_POST['catname-submit'])) {
    $_SESSION['catselect'] = $_POST['catselect'];
    // create form to edit chosen category
    ?>
    <form action="adminedit.php" method="POST">
    <input type="text" name="editcategory" placeholder="Edit category name">
    <input type="submit" name="editcatname-submit" value="Save Changes" />
    </form> 
    <?php  
}
// check that the user got to this page the correct way
if (isset($_POST['editcatname-submit'])) {     
    $newcatname = $_POST['editcategory'];
    // error checking (mmtuts, 2018)
    if (empty($newcatname)) {
        header("Location: adminadd.php?error=emptycat");
        exit();
    }
    // update the category in the database
    $catupdatestmt = $pdo->prepare('UPDATE categories SET category_name = :category_name WHERE category_name = :existing_category');
    $values = [
        'category_name' => $newcatname,
        'existing_category' => $_SESSION['catselect']
    ];
    unset($_POST['editcatname-submit']);
    $catupdatestmt->execute($values);
    echo '<p>Category Updated</p>';
}
?>
</main>

<?php
	require 'footer.php';
?>