<!-- Add user page -->
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
        <h1>Add User</h1>
        <?php if (count($errors) > 0) { ?>
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?=$error?></li>
                <?php } ?>
            </ul>
        <?php } ?>
        <form action="" method="post">
        <input type="hidden" name="user[id]" value="<?=$user['id']?>"/>

        <label for="username">Username </label>
        <input type="text" id="name" name="user[username]">

        <label for="password">Password </label>
        <input type="text" id="password" name="user[password]"> 

        <br><p style="margin-top:120px">User Type:</p>
        <label for="admin">Admin</label><br>
        <input type="radio" id="admin" name="userType" value="Admin">
        
        <label for="client">Client</label><br>
        <input type="radio" id="client" name="userType" value="Client">

        <input type="submit" value="Add User">
    </form>
    </section>
	</main>