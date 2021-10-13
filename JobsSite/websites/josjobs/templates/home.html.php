<!-- Homepage -->
<!-- Non logged in user homepage. Displays a list of categories and 10 jobs closing soonest. -->
<?php if (!isset($_SESSION['loggedin'])) { ?>
	<main class="home">
		<p>Welcome to Jo's Jobs, we're a recruitment agency based in Northampton. We offer a range of different office jobs. Get in touch if you'd like to list a job with us.</a></p>

		<h2>Select the type of job you are looking for:</h2>
		<ul>
			<?php foreach($categories as $category) { ?>
				<li><a href="job/list?id=<?=$category['id']?>&location=All"><?=$category['name']?></a></li><?php } ?>
		</ul>

		<h2>Jobs Closing Soon: </h2>
		<ul>
			<?php foreach($jobs as $job) { ?>
				<li><div class="details">
				<h2><a href="/job/view?id=<?=$job['id']?>"><?=$job['title']?></a></h2>
				<h3><?=$job['salary']?></h3>
				<p><?=$job['description']?></p>
				<a class="more" href="/job/apply?id=<?=$job['id']?>">Apply for this job</a>
				</div></li><hr> <?php
			} ?>
		</ul>
	</main>
<?php }
else if (isset($_SESSION['loggedin'])) {
	// Admin user homepage. Links to all pages admins have access to.
	if (isset ($_SESSION['admin']) && $_SESSION['admin'] == true) { ?>
		<main class="sidebar">
			<section class="left">
				<ul>
					<li class="current"><a href="/home">Home</a></li>
					<li><a href="/user/list">Users</a></li>
					<li><a href="/job/listAll">Jobs</a></li>
					<li><a href="/category/list">Categories</a></li>
					<li><a href="/enquiry/list">Enquiries</a></li>
				</ul>
			</section>

			<section class="right">
				<h1>Welcome Admin!</h1>
				<h2>What would you like to view?</h2>
				<ul>
					<li><a href="/user/list">Users</a></li>
					<li><a href="/job/listAll">Jobs</a></li>
					<li><a href="/category/list">Categories</a></li>
					<li><a href="/enquiry/list">Enquiries</a></li>
				</ul>
			</section>
	</main>
	<?php }
	// Client user homepage. Displays the clients jobs.
	else if (isset ($_SESSION['client']) && $_SESSION['client'] == true) { ?>
		<main class="sidebar">
			<section class="left">
				<ul>
					<li class="current"><a href="/home">Home</a></li>
					<li><a href="/job/clientJob">Jobs</a></li>
				</ul>
			</section>

			<section class="right">
				<h1>Welcome Client!</h1>
				<h2>Your jobs: </h2>
				<ul>
					<?php foreach($jobs as $job) { ?>
						<li><div class="details">
						<h2><a href="/job/clView?id=<?=$job['id']?>"><?=$job['title']?></a></h2>
						<h3><?=$job['salary']?></h3>
						<p><?=$job['description']?></p>
						<td><a href="/job/clView?id=<?=$job['id']?>">View</a></td>
						<?php if ($job['status'] == "Live") { ?>
							<td><a href="/job/clSave?id=<?=$job['id']?>">Edit</a></td>
							<td><a href="/job/clArchive?id=<?=$job['id']?>">Archive</a></td>
						<?php } 
						else { ?>
							<td></td>
						<?php } ?>
						<td><a href="/job/clDelete?id=<?=$job['id']?>">Delete</a></td>
							</div></li><hr> <?php
					} ?>
				</ul>
			</section>
		</main>
	<?php }
} ?>