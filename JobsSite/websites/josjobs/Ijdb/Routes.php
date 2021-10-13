<?php
namespace Ijdb;
class Routes implements \CSY2028\Routes {
	private $categoryTable;

	public function getRoutes() {
		require '../database.php';

		$this->applicantTable = new \CSY2028\DatabaseTable($pdo, 'applicant', 'id');
		$this->categoryTable = new \CSY2028\DatabaseTable($pdo, 'category', 'id');
		$jobTable = new \CSY2028\DatabaseTable($pdo, 'job', 'id');
		$this->userTable = new \CSY2028\DatabaseTable($pdo, 'user', 'id');
		$enquiryTable = new \CSY2028\DatabaseTable($pdo, 'enquiry', 'id');
	
		$applicantController = new \Ijdb\Controllers\Applicant($this->applicantTable);
		$categoryController = new \Ijdb\Controllers\Category($this->categoryTable);
		$jobController = new \Ijdb\Controllers\Job($jobTable, $this->categoryTable, $this->applicantTable, $this->userTable);
		$userController = new \Ijdb\Controllers\User($this->userTable);
		$enquiryController = new \Ijdb\Controllers\Enquiry($enquiryTable, $this->userTable, $this->categoryTable);

		$routes = [
			// Home Routes
			'' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'home'
				],
			],

			'home' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'home'
				],
			],

			// Nav Routes
			'about' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'about'
				],
			],

			'faq' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'faq'
				],
			],

			// Login/Logout Routes
			'login' => [
				'GET' => [
					'controller' => $userController,
					'function' => 'login'
				],
				'POST' => [
					'controller' => $userController,
					'function' => 'loginSubmit'
				]
			],

			'logout' => [
				'GET' => [
					'controller' => $userController,
					'function' => 'logout'
				],
				'login' => true
			],

			// User Routes
			'user/list' => [
				'GET' => [
					'controller' => $userController,
					'function' => 'list'
				],
				'login' => true
			],

			'user/add' => [
				'GET' => [
					'controller' => $userController,
					'function' => 'add'
				],
				'POST' => [
					'controller' => $userController,
					'function' => 'addSubmit'
				],
				'login' => true
			],

			'user/delete' => [
				'GET' => [
					'controller' => $userController,
					'function' => 'delete'
				],
				'POST' => [
					'controller' => $userController,
					'function' => 'deleteSubmit'
				],
				'login' => true
			],

			'user/edit' => [
				'GET' => [
					'controller' => $userController,
					'function' => 'edit'
				],
				'POST' => [
					'controller' => $userController,
					'function' => 'editSubmit'
				],
				'login' => true
			],

			// Enquiry Routes
			'enquiry' => [
				'GET' => [
					'controller' => $enquiryController,
					'function' => 'enquiry'
				],
				'POST' => [
					'controller' => $enquiryController,
					'function' => 'add'
				]
			],

			'enquiry/view' => [
				'GET' => [
					'controller' => $enquiryController,
					'function' => 'view'
				],
				'login' => true
			],

			'enquiry/list' => [
				'GET' => [
					'controller' => $enquiryController,
					'function' => 'list'
				],
				'login' => true
			],

			'enquiry/complete' => [
				'GET' => [
					'controller' => $enquiryController,
					'function' => 'complete'
				],
				'POST' => [
					'controller' => $enquiryController,
					'function' => 'completeSubmit'
				],
				'login' => true
			],

			'enquiry/submitted' => [
				'GET' => [
					'controller' => $enquiryController,
					'function' => 'submitted'
				],
			],

			// Category Routes
			'category/list' => [
				'GET' => [
					'controller' => $categoryController,
					'function' => 'list'
				],
				'login' => true
			],

			'category/add' => [
				'GET' => [
					'controller' => $categoryController,
					'function' => 'add'
				],
				'POST' => [
					'controller' => $categoryController,
					'function' => 'addSubmit'
				],
				'login' => true
			],

			'category/delete' => [
				'GET' => [
					'controller' => $categoryController,
					'function' => 'delete'
				],
				'POST' => [
					'controller' => $categoryController,
					'function' => 'deleteSubmit'
				],
				'login' => true
			],

			// Job Routes
			'job/list' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'list'
				],
			],

			'job/listAll' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'listAll'
				],
				'login' => true
			],

			'job/clientJob' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'clientJob'
				],
				'login' => true
			],

			'job/view' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'view'
				]
			],

			'job/apply' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'apply'
				],
				'POST' => [
					'controller' => $jobController,
					'function' => 'applySubmitted'
				]
			],

			'job/applySubmittedConf' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'applySubmittedConf'
				],
			],

			'job/save' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'save'
				],
				'POST' => [
					'controller' => $jobController,
					'function' => 'saveSubmit'
				],
				'login' => true
			],

			'job/clSave' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'clSave'
				],
				'POST' => [
					'controller' => $jobController,
					'function' => 'clSaveSubmit'
				],
				'login' => true
			],

			'job/adView' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'adView'
				]
			],

			'job/clView' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'clView'
				]
			],

			'job/archive' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'archive'
				],
				'POST' => [
					'controller' => $jobController,
					'function' => 'archiveSubmit'
				],
				'login' => true
			],

			'job/clArchive' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'clArchive'
				],
				'POST' => [
					'controller' => $jobController,
					'function' => 'clArchiveSubmit'
				],
				'login' => true
			],

			'job/delete' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'delete'
				],
				'POST' => [
					'controller' => $jobController,
					'function' => 'deleteSubmit'
				],
				'login' => true
			],

			'job/clDelete' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'clDelete'
				],
				'POST' => [
					'controller' => $jobController,
					'function' => 'clDeleteSubmit'
				],
				'login' => true
			],

			'job/viewApplicants' => [
				'GET' => [
					'controller' => $jobController,
					'function' => 'viewApplicants'
				],
				'login' => true
			],
		];

		return $routes;

	}

	public function getLayoutVariables() {
		return [
			'categories' => $this->categoryTable->findAll('category')
		];
	}
}