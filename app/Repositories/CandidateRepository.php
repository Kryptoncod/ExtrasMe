<?php

namespace App\Repositories;

use App\Models\Candidate;

class CandidateRepository extends ResourceRepository
{

    public function __construct(Candidate $candidate)
	{
		$this->model = $candidate;
	}
}