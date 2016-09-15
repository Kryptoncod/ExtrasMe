<?php

namespace App\Repositories;

use App\Models\Invoice;

class InvoiceRepository extends ResourceRepository
{

    public function __construct(Invoice $invoice)
	{
		$this->model = $invoice;
	}
}