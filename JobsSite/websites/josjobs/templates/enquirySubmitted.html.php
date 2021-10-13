<!-- Enquiry submit confirmation -->
<main class="sidebar">
	<section class="left">
		<ul>
			<?php foreach($catList as $catList) { ?>
				<li><a href="/job/list?id=<?=$catList['id']?>"><?=$catList['name']?></a></li><?php
			} ?>
		</ul>
	</section>

	<section class="right">
		<h2>Thanks for contacting us. We will respond to your query soon!</h2>
	</section>
</main>