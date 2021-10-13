<?php
	require 'header.php';
?>

<main>
    <h1>Sign up</h1>
    <?php
    // error checking (mmtuts, 2018)
        if (isset($_GET['error'])) {
            if ($_GET['error'] == "emptyfields") {
                echo '<p class="error">Please fill in all fields!</p>';
            }
            else if ($_GET['error'] == "invalidemailname") {
                echo '<p class="error">Email and username are invalid.</p>';
            }
            else if ($_GET['error'] == "invalidemail") {
                echo '<p class="error">Email is invalid.</p>';
            }
            else if ($_GET['error'] == "invalidname") {
                echo '<p class="error">Username is invalid.</p>';
            }
            else if ($_GET['error'] == "passwordvalidate") {
                echo '<p class="error">Passwords do not match.</p>';
            }
            else if ($_GET['error'] == "usernameemailexists") {
                echo '<p class="error">Sorry this email and username are already in use.</p>';
            }
            else if ($_GET['error'] == "usernameexists") {
                echo '<p class="error">Sorry, this username is already taken.</p>';
            }
            else if ($_GET['error'] == "emailexists") {
                echo '<p class="error">Sorry this email is already in use.</p>';
            }
        }
        if (isset($_GET['signup'])) {
            if ($_GET['signup'] == "success") {
                echo '<p class="signup">Signup successful!</p>';
            }
        }
    // signup form 
    ?>
    <form action="signup.php" method="POST">
        <input type="text" name="email" placeholder="Email">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="passwordvalidate" placeholder="Confirm Password">
        <input type="submit" name="signup-submit" value="Sign up" />
    </form>

    <?php
    // make sure the user got to this page from the correct place
    if (isset($_POST['signup-submit'])) {

        require 'dbconnect.php';
        
        // set variables
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordvalidate = $_POST['passwordvalidate'];

        // error checking (mmtuts, 2018) and information validation
        if (empty($email) || empty($username) || empty($password) || empty($passwordvalidate)) {
            header("Location: signup.php?error=emptyfields&email=".$email."&username=".$username);
            exit();
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL) && (!preg_match("/^[a-zA-Z0-9]*$/", $username))) {
            header("Location: signup.php?error=invalidemailname");
            exit();
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            header("Location: signup.php?error=invalidemail&username=".$username);
            exit();
        }
        else if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
            header("Location: signup.php?error=invalidname&email=".$email);
            exit();
        }
        else if ($password !== $passwordvalidate) {
            header("Location: signup.php?error=passwordvalidate&email=".$email."&username=".$username);
            exit();
        }
        else {
            // check to make sure unique values are not duplicates
            // (Zhorov, 2019) - used to get the rowCount() to make sure there are no duplicates
            $userstmt = $pdo->prepare("SELECT * FROM users WHERE username =?");
            $emailstmt = $pdo->prepare("SELECT * FROM users WHERE email =?");

            $userstmt->execute([$username]);
            $userresults = $userstmt->rowCount();

            $emailstmt->execute([$email]);
            $emailresults = $emailstmt->rowCount();

            // error checking (mmtuts, 2018) for duplicates
            if (($userresults > 0) && ($emailresults > 0)) {
                header("Location: signup.php?error=usernameemailexists");
                exit();
            }
            else if ($userresults > 0){
                header("Location: signup.php?error=usernameexists&email=".$email);
                exit();
            }
            else if ($emailresults > 0){
                header("Location: signup.php?error=emailexists&username=".$username);
                exit();
            }
        }
        // covert the password to a secure format
        $hashpassword = password_hash($password, PASSWORD_DEFAULT);
        // create statement to add the user to the database
        $stmt = $pdo->prepare('INSERT INTO users (email, username, password) VALUES (?, ?, ?)');
        unset($_POST['signup-submit']);
        $stmt->execute([$email, $username, $hashpassword]);
        // error checking (mmtuts, 2018)
        header("Location: signup.php?signup=success");
        exit();
    }
    ?>

</main>

<?php
	require 'footer.php';
?> 