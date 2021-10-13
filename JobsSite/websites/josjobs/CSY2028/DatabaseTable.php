<?php
namespace CSY2028;
class DatabaseTable {
	private $pdo;
	private $table;
	private $primaryKey;

	public function __construct($pdo, $table, $primaryKey) {
		$this->pdo = $pdo;
		$this->table = $table;
		$this->primaryKey = $primaryKey;
	}

	// All queries used for the database
	// Find all records with a specific value
	public function find($field, $value) {
		$stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE ' . $field . ' = :value');

		$criteria = [
			'value' => $value
		];
		$stmt->execute($criteria);

		return $stmt->fetchAll();
	}

	public function findClient($value) {
		$stmt = $this->pdo->prepare('SELECT * FROM user WHERE id = :value');

		$criteria = [
			'value' => $value
		];
		$stmt->execute($criteria);

		return $stmt->fetchAll();
	}

	// Find applicants for the selected job
	public function findApplicants($value) {
		$stmt = $this->pdo->prepare('SELECT * FROM applicant WHERE jobId = :value');

		$criteria = [
			'value' => $value
		];
		$stmt->execute($criteria);

		return $stmt->fetchAll();
	}

	// Find the 10 soonest closing jobs
	public function tenClosing() {
		$stmt = $this->pdo->prepare('SELECT * FROM job WHERE closingDate > :date ORDER BY closingDate ASC LIMIT 10');

		$criteria = [
			'date' => date("Y/m/d")
		];

		$stmt->execute($criteria);

		return $stmt->fetchAll();
	}

	// Find all records in a table
	public function findAll() {
		$stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table);

		$stmt->execute();

		return $stmt->fetchAll();
	}

	// Find all jobs within the selected category
	public function findByCat($id) {
		$stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE categoryId = ' . $id . ' AND closingDate > :date AND status = "Live"');

		$criteria = [
			'date' => date("Y/m/d")
		];

		$stmt->execute($criteria);

		return $stmt->fetchAll();
	}

	// Find jobs by their location
	public function findByLoc($id, $location) {
		$stmt = $this->pdo->prepare('SELECT * FROM ' . $this->table . ' WHERE location = "' . $location . '" AND categoryId = ' . $id . ' AND closingDate > :date AND status = "Live"');

		$criteria = [
			'date' => date("Y/m/d")
		];

		$stmt->execute($criteria);

		return $stmt->fetchAll();
	}

	// Get a list of all clients
	public function findClients() {
		$stmt = $this->pdo->prepare('SELECT * FROM user WHERE userType = "Client"');

		$stmt->execute();

		return $stmt->fetchAll();
	}

	// Get a list of all locations for all jobs
	public function findAllLocations() {
		$stmt = $this->pdo->prepare('SELECT DISTINCT location FROM job WHERE closingDate > :date');

		$criteria = [
			'date' => date("Y/m/d")
		];

		$stmt->execute($criteria);

		return $stmt->fetchAll();
	}

	// Get a list of all locations for jobs in the selected category
	public function findLocations($id) {
		$stmt = $this->pdo->prepare('SELECT DISTINCT location FROM job WHERE categoryId = ' . $id . ' AND closingDate > :date AND status = "Live"');

		$criteria = [
			'date' => date("Y/m/d")
		];

		$stmt->execute($criteria);

		return $stmt->fetchAll();
	}

	// Delete record from database
	public function delete($id) {
		$stmt = $this->pdo->prepare('DELETE FROM ' . $this->table . ' WHERE ' . $this->primaryKey . ' = :id');
		$criteria = [
			'id' => $id
		];
		$stmt->execute($criteria);
	}

	// Insert record into database
	public function insert($record) {
		$keys = array_keys($record);

		$values = implode(', ', $keys);
		$valuesWithColon = implode(', :', $keys);

		$query = 'INSERT INTO ' . $this->table . ' (' . $values . ') VALUES (:' . $valuesWithColon . ')';

		$stmt = $this->pdo->prepare($query);

		$stmt->execute($record);
	}

	// Insert Applicant record into database
	public function insertApplicant($record) {
		$keys = array_keys($record);

		$values = implode(', ', $keys);
		$valuesWithColon = implode(', :', $keys);

		$query = 'INSERT INTO applicant (' . $values . ') VALUES (:' . $valuesWithColon . ')';

		$stmt = $this->pdo->prepare($query);

		$stmt->execute($record);
	}

	// Update existing record in the database
	public function update($record) {

		$query = 'UPDATE ' . $this->table . ' SET ';

		$parameters = [];
		foreach ($record as $key => $value) {
			   $parameters[] = $key . ' = :' .$key;
		}

		$query .= implode(', ', $parameters);
		$query .= ' WHERE ' . $this->primaryKey . ' = :primaryKey';

		$record['primaryKey'] = $record[$this->primaryKey];

		$stmt = $this->pdo->prepare($query);

		$stmt->execute($record);
	}

	// Will insert or update record in database
	public function save($record) {
		try {
			$this->insert($record);
		}
		catch (\Exception $e) {
			$this->update($record);
		}
	}

	// Sets job to archived
	public function archiveJob() 
	{
		$stmt = $this->pdo->prepare('UPDATE job SET status = "archived" WHERE job_id = :job_id');
		$stmt->execute($_POST);
	}
	
}