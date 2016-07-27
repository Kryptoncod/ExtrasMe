<?php

namespace App\Repositories;

use App\Models\Professional;

class ProfessionalRepository extends ResourceRepository
{

    public function __construct(Professional $professional)
	{
		$this->model = $professional;
	}
}