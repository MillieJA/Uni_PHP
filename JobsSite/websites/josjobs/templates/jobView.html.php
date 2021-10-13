<!-- View job page for non logged-in user -->
<main class="sidebar">

	<section class="left">
        <ul>
            <?php foreach($catList as $catList) { ?>
                <li><a href="/job/list?id=<?=$catList['id']?>&location=All"><?=$catList['name']?></a></li><?php
            } ?>
        </ul>
	</section>

	<section class="right">	
        <?php foreach($jobs as $job) { ?>
            <li><div class="details">
            <h2><?=$job['title']?></h2>
            <h3><?=$job['salary']?></h3>
            <p><?=$job['description']?></p>
            <p>Closing Date: <?=$job['closingDate']?></p>
            <p>Location: <?=$job['location']?></p>
            <a class="more" href="/job/apply?id=<?=$job['id']?>">Apply for this job</a>
            </div></li><?php
        } ?>
    </section>
</main>