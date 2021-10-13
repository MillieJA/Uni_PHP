<!-- View enquiry page -->
<main class="sidebar">
    <section class="left">
        <ul>
            <li><a href="/home">Home</a></li>
            <li><a href="/user/list">Users</a></li>
            <li><a href="/job/listAll">Jobs</a></li>
            <li><a href="/category/list">Categories</a></li>
            <li class="current"><a href="/enquiry/list">Enquiries</a></li>
        </ul>
    </section>

    <section class="right">
        <h1>Enquiry</h1>
        <?php foreach ($enquiries as $enquiry) { ?>
            <li><div class="details">
            <?php if ($enquiry['completedBy'] == '0') {
                $userName = "adminMain";
            }
            else {
                // Find username of who completed the enquiry
                $compBy = $userDatabase->find('id', $enquiry['completedBy']); 
                foreach ($compBy as $compUser) {
                    $userName = $compUser['username'];

                } 
            }?>
            <h2><?=$enquiry['name']?></h2>
            <h3><?=$enquiry['enquiryText']?></h3>
            <p>Email: <?=$enquiry['email']?></p>
            <p>Phone: <?=$enquiry['phone']?></p>
            <p>Submitted on: <?=$enquiry['enquiryDate']?></p>
            <p>Status: <?=$enquiry['status']?></p>
            <?php if ($enquiry['status'] == "Live") { ?>
                <a href="/enquiry/complete?id=<?=$enquiry['id']?>">Complete</a>
            <?php } 
            else { ?>
                <p>Completed by: <?=$userName?></p>
            <?php } ?>
            </div></li><?php
        } ?>
    </section>
</main>