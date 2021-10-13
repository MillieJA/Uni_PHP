<?php
namespace Ijdb\Controllers;
class Category {
	private $categoryTable;

	public function __construct($categoryTable) {
		$this->categoryTable = $categoryTable;
    }
	
	// Function for displaying a list of categories
    public function list() {
		$categories = $this->categoryTable->findAll();

        return [
			'template' => 'category.html.php',
			'variables' => ['categories' => $categories],
			'title' => 'View Categories'
		];
	}
 
	// Function for adding a new category
    public function add($errors = []) {
		$category = null;
		return [
			'template' => 'categoryAdd.html.php',
			'variables' => ['category' => $category, 'errors' => $errors],
			'title' => 'Add Category'
		];
	}

	// Function that runs once a new category has been entered and validates the input and inserts into the database
	public function addSubmit() {

		// Validates the input
		$errors = $this->validateAdd($_POST['category']);
        $category = null;

		// Inserts into database if there are no validation errors
		if (count($errors) == 0) {

			if (isset($_POST['category'])) {
                $category = $_POST['category'];
	
				$this->categoryTable->save($category);
	
				header('location: /category/list');
		
			}
			else {
				$category = null;
                return [
                    'template' => 'categoryAdd.html.php',
                    'variables' => ['category' => $category],
                    'title' => 'Add Category'
                ];
			}
		}
		else {
			// Prints errors if there are any
            return $this->add($errors);
        }
	}

	// The function for validating the add
	public function validateAdd($category) {
		$errors = [];
		// Checking if the text input is blank
        if ($category['name'] == '') {$errors[] = 'Please enter a category name';}
        return $errors;
	}
	
	// The function for deleting a category
    public function delete() {
		$categories = $this->categoryTable->find('id', $_GET['id']);
		return [
			'template' => 'categoryDelete.html.php',
			'variables' => ['categories' => $categories],
			'title' => 'Delete Category'
		];
	}

	// Function that runs once the delete for a category has been confirmed, deleting the record from the database
	public function deleteSubmit() {
        $categories = null;
        if (isset($_POST['category'])) {
            $category = $_POST['category'];
            $this->categoryTable->delete($category['id']);
            header('location: /category/list');
        
        }
        else {
            $user = $_GET['id'];
            return [
                'template' => 'userDelete.html.php',
                'variables' => ['user' => $user],
                'title' => 'Delete User'
            ];
        }
    }
}