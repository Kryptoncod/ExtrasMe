<?php

namespace App\Repositories;

use App\Models\Cv;

class CvRepository extends ResourceRepository
{

    public function __construct(Cv $cv)
	{
		$this->model = $cv;
	}
}