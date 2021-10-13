<!-- Admin view job page -->
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
        <?php foreach($jobs as $job) {
            if ($job['clientId'] == 0) {
                $clientName = "adminMain";
            }
            else {
                $client = $userDatabase->findClient($job['clientId']); 
                foreach ($client as $client) {
                    $clientName = $client['username'];
                }
            } ?>
            
            <li><div class="details">
            <h2><?=$job['title']?></h2>
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
            <!-- Only display client name if it not null. If it is null then it was added by an admin user -->
            <?php if ($job['clientId'] != "NULL") { ?>
                <p>Client: <?=$clientName?></p>
            <?php } ?>
            <?php if ($job['status'] == "Live") { ?>
                <a href="/job/clSave?id=<?=$job['id']?>">Edit this job</a>
                <a href="/job/clArchive?id=<?=$job['id']?>">Archive this job</a>
            <?php } ?>
            <a href="/job/delete?id=<?=$job['id']?>">Delete this job</a>
            </div></li><?php
        } ?>
    </section>
</main>