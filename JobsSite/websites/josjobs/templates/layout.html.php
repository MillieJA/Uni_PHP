<!-- Layout for every page (Header, Navigation, Footer) -->
<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/styles.css">
        <title><?=$title?></title>
    </head>
    <body>
        <nav>
            <header>
                <section>
                    <aside>
                        <h3>Office Hours:</h3>
                        <p>Mon-Fri: 09:00-17:30</p>
                        <p>Sat: 09:00-17:00</p>
                        <p>Sun: Closed</p>
                    </aside>
                    <h1>Jo's Jobs</h1>
		        </section>
            </header>
            <!-- Navigation -->
            <ul>
                <li><a href="/home">Home</a></li>
                <li>Jobs
                    <ul>
                        <?php foreach($categories as $category) { ?>
                            <li><a href="/job/list?id=<?=$category['id']?>&location=All"><?=$category['name']?></a></li><?php } ?>
                    </ul>
                </li>
                <li><a href="/about">About Us</a></li>
                <li><a href="/faq">FAQ's</a></li>
                <li><a href="/enquiry">Contact Us</a></li>
                <!-- Display log in or log out option depending on whether a user is logged in or not -->
                <?php if (!isset($_SESSION['loggedin'])) {
                    ?><li><a href="/login">Log In</a></li><?php
                }
                else {
                    ?><li><a href="/logout">Log Out</a></li><?php 
                }
                ?>
            </ul>
        </nav>
        <img src="/images/randombanner.php"/>

        <main>
            <?=$output?>
        </main>

        <footer>
            <!-- Set the copyright year to the current year -->
            &copy; Jo's Jobs <?php echo date("Y"); ?>
        </footer>
    </body>
</html>