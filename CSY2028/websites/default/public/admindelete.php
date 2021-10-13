<?php
	require 'header.php';
?>

<main>
<?php
// check that the user got to this page the correct way
if (isset($_POST['deletecatfinal-submit'])) {
    // take selected category and remove it from the database
    $catselect = $_POST['catselect'];
    $catstmt = $pdo->prepare("DELETE FROM categories WHERE category_name =?");        
    $catstmt->execute([$catselect]);
    echo '<p>Category Deleted</p>';
}

?>
</main>

<?php
	require 'footer.php';
?>