<?php

namespace App\Repositories;

use App\Models\Education;

class EducationRepository extends ResourceRepository
{

    public function __construct(Education $education)
	{
		$this->model = $education;
	}
}