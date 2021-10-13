<?php
	require 'header.php';
?>

<main>
<?php
// check that the user got to this page the correct way
if (isset($_POST['editcatname-submit'])) {
    // set variables
    $catselect = $_POST['catselect'];
    $newcatname = $_POST['editcategory'];
    // error checking
    if (empty($newcatname)) {
        // error checking (mmtuts, 2018)
        header("Location: adminadd.php?error=emptycat");
    }
    else {
        // update category in the database
        $catupdatestmt = $pdo->prepare('UPDATE categories SET category_name =? WHERE category_name =?');
        unset($_POST['editcatname-submit']);
        $catupdatestmt->execute($newcatname, $catselect);
        echo '<p>Category Updated</p>';
    }
}
?>
</main>

<?php
	require 'footer.php';
?>