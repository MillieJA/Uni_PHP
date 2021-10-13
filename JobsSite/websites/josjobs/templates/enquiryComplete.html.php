<!-- Complete enquiry confirmation page -->
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
        <?php foreach ($enquiries as $enquiry) { ?>
            <h2>Are you sure you want to complete this enquiry?</h2>
            <form action="" method="post">
                <input type="hidden" name="enquiry[id]" value="<?=$enquiry['id']?>"/>
                <input type="hidden" name="enquiry[enquiryDate]" value="<?=$enquiry['enquiryDate']?>"/>
                <input type="hidden" name="enquiry[status]" value="<?=$enquiry['status']?>"/>
                <input type="hidden" name="enquiry[completedBy]" value="<?=$enquiry['completedBy']?>"/>

                <label for="name">Name </label>
                <input type="text" id="name" name="enquiry[name]" value="<?=$enquiry['name']?>" readonly="readonly">

                <label for="email">Email </label>
                <input type="text" id="email" name="enquiry[email]" value="<?=$enquiry['email']?>" readonly="readonly">

                <label for="phone">Phone </label>
                <input type="text" id="phone" name="enquiry[phone]" value="<?=$enquiry['phone']?>" readonly="readonly">	

                <label for="enquiry_text">Enquiry </label>	
                <textarea id="enquiry_text" name="enquiry[enquiryText]" rows="3" cols="40" value="<?=$enquiry['enquiryText']?>" readonly="readonly"><?=$enquiry['enquiryText']?></textarea>

                <input type="submit" value="Complete">
            </form>
            <a class="more" href="/enquiry/list">No, go back.</a>
        <?php } ?>
	</section>
</main>