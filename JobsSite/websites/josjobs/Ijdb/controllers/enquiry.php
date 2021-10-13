<?php
namespace Ijdb\Controllers;
class Enquiry {
	private $enquiryTable;

	public function __construct($enquiryTable, $userTable, $categoryTable) {
		$this->enquiryTable = $enquiryTable;
		$this->userTable = $userTable;
		$this->categoryTable = $categoryTable;
	}

	// Displays the contact form for a non-logged in user 
	public function enquiry($errors = []) {
		$enquiry = false;
        return [
			'template' => 'enquiry.html.php',
			'variables' => ['enquiry' => $enquiry, 'errors' => $errors],
			'title' => 'Contact Us'
		];
	}

	// Lists all enquiries for the website admin
	public function list() {
		// Checks whether filtering has been applied
		if (!isset($_GET['status'])) {
			$enquiries = $this->enquiryTable->findAll();
		}
		else if (isset($_GET['status'])) {
			$enquiries = $this->enquiryTable->find('status', $_GET['status']);
		}

        return [
			'template' => 'enquiryList.html.php',
			'variables' => ['enquiries' => $enquiries],
			'title' => 'View Enquiries'
		];
	}

	// Function for displaying an enquiry for an admin
    public function view() {
		$enquiries = $this->enquiryTable->find('id', $_GET['id']);

        return [
			'template' => 'enquiryView.html.php',
			'variables' => ['enquiries' => $enquiries, 'userDatabase' => $this->userTable],
			'title' => 'View Enquiry'
		];
	}

	// Function for an admin to mark an enquiry as completed
	public function complete() {
		$enquiries = $this->enquiryTable->find('id', $_GET['id']);
		return [
			'template' => 'enquiryComplete.html.php',
			'variables' => ['enquiries' => $enquiries],
			'title' => 'Complete Enquiry'
		];
	}

	// The update function once the completion has been confirmed
	public function completeSubmit() {
        $enquiry = null;
		if (isset($_POST['enquiry'])) {
			$enquiry = $_POST['enquiry'];
			$enquiry['status'] = "Completed";
			// Updates the enquiry to show the user id of who completed it
			$enquiry['completedBy'] = $_SESSION['loggedin'];

			$this->enquiryTable->save($enquiry);

			header('location: /enquiry/list');
	
		}
		else {
			$enquiry = null;
			return [
				'template' => 'enquiryComplete.html.php',
				'variables' => ['enquiry' => $enquiry],
				'title' => 'Complete Enquiry'
			];
		}
		
	}

	// Function for adding a new enquiry
	public function add() {
		// Validates the input
		$errors = $this->validateEnquiry($_POST['enquiry']);
		$enquiry = null;

		// If there are no validation errors, inserts record into database
		if (count($errors) == 0) {
			if (isset($_POST['enquiry'])) {

				$date = new \DateTime();

				$enquiry = $_POST['enquiry'];
				$enquiry['enquiryDate'] = $date->format('Y-m-d');

				$this->enquiryTable->insert($enquiry);

				header('location: /enquiry/submitted');
			}
			else {
				$enquiry = false;
				return [
					'template' => 'enquiry.html.php',
					'variables' => ['enquiry' => $enquiry],
					'title' => 'Contact Us'
				];
			}
		}
		else {
            return $this->enquiry($errors);
        }
	}

	// Function which validates the input and make sure there are no empty fields
	public function validateEnquiry($enquiry) {
        $errors = [];
        if ($enquiry['name'] == '') {$errors[] = 'Please enter your name';}
		if ($enquiry['email'] == '') {$errors[] = 'Please enter your email';}
		if ($enquiry['phone'] == '') {$errors[] = 'Please enter your phone number';}
		if ($enquiry['enquiryText'] == '') {$errors[] = 'Please enter your question';}
        return $errors;
	}

	// Displays a confirmation screen for the user to show their enquiry has been submitted
	public function submitted() {
		$catList = $this->categoryTable->findAll('category');
        return [
			'template' => 'enquirySubmitted.html.php',
			'variables' => ['catList' => $catList],
			'title' => 'Contact Us'
		];
	}
}