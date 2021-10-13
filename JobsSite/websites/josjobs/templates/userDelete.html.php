<!-- Delete user confirmation -->
<main class="sidebar">
	<section class="left">
    <ul>
            <li><a href="/home">Home</a></li>
            <li class="current"><a href="/user/list">Users</a></li>
            <li><a href="/job/listAll">Jobs</a></li>
            <li><a href="/category/list">Categories</a></li>
            <li><a href="/enquiry/list">Enquiries</a></li>
        </ul>
	</section>

	<section class="right">
        <?php foreach ($users as $user) { ?>
            <h2>Are you sure you want to delete <?=$user['username']?>?</h2>
            <form action="" method="post">
                <input type="hidden" name="user[id]" value="<?=$user['id']?>"/>
                <input type="hidden" name="user[username]" value="<?=$user['username']?>"/>
                <input type="hidden" name="user[password]" value="<?=$user['password']?>"/>
                <input type="hidden" name="user[userType]" value="<?=$user['userType']?>"/>
                <input type="submit" value="Yes">
            </form>
            <a class="more" href="/user/list">No, go back.</a>
        <?php } ?>
	</section>
</main>