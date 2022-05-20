<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
  	$faker = Faker::create('App\User');
  	for ($i=0; $i < 1; $i++) {
  		DB::table('users')->insert([
  			'nama' 						=> $faker->name,
  			'no_induk' 				=> mt_rand(100880000, mt_getrandmax()),
  			'jk' 							=> 'L',
  			'status' 					=> 'A',
  			'status_sekolah' 	=> 'Y',
  			'email' 					=> 'admin@asi.com',
  			'password' 				=> Hash::make('password'),
  		]);
  	}
  }
}