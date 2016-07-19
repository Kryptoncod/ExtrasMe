<?php

namespace App\Repositories;

use App\Extra;

class ExtraRepository extends ResourceRepository
{

    public function __construct(Extra $extra)
	{
		$this->model = $extra;
	}

	public function getPaginate($n)
	{
		return $this->model->with('professional')
		->orderBy('extras.created_at', 'desc')
		->paginate($n);
	}
}