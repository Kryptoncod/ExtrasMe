<?php

namespace App\Repositories;

use App\Models\Competence;

class SkillRepository extends ResourceRepository
{

    public function __construct(Competence $competence)
	{
		$this->model = $competence;
	}
}