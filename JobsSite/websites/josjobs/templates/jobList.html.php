<!-- List jobs by category for a non logged-in user -->
<main class="sidebar">
    <?php foreach($category as $category) { ?>
        <section class="left">
            <ul>
                <?php foreach($catList as $catList) { 
                    if ($catList == $category) { ?>
                        <li class="current"><a href="/job/list?id=<?=$catList['id']?>&location=All"><?=$catList['name']?></a></li><?php 
                    }
                    else { ?>
                        <li><a href="/job/list?id=<?=$catList['id']?>&location=All"><?=$catList['name']?></a></li><?php 
                    }
                } ?>
            </ul>
        </section>

        <section class="right">	
            <h1><?= $category['name']?> Jobs </h1>
            <!-- Filter Options -->
            <h2>Filter by location:</h2>
            <ul>
                <li><a href="/job/list?id=<?=$category['id']?>&location=All">All</a></li>
                <?php foreach($locations as $locList) { ?>
                    <li><a href="/job/list?id=<?=$category['id']?>&location=<?=$locList['location']?>"><?=$locList['location']?></a></li><?php 
                } ?>
            </ul>

            <table>
                <tr>
                    <th>Title</th>
                    <th>Salary</th>
                    <th>Location</th>
                    <th>Closing Date</th>
                    <th></th>
                    <th></th>
                </tr>
                
                <?php foreach ($jobs as $job) { ?>
                    <tr>
                        <td><?=$job['title']?></td>
                        <td><?=$job['salary']?></td>
                        <td><?=$job['location']?></td>
                        <td><?=$job['closingDate']?></td>
                        <td><a href="/job/view?id=<?=$job['id']?>">View</a></td>
                        <td><a href="/job/apply?id=<?=$job['id']?>">Apply</a></td>
                    </tr>
                    <?php  
                } ?>
            </table>
        </section>
    <?php } ?>
</main>