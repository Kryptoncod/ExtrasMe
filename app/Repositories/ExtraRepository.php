<?php

namespace App\Repositories;

use App\Extra;

class ExtraRepository extends ResourceRepository
{

    public function __construct(Extra $extra)
	{
		$this->model = $extra;
	}
}