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
    else if ($_GET['error'] == "catexists") {
        echo '<p class="error">Sorry this category already exists.</p>';
        exit();
    }
}

// check that the user got to this page the correct way
if (isset($_POST['newcat-submit'])) {
    require 'dbconnect.php';
    // get new category name
    $newcategory = $_POST['newcategory'];   
    if (empty($newcategory)) {
        header("Location: adminadd.php?error=emptycat");
    }
    else {
        // check to make sure unique values are not duplicates
        // (Zhorov, 2019) - used to get the rowCount() to make sure there are no duplicates
        $catstmt = $pdo->prepare('SELECT * FROM categories WHERE category_name =?');        
        $catstmt->execute([$newcategory]);
        $catresults = $catstmt->rowCount();
        // error checking (mmtuts, 2018)
        if ($catresults > 0){
            header("Location: adminadd.php?error=catexists");
        }
        else {
            // create the category
            $stmt = $pdo->prepare('INSERT INTO categories (category_name) VALUES (?)');
            unset($_POST['newcat-submit']);
            $stmt->execute([$newcategory]);
            // error checking (mmtuts, 2018)
            header("Location: adminarea.php?newcat=success");
            exit();
        }
    }
}    
?>
</main>

<?php
	require 'footer.php';
?>