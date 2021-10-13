<!-- List of enquiries page -->
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
        <h1>All Enquiries</h1>
        <h2>Filter by status:</h2>
        <ul>
            <li><a href="/enquiry/list">All</a></li>
            <li><a href="/enquiry/list?status=Live">Live</a></li>
            <li><a href="/enquiry/list?status=Completed">Completed</a></li>
        </ul>
        <table>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Status</th>
                <th></th>
            </tr>
            <?php foreach ($enquiries as $enquiry) { ?>
                <tr>
                    <td><?=$enquiry['name']?></td>
                    <td><?=$enquiry['enquiryDate']?></td>
                    <td><?=$enquiry['status']?></td>
                    <td><a href="/enquiry/view?id=<?=$enquiry['id']?>">View</a></td>
                </tr>
                <?php  
            } ?>
        </table>
    </section>
</main>