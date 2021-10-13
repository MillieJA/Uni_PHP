<!-- Delete job confirmation page -->
<main class="sidebar">
    <section class="left">
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/user/list">Users</a></li>
            <li class="current"><a href="/job/listAll">Jobs</a></li>
            <li><a href="/category/list">Categories</a></li>
            <li><a href="/enquiry/list">Enquiries</a></li>
        </ul>
    </section>

	<section class="right">	
    <section class="right">
        <?php foreach ($jobs as $job) { ?>
            <h2>Are you sure you want to delete <?=$job['title']?>?</h2>
            <form action="" method="post">
                <input type="hidden" name="job[id]" value="<?=$job['id']?>"/>
                <input type="submit" value="Yes">
            </form>
            <a class="more" href="/job/listAll">No, go back.</a>
        <?php } ?>
	</section>
    </section>
</main>