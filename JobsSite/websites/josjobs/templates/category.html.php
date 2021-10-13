<!-- List of categories -->
<main class="sidebar">
    <section class="left">
        <ul>
        <li><a href="/home">Home</a></li>
            <li><a href="/user/list">Users</a></li>
            <li><a href="/job/listAll">Jobs</a></li>
            <li class="current"><a href="/category/list">Categories</a></li>
            <li><a href="/enquiry/list">Enquiries</a></li>
        </ul>
    </section>

    <section class="right">
        <h1>Categories</h1>
        <a class="more" href="/category/add">Add Category</a>
        <table>
            <tr>
                <th>Name</th>
                <th></th>
            </tr>
            <?php foreach ($categories as $category) { ?>
                <tr>
                    <td><?=$category['name']?></td>
                    <td><a href="/category/delete?id=<?=$category['id']?>">Delete</a></td>
                </tr>
                <?php  
            } ?>
        </table>
    </section>
</main>