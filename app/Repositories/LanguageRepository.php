<?php

namespace App\Repositories;

use App\Models\Language;

class LanguageRepository extends ResourceRepository
{

    public function __construct(Language $language)
	{
		$this->model = $language;
	}
}