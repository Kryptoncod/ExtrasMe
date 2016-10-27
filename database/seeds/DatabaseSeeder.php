<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$confirmation_code = str_random(30);

		DB::table('users')->insert([
			'email' => 'Virginie.BROSEHERBINET@ehl.ch',
			'password' => bcrypt('ehlextrasme'),
			'type' => 1,
			'confirmation_code' => $confirmation_code,
		]);
		

		DB::table('professionals')->delete();

		DB::table('professionals')->insert([
			'company_name' => 'Ecole Hoteliere de lausanne',
			'category' => 'Ecole',
			'first_name' => 'Virginie',
			'last_name' => 'Brose Herbinet',
			'phone' => '+41 21 785 16 24',
			'zipcode' => 1000,
			'state' => 'Vaud',
			'country' => 'Suisse',
			'city' => 'Lausanne',
			'address' => 'Route de Cojonnex 18',
			'credit' => 250,
			'user_id' => 19,
			'created_at' => Carbon::now(),
			'updated_at' => Carbon::now(),
		]);
		

		/*DB::table('students')->delete();

		for($i = 0; $i < 5; ++$i)
		{
			DB::table('students')->insert([
				'last_name' => $i,
				'first_name' => 'Nom',
				'nationality' => 'French',
				'school_year' => 'BOSC 2',
				'phone' => '097398472',
				'gender' => 0,
				'birthdate' => Carbon::createFromDate(null, rand(1, 12), rand(1, 28)),
				'zipcode' => 75007,
				'state' => 'Ile-De-France',
				'country' => 'France',
				'address' => '31 avenue Victor Hugo',
				'user_id' => $i+1,
				'group' => 1,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			]);
		}

		DB::table('dashboards')->delete();

		for($i = 0; $i < 5; ++$i)
		{
			DB::table('dashboards')->insert([
				'total_earned' => 0,
				'total_hours' => 0,
				'numbers_extras' => 0,
				'numbers_establishement' => 0,
				'level' => 0,
				'student_id' => $i+1,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			]);
		}

		DB::table('professionals')->delete();

		for($i = 5; $i < 10; ++$i)
		{
			DB::table('professionals')->insert([
				'company_name' => 'Nom '.$i,
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
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
			]);
		}

		DB::table('extras')->delete();

		for($i = 0; $i < 10; $i++)
		{
			$typeArray = Config::get('international.last_minute_types');
			$type = $typeArray[rand(0,9)];

			$languageArray = Config::get('international.language');
			$language = $languageArray[rand(0,1)];
			
			DB::table('extras')->insert([
				'broadcast' => rand(0,1),
				'type' => $type,
				'date_start' => Carbon::createFromDate(2016, rand(10, 11), rand(18, 28)),
				'date_start_time' => Carbon::createFromTime(rand(0, 23), rand(0, 59), null),
				'date_finish' => Carbon::createFromDate(2016, 12, rand(1, 28)),
				'date_finish_time' => Carbon::createFromTime(rand(0, 23), rand(0, 59), null),
				'duration' => rand(1,10),
				'number_persons' => rand(1, 5),
				'salary' => rand(9, 89),
				'language' => $language,
				'benefits' => 'Benefits' . $i . ' Lorem ipsum dolor sit amet, consectetur adipisicing elit',
				'requirements' => 'Requirements' . $i . ' Lorem ipsum dolor sit amet, consectetur adipisicing elit',
				'informations' => 'informations' . $i . ' Lorem ipsum dolor sit amet, consectetur adipisicing elit',
				'find' => 0,
				'finish' => 0,
				'professional_id' => rand(1, 5),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				]);
		}

		for($i = 0; $i < 10; $i++)
		{
			$typeArray = Config::get('international.last_minute_types');
			$type = $typeArray[rand(1,9)];

			$languageArray = Config::get('international.language');
			$language = $languageArray[rand(0,1)];
			
			DB::table('extras')->insert([
				'broadcast' => rand(0,1),
				'type' => $type,
				'date_start' => Carbon::createFromDate(2016, rand(10, 11), rand(18, 28)),
				'date_start_time' => Carbon::createFromTime(rand(0, 23), rand(0, 59), null),
				'date_finish' => Carbon::createFromDate(2016, 12, rand(1, 28)),
				'date_finish_time' => Carbon::createFromTime(rand(0, 23), rand(0, 59), null),
				'duration' => rand(1,10),
				'number_persons' => rand(1, 5),
				'salary' => rand(9, 89),
				'language' => $language,
				'benefits' => 'Benefits' . $i . ' Lorem ipsum dolor sit amet, consectetur adipisicing elit',
				'requirements' => 'Requirements' . $i . ' Lorem ipsum dolor sit amet, consectetur adipisicing elit',
				'informations' => 'informations' . $i . ' Lorem ipsum dolor sit amet, consectetur adipisicing elit',
				'find' => 1,
				'finish' => 0,
				'professional_id' => rand(1, 5),
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				]);
		}

		DB::table('extras_students')->delete();

		for($i = 10; $i < 20; $i++)
		{
			
			DB::table('extras_students')->insert([
				'extra_id' => $i,
				'student_id' => rand(1, 5),
				'rate' => 0,
				'doing' => 1,
				'created_at' => Carbon::now(),
				'updated_at' => Carbon::now(),
				]);
		}*/
    }
}
