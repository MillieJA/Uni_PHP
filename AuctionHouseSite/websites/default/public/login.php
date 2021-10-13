<?php
	require 'header.php';
?>

<main>
    <?php 
    // check that the user got to this page the correct way
    if (isset($_POST['login-submit'])) {
        // get log in variables
        $emailusername = $_POST['loginemailusername'];
        $password = $_POST['loginpassword'];

        // error checking
        if (empty($emailusername) || empty($password)) {
            header("Location: index.php?error=emptyfields");
            exit();
        }
        
        else {
            // check that username or email entered is valid
            // compare submitted password with secure stored password
            if ($emailusername = "fothebysAdmin" && $password = "fothebysAdmin") {
                // create session if password is correct
                session_start();
                $_SESSION['username'] = "Fotheby's Admin";
                $_SESSION['is_admin'] = $user['is_admin'];
                // error checking
                header("Location: index.php?login=success");
                exit();
            }
            else {
                // error checking
                header("Location: index.php?error=nouser");
                exit();
            }
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