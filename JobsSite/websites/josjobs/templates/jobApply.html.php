<!-- Job application form page -->
<main class="sidebar">

    <section class="left">
        <ul>
            <?php foreach($catList as $catList) { ?>
                <li><a href="/job/list?id=<?=$catList['id']?>&location=All"><?=$catList['name']?></a></li><?php
            } ?>
        </ul>
	</section>

	<section class="right">
        <?php if (count($errors) > 0) { ?>
            <ul>
                <?php foreach ($errors as $error) { ?>
                    <li><?=$error?></li>
                <?php } ?>
            </ul>
        <?php } ?>
        <?php foreach ($job as $job) { ?>
            <h2>Apply for <?=$job['title'];?> Job</h2>

            <form action="" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="applicant[id]" value="<?=$applicant['id']?>"/>
                
                <label>Your name</label>
                <input type="text" name="applicant[name]" />

                <label>E-mail address</label>
                <input type="text" name="applicant[email]" />

                <label>Cover letter</label>
                <textarea name="applicant[details]"></textarea>

                <label>CV</label>
                <input type="file" name="cv" />

                <input type="hidden" name="applicant[jobId]" value="<?=$job['id']?>"/>

                <input type="submit" value="Apply" />

            </form>
        <?php }?>
    </section>
</main>