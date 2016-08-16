<?php

namespace App\Repositories;

use App\Models\Dashboard;

class DashboardRepository extends ResourceRepository
{
    public function __construct(Dashboard $dashboard)
	{
		$this->model = $dashboard;
	}
}