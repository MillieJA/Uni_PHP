<!-- Confirmation of job application being submitted -->
<main class="sidebar">
	<section class="left">
		<ul>
			<?php foreach($catList as $catList) { ?>
				<li><a href="/job/list?id=<?=$catList['id']?>&location=All"><?=$catList['name']?></a></li><?php
			} ?>
		</ul>
	</section>

	<section class="right">
		<h2>Your application has been submitted!</h2>
	</section>
</main>