<?php

namespace App\Repositories;

use App\Models\Extra;

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
		->where('find', 0)
		->paginate($n);
	}
}