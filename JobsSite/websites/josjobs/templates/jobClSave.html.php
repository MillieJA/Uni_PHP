<!-- Job save (add+edit) function for a client -->
<main class="sidebar">
    <section class="left">
        <ul>
            <li><a href="/home">Home</a></li>
            <li class="current"><a href="/job/clientJob">Jobs</a></li>
        </ul>
    </section>

    <section class="right">
        <h1>Save Job</h1>

        <?php if (count($errors) > 0) { ?>
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?=$error?></li>
                <?php } ?>
            </ul>
        <?php } ?>
            <form action="" method="post">
                <input type="hidden" name="job[id]" value="<?=$job['id'] ?? ''?>"/>
                <input type="hidden" name="job[status]" value="Live"/>

                <label for="title">Title </label>
                <input type="text" id="title" name="job[title]" value="<?=$job['title'] ?? ''?>">

                <label for="jobDesc">Description </label>	
                <textarea id="jobDesc" name="job[description]" rows="3" cols="40" value="<?=$job['description'] ?? ''?>"><?=$job['description'] ?? ''?></textarea>

                <label for="salary">Salary </label>
                <input type="text" id="salary" name="job[salary]" value="<?=$job['salary'] ?? ''?>">

                <label for="closingDate">Closing Date </label>
                <input type="text" id="closingDate" name="job[closingDate]" placeholder="YYYY-MM-DD" value="<?=$job['closingDate'] ?? ''?>">

                <!-- Provide a list of categories in a dropdown -->
                <label for="categoryId">Category </label>
                <select name="categoryId" id="categoryId">
                    <?php foreach ($categories as $cat) { 
                        if ($job['categoryId'] == $cat['id']) { ?>
                            <option value="<?=$cat['id']?>" selected="selected"><?=$cat['name']?></option>
                        <?php } 
                        else { ?>
                            <option value="<?=$cat['id']?>"><?=$cat['name']?></option>
                        <?php }
                    } ?>
                </select>

                <label for="location">Location </label>
                <input type="text" id="location" name="job[location]" value="<?=$job['location'] ?? ''?>">

                <!-- Set the job client id to the logged in client id -->
                <input type="hidden" name="job[clientId]" value="<?=$_SESSION['loggedin']?>"/>

                <input type="submit" value="Submit job">
            </form>
    </section>
</main>