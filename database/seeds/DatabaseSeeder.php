<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Dream;
use App\Address;

class DatabaseSeeder extends Seeder {

    public function run()
    {
		foreach (range(1, 10) as $i) {
			Address::create([
				'name' => 'user'.$i,
				'surname' => 'sur'.$i,
				'number' => '+39 '.rand(10, 99).' '.rand(1000000, 9999999)
			]);
		}

    }

}
