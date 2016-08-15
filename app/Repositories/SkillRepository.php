<?php

namespace App\Repositories;

use App\Models\Skill;

class SkillRepository extends ResourceRepository
{

    public function __construct(Skill $skill)
	{
		$this->model = $skill;
	}
}