<!-- List of users -->
<main class="sidebar">
    <section class="left">
        <ul>
            <li><a href="/home">Home</a></li>
            <li class="current"><a href="/user/list">Users</a></li>
            <li><a href="/job/listAll">Jobs</a></li>
            <li><a href="/category/list">Categories</a></li>
            <li><a href="/enquiry/list">Enquiries</a></li>
        </ul>
    </section>

    <section class="right">
        <h1>All Users</h1>
        <a class="more" href="/user/add">Add User</a>
        <!-- Filter Options -->
        <h2>Filter by type:</h2>
        <ul>
            <li><a href="/user/list">All</a></li>
            <li><a href="/user/list?type=Admin">Admin</a></li>
            <li><a href="/user/list?type=Client">Client</a></li>
        </ul>
        <table>
            <tr>
                <th>Username</th>
                <th>Type</th>
                <th></th>
                <th></th>
            </tr>
            <?php foreach ($users as $user) { ?>
                <tr>
                    <td><?=$user['username']?></td>
                    <td><?=$user['userType']?></td>
                    <td><a href="/user/edit?id=<?=$user['id']?>">Edit</a></td>
                    <td><a href="/user/delete?id=<?=$user['id']?>">Delete</a></td>
                </tr>
                <?php  
            } ?>
        </table>
    </section>
	</main>