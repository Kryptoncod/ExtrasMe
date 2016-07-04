<?php

namespace App\Repositories;

use App\Professional;

class ProfessionalRepository extends ResourceRepository
{

    public function __construct(Professional $professional)
	{
		$this->model = $professional;
	}
}