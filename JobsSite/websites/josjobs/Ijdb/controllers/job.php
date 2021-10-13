<?php
namespace Ijdb\Controllers;
class Job {
	private $jobTable;

	public function __construct($jobTable, $categoryTable, $userTable, $applicantTable) {
		$this->jobTable = $jobTable;
		$this->categoryTable = $categoryTable;
		$this->userTable = $userTable;
		$this->applicantTable = $applicantTable;
	}

	// Home function for each type of user
	public function home() {
		if (isset ($_SESSION['client']) && $_SESSION['client'] == true) {
			$jobs = $this->jobTable->find('clientId', $_SESSION['loggedin']);
		}
		else {
			$jobs = $this->jobTable->tenClosing();
		}
		$categories = $this->categoryTable->findAll();
        return [
			'template' => 'home.html.php',
			'variables' => ['jobs' => $jobs, 'categories' => $categories],
			'title' => 'Home'
		];
	}
	
	// Function for the about page 
	public function about() {
        return [
			'template' => 'about.html.php',
			'variables' => [],
			'title' => 'About Us'
		];
	}
	
	// Function for the FAQ's page
	public function faq() {
        return [
			'template' => 'faq.html.php',
			'variables' => [],
			'title' => 'FAQs'
		];
	}
	
	// Lists jobs for a non logged-in user
	public function list() {
		$id = $_GET['id'];
		// Checks whether filtering has been applied
		if ($_GET['location'] == "All") {
			$jobs = $this->jobTable->findByCat($id);
		}
		else {
			$jobs = $this->jobTable->findByLoc($id, $_GET['location']);
		}
		
		$catList = $this->categoryTable->findAll();
		$category = $this->categoryTable->find('id', $id);
		$locations = $this->jobTable->findLocations($id);

        return [
			'template' => 'jobList.html.php',
			'variables' => ['jobs' => $jobs, 'catList' => $catList, 'category' => $category, 'locations' => $locations, 'catDatabase' => $this->categoryTable],
			'title' => 'View Jobs'
		];
	}

	// Function to display all jobs for an admin
	public function listAll() {
		// Checks whether filtering has been applied
		if (!isset($_GET['location']) && !isset($_GET['category']) && !isset($_GET['status'])) {
			$jobs = $this->jobTable->findAll();
		}
		else if (isset($_GET['location'])) {
			$jobs = $this->jobTable->find('location', $_GET['location']);
		}
		else if (isset($_GET['category'])) {
			$jobs = $this->jobTable->find('categoryId', $_GET['category']);
		}
		else if (isset($_GET['status'])) {
			$jobs = $this->jobTable->find('status', $_GET['status']);
		}

		$categories = $this->categoryTable->findAll();
		$locations = $this->jobTable->findAllLocations();

        return [
			'template' => 'allJobs.html.php',
			'variables' => ['jobs' => $jobs, 'categories' => $categories, 'locations' => $locations, 'catDatabase' => $this->categoryTable, 'appDatabase' => $this->applicantTable],
			'title' => 'View Jobs'
		];
	}

	// Finds all jobs belonging to the logged in client
	public function clientJob() {
		$jobs = $this->jobTable->find('clientId', $_SESSION['loggedin']);
        return [
			'template' => 'clientJob.html.php',
			'variables' => ['jobs' => $jobs, 'catDatabase' => $this->categoryTable, 'appDatabase' => $this->applicantTable],
			'title' => 'View Jobs'
		];
	}
	
	// Displays a job
    public function view() {
		$jobs = $this->jobTable->find('id', $_GET['id']);
		$catList = $this->categoryTable->findAll();

        return [
			'template' => 'jobView.html.php',
			'variables' => ['jobs' => $jobs, 'catList' => $catList],
			'title' => 'View Job'
		];
	}

	// Displays a job for the admin
	public function adView() {
		$jobs = $this->jobTable->find('id', $_GET['id']);

        return [
			'template' => 'jobAdView.html.php',
			'variables' => ['jobs' => $jobs, 'userDatabase' => $this->userTable, 'appDatabase' => $this->applicantTable],
			'title' => 'View Job'
		];
	}

	// Displays a job for the client
	public function clView() {
		$jobs = $this->jobTable->find('id', $_GET['id']);

        return [
			'template' => 'jobClView.html.php',
			'variables' => ['jobs' => $jobs, 'appDatabase' => $this->applicantTable],
			'title' => 'View Job'
		];
	}
	
	// Function for the apply page
	public function apply($errors = []) {
		$job = $this->jobTable->find('id', $_GET['id']);
		$catList = $this->categoryTable->findAll();
		$applicant = null;
		return [
			'template' => 'jobApply.html.php',
			'variables' => ['job' => $job, 'applicant' => $applicant, 'errors' => $errors, 'catList' => $catList],
			'title' => 'Apply'
		];
	}

	// Function which validates the application and inserts it into the database
	public function applySubmitted() {

		// Validates the input
		$errors = $this->validateApplication($_POST['applicant']);
        $applicant = null;

		// If there are no validation errors, inserts the application into the database
		if (count($errors) == 0) {
			$job = $this->jobTable->find('id', $_GET['id']);
			$catList = $this->categoryTable->findAll();
			
			if (isset($_POST['applicant'])) {
				$applicant = $_POST['applicant'];
	
				if ($_FILES['cv']['error'] == 0) {
	
					$parts = explode('.', $_FILES['cv']['name']);
					$extension = end($parts);
					$fileName = uniqid() . '.' . $extension;
		
					move_uploaded_file($_FILES['cv']['tmp_name'], '../cvs/' . $fileName);

					$applicant['cv'] = $fileName;
	
					$this->jobTable->insertApplicant($applicant);
	
					header('location: /job/applySubmittedConf');
		
				}
				else {
					$errors[] = 'Log in incorrect';
					$applicant = false;
					return [
						'template' => 'jobApply.html.php',
						'variables' => ['job' => $job, 'applicant' => $applicant, 'catList' => $catList, 'errors' => $errors],
						'title' => 'Apply'
					];
				}
			}
			else {
				$applicant = false;
				return [
					'template' => 'jobApply.html.php',
					'variables' => ['job' => $job, 'applicant' => $applicant, 'catList' => $catList, 'errors' => $errors],
					'title' => 'Apply'
				];
			}
		}
		else {
            return $this->apply($errors);
        }
	}

	// Function which validates the application
	public function validateApplication($applicant) {
        $errors = [];
        if ($applicant['name'] == '') {$errors[] = 'Please enter your name';}
		if ($applicant['email'] == '') {$errors[] = 'Please enter your email';}
		if ($applicant['details'] == '') {$errors[] = 'Please enter your cover letter';}
        return $errors;
	}

	// Displays a confirmation message that the application has been submitted
	public function applySubmittedConf() {
		$catList = $this->categoryTable->findAll();
        return [
			'template' => 'applySubmitted.html.php',
			'variables' => ['catList' => $catList],
			'title' => 'Apply'
		];
	}
	
	// Save function used for both adding and editing jobs
	public function save($errors = []) { 
		if (isset ($_GET['id'])) {
			$result = $this->jobTable->find('id', $_GET['id']);
			$job = $result[0];
		}
		else {
			$job = false;
		}
		$categories = $this->categoryTable->findAll();
		$clients = $this->userTable->findClients();

		return [
			'template' => 'jobSave.html.php',
			'variables' => ['job' => $job, 'categories' => $categories, 'clients' => $clients, 'errors' => $errors],
			'title' => 'Save Job'
		];
	}

	// Validates the submitted job and inserts/updates it in the database
	public function saveSubmit() {
		$errors = $this->validateSave($_POST['job']);
        $job = null;

		if (count($errors) == 0) {
			
			if (isset($_POST['job'])) {
				$job = $_POST['job'];
				$job['categoryId'] = $_POST['categoryId'];
				if (isset ($_POST['clientId'])) {
					$job['clientId'] = $_POST['clientId'];
				}
				$this->jobTable->save($job);

				header('location: /job/listAll');
			}
			else {
				$job = null;
				return [
					'template' => 'jobSave.html.php',
					'variables' => ['job' => $job, 'errors' => $errors],
					'title' => 'Save Job'
				];
			}
		}
		else {
            return $this->save($errors);
		}
	}

	// Validates the inputted job
	public function validateSave($job) {
        $errors = [];
        if ($job['title'] == '') {$errors[] = 'Please enter the job title';}
		if ($job['description'] == '') {$errors[] = 'Please enter the job description';}
		if ($job['salary'] == '') {$errors[] = 'Please enter the job salary';}
		if ($job['closingDate'] == '') {$errors[] = 'Please enter the job closing date';}
		if (!isset ($_POST['categoryId'])) {$errors[] = 'Please select the job category';}
		if ($job['location'] == '') {$errors[] = 'Please enter the job location';}
        return $errors;
	}

	// Save function used for both adding and editing jobs
	public function clSave($errors = []) { 
		if (isset ($_GET['id'])) {
			$result = $this->jobTable->find('id', $_GET['id']);
			$job = $result[0];
		}
		else {
			$job = false;
		}
		$categories = $this->categoryTable->findAll();

		return [
			'template' => 'jobClSave.html.php',
			'variables' => ['job' => $job, 'categories' => $categories, 'errors' => $errors],
			'title' => 'Save Job'
		];
	}

	// Validates the submitted job and inserts/updates it in the database
	public function clSaveSubmit() {
		$errors = $this->validateClSave($_POST['job']);
        $job = null;

		if (count($errors) == 0) {
			
			if (isset($_POST['job'])) {
				$job = $_POST['job'];
				$job['categoryId'] = $_POST['categoryId'];
				$job['clientId'] = $_SESSION['loggedin'];
				$this->jobTable->save($job);

				header('location: /job/clientJob');
			}
			else {
				$job = null;
				return [
					'template' => 'jobClSave.html.php',
					'variables' => ['job' => $job, 'errors' => $errors],
					'title' => 'Save Job'
				];
			}
		}
		else {
            return $this->clSave($errors);
		}
	}

	// Validates the inputted job
	public function validateClSave($job) {
        $errors = [];
        if ($job['title'] == '') {$errors[] = 'Please enter the job title';}
		if ($job['description'] == '') {$errors[] = 'Please enter the job description';}
		if ($job['salary'] == '') {$errors[] = 'Please enter the job salary';}
		if ($job['closingDate'] == '') {$errors[] = 'Please enter the job closing date';}
		if (!isset ($_POST['categoryId'])) {$errors[] = 'Please select the job category';}
		if ($job['location'] == '') {$errors[] = 'Please enter the job location';}
        return $errors;
	}

	// Archives the job so it still exists in the database but isn't visible to users
	public function archive() { 
		if (isset ($_GET['id'])) {
			$jobs = $this->jobTable->find('id', $_GET['id']);
		}
		else {
			$jobs = false;
		}
		return [
			'template' => 'jobArchive.html.php',
			'variables' => ['jobs' => $jobs],
			'title' => 'Archive Job'
		];
	}

	// Performs the archive function on the job
	public function archiveSubmit() {
		$job = null;
		if (isset($_POST['job'])) {
			$job = $_POST['job'];
			$job['status'] = "Archived";
			$this->jobTable->save($job);

			header('location: /job/listAll');
		}
		else {
			$jobs = false;
			return [
				'template' => 'jobArchive.html.php',
				'variables' => ['jobs' => $jobs],
				'title' => 'Archive Job'
			];
		}
	}

	// Archives the job so it still exists in the database but isn't visible to users
	public function clArchive() { 
		if (isset ($_GET['id'])) {
			$jobs = $this->jobTable->find('id', $_GET['id']);
		}
		else {
			$jobs = false;
		}
		return [
			'template' => 'jobClArchive.html.php',
			'variables' => ['jobs' => $jobs],
			'title' => 'Archive Job'
		];
	}

	// Performs the archive function on the job
	public function clArchiveSubmit() {
		$job = null;
		if (isset($_POST['job'])) {
			$job = $_POST['job'];
			$job['status'] = "Archived";
			$this->jobTable->save($job);

			header('location: /job/clientJob');
		}
		else {
			$jobs = false;
			return [
				'template' => 'jobClArchive.html.php',
				'variables' => ['jobs' => $jobs],
				'title' => 'Archive Job'
			];
		}
	}

	// Deletes a job from the database
	public function delete() { 
		if (isset ($_GET['id'])) {
			$jobs = $this->jobTable->find('id', $_GET['id']);
		}
		else {
			$jobs = false;
		}
		return [
			'template' => 'jobDelete.html.php',
			'variables' => ['jobs' => $jobs],
			'title' => 'Delete Job'
		];
	}

	// Confirms the deletion of a job
	public function deleteSubmit() {
		$job = null;
		if (isset($_POST['job'])) {
			$job = $_POST['job'];
			$this->jobTable->delete($job['id']);

			header('location: /job/listAll');
		}
		else {
			$jobs = false;
			return [
				'template' => 'jobDelete.html.php',
				'variables' => ['jobs' => $jobs],
				'title' => 'Delete Job'
			];
		}
	}

	// Deletes a job from the database
	public function clDelete() { 
		if (isset ($_GET['id'])) {
			$jobs = $this->jobTable->find('id', $_GET['id']);
		}
		else {
			$jobs = false;
		}
		return [
			'template' => 'jobClDelete.html.php',
			'variables' => ['jobs' => $jobs],
			'title' => 'Delete Job'
		];
	}

	// Confirms the deletion of a job
	public function clDeleteSubmit() {
		$job = null;
		if (isset($_POST['job'])) {
			$job = $_POST['job'];
			$this->jobTable->delete($job['id']);

			header('location: /job/clientJob');
		}
		else {
			$jobs = false;
			return [
				'template' => 'jobClDelete.html.php',
				'variables' => ['jobs' => $jobs],
				'title' => 'Delete Job'
			];
		}
	}

	// Displays a list of applicants for the selected job
	public function viewApplicants() { 
		if (isset ($_GET['id'])) {
			$applicants = $this->applicantTable->findApplicants($_GET['id']);
		}
		else {
			$applicants = false;
		}
		return [
			'template' => 'applicantList.html.php',
			'variables' => ['applicants' => $applicants],
			'title' => 'View Applicants'
		];
	}
}