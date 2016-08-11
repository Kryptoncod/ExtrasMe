<?php

namespace App\Repositories;

use App\Models\Student;

class StudentRepository extends ResourceRepository
{

    public function __construct(Student $student)
	{
		$this->model = $student;
	}
	
	public function update($id, Array $inputs)
	{
		$this->getById($id)->update($inputs);
	}
}