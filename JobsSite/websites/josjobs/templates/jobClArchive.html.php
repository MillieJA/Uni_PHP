<!-- Client archive job confirmation -->
<main class="sidebar">
    <section class="left">
        <ul>
            <li><a href="/home">Home</a></li>
            <li class="current"><a href="/job/clientJob">Jobs</a></li>
        </ul>
    </section>

	<section class="right">	
    <section class="right">
        <?php foreach ($jobs as $job) { ?>
            <h2>Are you sure you want to archive <?=$job['title']?>?</h2>
            <form action="" method="post">
                <input type="hidden" name="job[id]" value="<?=$job['id']?>"/>
                <input type="submit" value="Yes">
            </form>
            <a class="more" href="/job/clientJob">No, go back.</a>
        <?php } ?>
	</section>
    </section>
</main>