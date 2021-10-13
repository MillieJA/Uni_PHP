<?php
	require 'header.php';
?>

<main>
    <?php 
    // check that the user got to this page the correct way
    if (isset($_POST['login-submit'])) {
        require 'dbconnect.php';
        // get log in variables
        $emailusername = $_POST['loginemailusername'];
        $password = $_POST['loginpassword'];

        // error checking (mmtuts, 2018)
        if (empty($emailusername) || empty($password)) {
            header("Location: index.php?error=emptyfields");
            exit();
        }
        
        else {
            // check that username or email entered is valid
            $stmt = $pdo->prepare('SELECT * FROM users WHERE username =? OR email =?');
            $stmt->execute([$emailusername, $emailusername]);
            $user = $stmt->fetch();
            // compare submitted password with secure stored password
            if (password_verify($password, $user['password'])) {
                // create session if password is correct
                session_start();
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['is_admin'] = $user['is_admin'];
                // error checking (mmtuts, 2018)
                header("Location: index.php?login=success");
                exit();
            }
            else {
                // error checking (mmtuts, 2018)
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