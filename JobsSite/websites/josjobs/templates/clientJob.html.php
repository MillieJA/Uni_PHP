<!-- List of clients' jobs -->
<main class="sidebar">
    <section class="left">
        <ul>
            <li><a href="/home">Home</a></li>
            <li class="current"><a href="/job/clientJob">Jobs</a></li>
        </ul>
    </section>

    <section class="right">
        <h1>All Jobs</h1>
        <a class="more" href="/job/clSave">Add Job</a>
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
                $cat = $catDatabase->find('id', $job['categoryId']); 
                foreach ($cat as $cat) {
                    $catName = $cat['name'];
                }
                // Find number of applicants for each job
                $applicants = $appDatabase->findApplicants($job['id']);
                if (count($applicants) > 0) { 
                    $noApps = count($applicants);
                } 
                else {
                    $noApps = 0;
                } ?>
                <tr>
                    <!-- Display number of applicants next to the job title -->
                    <td><?=$job['title']?> (<?=$noApps?>)</td>
                    <td><?=$catName?></td>
                    <td><?=$job['location']?></td>
                    <td><?=$job['status']?></td>
                    <td><a href="/job/clView?id=<?=$job['id']?>">View</a></td>
                    <?php if ($job['status'] == "Live") { ?>
                        <td><a href="/job/clSave?id=<?=$job['id']?>">Edit</a></td>
                        <td><a href="/job/clArchive?id=<?=$job['id']?>">Archive</a></td>
                    <?php } 
                    else { ?>
                        <td> </td>
                        <td> </td>
                    <?php } ?>
                    <td><a href="/job/clDelete?id=<?=$job['id']?>">Delete</a></td>
                </tr>
                <?php  
            } ?>
        </table>
    </section>
</main>