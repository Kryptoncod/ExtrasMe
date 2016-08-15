<?php

namespace App\Repositories;

use App\Models\Experience;

class ExperienceRepository extends ResourceRepository
{
    public function __construct(Experience $experience)
	{
		$this->model = $experience;
	}
}