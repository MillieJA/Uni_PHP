<!-- Contact/enquiry form -->
<main>
	<h1>Contact Us!</h1>

    <?php if (count($errors) > 0) { ?>
        <ul>
            <?php foreach ($errors as $error) { ?>
                <li><?=$error?></li>
            <?php } ?>
        </ul>
    <?php } ?>
    
    <form action="" method="post">
        <input type="hidden" name="enquiry[id]" value="<?=$enquiry['id']?>"/>
        <input type="hidden" name="enquiry[status]" value="Live"/>
        <input type="hidden" name="enquiry[completedBy]" value="<?=$enquiry['completedBy']?>"/>

        <label for="name">Name </label>
        <input type="text" id="name" name="enquiry[name]">

        <label for="email">Email </label>
        <input type="text" id="email" name="enquiry[email]">

        <label for="phoane">Phone </label>
        <input type="text" id="phone" name="enquiry[phone]">	

        <label for="enquiry_text">Enquiry </label>	
        <textarea id="enquiry_text" name="enquiry[enquiryText]" rows="3" cols="40"><?=$enquiry['enquiryText']?></textarea>

        <input type="submit" value="Submit Enquiry">
    </form>
</main>