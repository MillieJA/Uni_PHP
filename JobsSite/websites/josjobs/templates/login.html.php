<!-- Log in page -->
<main>
	<h1>Log In</h1>
    <?php if (count($errors) > 0) { ?>
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?=$error?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    <form action="" method="POST">
        <input type="hidden" name="user[id]" value="<?=$user['id']?>"/>
        <input type="hidden" name="user[userType]" value="<?=$user['userType']?>"/>

        <label for="username">Username </label>
        <input type="text" id="username" name="user[username]">

        <label for="password">Password </label>
        <input type="password" id="password" name="user[password]">

        <input type="submit" value="Log In">
    </form>
</main>