<!-- Displays all jobs for an admin -->
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
        <h1>All Jobs</h1>
        <a class="more" href="/job/save">Add Job</a>
        <!-- Filter Options -->
        <h2>Filter by category:</h2>
        <ul>
            <li><a href="/job/listAll">All</a></li>
            <?php foreach($categories as $category) { ?>
                <li><a href="/job/listAll?category=<?=$category['id']?>"><?=$category['name']?></a></li><?php 
            } ?>
        </ul>
        <h2>Filter by location:</h2>
        <ul>
            <li><a href="/job/listAll">All</a></li>
            <?php foreach($locations as $locList) { ?>
                <li><a href="/job/listAll?location=<?=$locList['location']?>"><?=$locList['location']?></a></li><?php 
            } ?>
        </ul>
        <h2>Filter by status:</h2>
        <ul>
            <li><a href="/job/listAll">All</a></li>
            <li><a href="/job/listAll?status=Live">Live</a></li>
            <li><a href="/job/listAll?status=Archived">Archived</a></li>
        </ul>
        <table>
            <tr>
                <th>Title</th>
                <th>Category</th>
                <th>Location</th>
                <th>Status</th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($jobs as $job) { 
                // Gets the category names for each job
                $cat = $catDatabase->find('id', $job['categoryId']); 
                foreach ($cat as $cat) {
                    $catName = $cat['name'];
                }
                $applicants = $appDatabase->findApplicants($job['id']);
                if (count($applicants) > 0) { 
                    $noApps = count($applicants);
                } 
                else {
                    $noApps = 0;
                } ?>
                <tr>
                    <td><?=$job['title']?> (<?=$noApps?>)</td>
                    <td><?=$catName?></td>
                    <td><?=$job['location']?></td>
                    <td><?=$job['status']?></td>
                    <td><a href="/job/adView?id=<?=$job['id']?>">View</a></td>
                    <!-- If a job is live, allow user to edit or archive it -->
                    <?php if ($job['status'] == "Live") { ?>
                        <td><a href="/job/save?id=<?=$job['id']?>">Edit</a></td>
                        <td><a href="/job/archive?id=<?=$job['id']?>">Archive</a></td>
                    <?php } 
                    // If the job isn't live, don't allow user to edit or archive
                    else { ?>
                        <td></td>
                        <td></td>
                    <?php } ?>
                    <td><a href="/job/delete?id=<?=$job['id']?>">Delete</a></td>
                </tr>
                <?php  
            } ?>
        </table>
    </section>
</main>