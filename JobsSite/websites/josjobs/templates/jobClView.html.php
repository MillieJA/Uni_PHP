<!-- View job as client -->
<main class="sidebar">
    <section class="left">
        <ul>
            <li><a href="/home">Home</a></li>
            <li class="current"><a href="/job/clientJob">Jobs</a></li>
        </ul>
    </section>

	<section class="right">	
        <?php foreach($jobs as $job) { ?>
            <li><div class="details">
            <h2><?=$job['title']?></h2>

            <!-- Get number of applicants for the selected job and display next to the view applicants button. If there are no applicants, display "no applicants". -->
            <?php $applicants = $appDatabase->findApplicants($job['id']);
            if (count($applicants) > 0) { 
                $noApps = count($applicants); ?>
                <a href="/job/viewApplicants?id=<?=$job['id']?>">View Applicants (<?=$noApps?>)</a>
            <?php } 
            else { ?>
                <p>No applicants</p>
            <?php } ?>
            <h3><?=$job['salary']?></h3>
            <p><?=$job['description']?></p>
            <p>Closing Date: <?=$job['closingDate']?></p>
            <p>Location: <?=$job['location']?></p>
            <p>Status: <?=$job['status']?></p>
            <?php if ($job['status'] == "Live") { ?>
                <a href="/job/clSave?id=<?=$job['id']?>">Edit this job</a>
                <a href="/job/clArchive?id=<?=$job['id']?>">Archive this job</a>
            <?php } ?>
            <a href="/job/clDelete?id=<?=$job['id']?>">Delete this job</a>
            </div></li><?php
        } ?>
    </section>
</main>