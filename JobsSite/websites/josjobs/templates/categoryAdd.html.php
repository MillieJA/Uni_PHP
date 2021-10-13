<!-- Add category page -->
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
        <h1>Add Category</h1>
        <?php if (count($errors) > 0) { ?>
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?=$error?></li>
                <?php } ?>
            </ul>
        <?php } ?>
        <form action="" method="post">
            <input type="hidden" name="category[id]" value="<?=$category['id']?>"/>

            <label for="name">Category Name </label>
            <input type="text" id="name" name="category[name]">

            <input type="submit" value="Submit Category">
        </form>
    </section>
</main>