<?php
namespace Ijdb\Controllers;
class Applicant {
	private $applicantTable;

	public function __construct($applicantTable) {
		$this->applicantTable = $applicantTable;
	}
}