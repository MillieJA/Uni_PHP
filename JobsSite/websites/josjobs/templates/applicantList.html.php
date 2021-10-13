<!-- List of applicants for the selected job -->
<main class="sidebar">
    <section class="left">
        <ul>
            <?php if (isset ($_SESSION['admin']) && $_SESSION['admin'] == true) { ?>
                <li><a href="/home">Home</a></li>
                <li><a href="/user/list">Users</a></li>
                <li class="current"><a href="/job/listAll">Jobs</a></li>
                <li><a href="/category/list">Categories</a></li>
                <li><a href="/enquiry/list">Enquiries</a></li>
            <?php } 
            else { ?>
                <li><a href="/home">Home</a></li>
                <li class="current"><a href="/job/clientJob">Jobs</a></li>
            <?php } ?>
        </ul>
    </section>

    <section class="right">
        <h1>Applicants</h1>
        <table>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Cover Letter</th>
                <th>CV</th>
            </tr>
            <?php foreach ($applicants as $applicant) { ?>
                <tr>
                    <td><?=$applicant['name']?></td>
                    <td><?=$applicant['email']?></td>
                    <td><?=$applicant['details']?></td>
                    <td><?=$applicant['cv']?></td>
                </tr>
                <?php  
            } ?>
        </table>
    </section>
</main>