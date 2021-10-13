<?php
namespace Ijdb;

class Routes implements \CSY2028\Routes {
	public function callControllerAction($route) {
		require '../database.php';

		$jokesTable = new \CSY2028\DatabaseTable($pdo, 'joke', 'id');
		$categoriesTable = new \CSY2028\DatabaseTable($pdo, 'category', 'id');

		$jokeController = new \Ijdb\Controllers\Joke($jokesTable);
		$categoryController = new \Ijdb\Controllers\Category($categoriesTable);

		if ($route == '') {
			$page = $jokeController->home();
		}
		else if ($route == 'joke/list') {
			$page = $jokeController->list();
		}
		else if ($route == 'joke/edit') {
			$page = $jokeController->edit();
		}
		else if ($route == 'joke/delete') {
			$page = $jokeController->delete();
		}
		else if ($route == 'category/list') {
			$page = $categoryController->list();
		}
		else if ($route == 'category/edit') {
			$page = $categoryController->edit();
		}
		else if ($route == 'category/delete') {
			$page = $categoryController->edit();
		}

		return $page;
	}
}