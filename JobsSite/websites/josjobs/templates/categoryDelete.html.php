<!-- Category delete confirmation -->
<main class="sidebar">
	<section class="left">
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/user/list">Users</a></li>
            <li><a href="/job/listAll">Jobs</a></li>
            <li class="current"><a href="/category/list">Categories</a></li>
            <li><a href="/enquiry/list">Enquiries</a></li>
        </ul>
	</section>

	<section class="right">
        <?php foreach ($categories as $category) { ?>
            <h2>Are you sure you want to delete <?=$category['name']?>?</h2>
            <form action="" method="post">
                <input type="hidden" name="category[id]" value="<?=$category['id']?>"/>
                <input type="hidden" name="category[name]" value="<?=$category['name']?>"/>
                <input type="submit" value="Yes">
            </form>
            <a class="more" href="/category/list">No, go back.</a>
        <?php } ?>
	</section>
</main>