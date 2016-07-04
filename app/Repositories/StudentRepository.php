<?php

namespace App\Repositories;

use App\Student;

class StudentRepository extends ResourceRepository
{

    public function __construct(Student $student)
	{
		$this->model = $student;
	}
}