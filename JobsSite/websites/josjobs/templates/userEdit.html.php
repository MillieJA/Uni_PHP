<!-- Edit user page -->
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
        <h1>Edit User</h1>
        <?php if (count($errors) > 0) { ?>
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?=$error?></li>
                <?php } ?>
            </ul>
        <?php } 
        foreach ($users as $user) { ?>
            <form action="" method="post">
                <input type="hidden" name="user[id]" value="<?=$user['id']?>"/>

                <label for="username">Username </label>
                <input type="text" id="name" name="user[username]" value="<?=$user['username']?>">

                <input type="hidden" id="password" name="user[password]" value="<?=$user['password']?>"> 

                <br><p style="margin-top:120px">User Type:</p>
                <!-- Set selected option based on user being edited -->
                <?php if ($user['userType'] == "Admin") { ?>
                    <label for="admin">Admin</label><br>
                    <input type="radio" id="admin" name="userType" value="Admin" checked="checked">
                    <label for="client">Client</label><br>
                    <input type="radio" id="client" name="userType" value="Client">
                <?php }
                else if ($user['userType'] == "Client") { ?>
                    <label for="admin">Admin</label><br>
                    <input type="radio" id="admin" name="userType" value="Admin">
                    <label for="client">Client</label><br>
                    <input type="radio" id="client" name="userType" value="Client" checked="checked">
                <?php } ?>
                <input type="submit" value="Edit User">
            </form>
        <?php } ?>
    </section>
	</main>