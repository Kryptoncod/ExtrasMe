<?php

use Illuminate\Database\Seeder;

class ProfessionalTableSeeder extends Seeder {

    public function run()
	{
		DB::table('professionals')->delete();

		for($i = 5; $i < 10; ++$i)
		{
			DB::table('professionals')->insert([
				'company_name' => 'Nom'.$i,
				'category' => 'hotel',
				'first_name' => 'Jean',
				'last_name' => 'Dupont',
				'phone' => '0290942',
				'zipcode' => 75007,
				'state' => 'Ile-De-France',
				'country' => 'France',
				'address' => '31 avenue Victor Hugo',
				'credit' => 100,
				'user_id' => $i+1,
			]);
		}
	}
}