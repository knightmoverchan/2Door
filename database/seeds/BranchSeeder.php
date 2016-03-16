<?php

use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	DB::table('branches')->insert([	'latitude' => '10.267381',
										'longitude' => '123.844335',
										'area' => 'Cebu',
										'branch' => '2',
										'branchName' =>'Talisay City, Cebu'
				]); 

		DB::table('branches')->insert([	'latitude' => '9.959547',
										'longitude' => '123.503024',
										'area' => 'Cebu',
										'branch' => '3',
										'branchName' =>'Argao, Cebu'
				]); 

		DB::table('branches')->insert([	'latitude' => '10.825903',
										'longitude' => '123.955318',
										'area' => 'Cebu',
										'branch' => '1',
										'branchName' =>'Tabuelan, Cebu'

				]); 

		DB::table('branches')->insert([	'latitude' => '17.584973',
										'longitude' => '121.374026',
										'area' => 'Luzon',
										'branch' => '1',
										'branchName' =>'Tuguegarao City, Cagayan'
				]); 

		DB::table('branches')->insert([	'latitude' => '15.951942',
										'longitude' => '121.066409',
										'area' => 'Luzon',
										'branch' => '2',
										'branchName' =>'San Jose City, Nueva Ecija'
				]); 

		DB::table('branches')->insert([	'latitude' => '14.611346',
										'longitude' => '121.038943',
										'area' => 'Luzon',
										'branch' => '3',
										'branchName' =>'Quezon City'
				]); 

		DB::table('branches')->insert([	'latitude' => '13.417527',
										'longitude' => '123.351565',
										'area' => 'Luzon',
										'branch' => '4',
										'branchName' =>'Iriga City, Camarines Sur'
				]); 

		DB::table('branches')->insert([	'latitude' => '13.751220',
										'longitude' => '124.287827',
										'area' => 'Vigan',
										'branch' => '1',
										'branchName' =>'Vigan City'
				]); 

		DB::table('branches')->insert([	'latitude' => '13.443933',
										'longitude' => '121.930858',
										'area' => 'Marinduque',
										'branch' => '1',
										'branchName' =>'Marinduque'
				]); 

		DB::table('branches')->insert([	'latitude' => '13.360720',
										'longitude' => '120.709478',
										'area' => 'Mindoro',
										'branch' => '1',
										'branchName' =>'Abra De Ilog, Mindoro'
				]); 

		DB::table('branches')->insert([	'latitude' => '12.906015',
										'longitude' => '121.099492',
										'area' => 'Mindoro',
										'branch' => '2',
										'branchName' =>'Sablayan, Mindoro'
				]); 

		DB::table('branches')->insert([	'latitude' => '12.461210',
										'longitude' => '121.269780',
										'area' => 'Mindoro',
										'branch' => '3',
										'branchName' =>'Bulalacao, Mindoro'
				]); 

		DB::table('branches')->insert([	'latitude' => '12.305614',
										'longitude' => '123.500005',
										'area' => 'Masbate',
										'branch' => '1',
										'branchName' =>'Baleno, Masbate'
				]); 

		DB::table('branches')->insert([	'latitude' => '11.967280',
										'longitude' => '123.873540',
										'area' => 'Masbate',
										'branch' => '2',
										'branchName' =>'Cataingan, Masbate'
				]); 

		DB::table('branches')->insert([	'latitude' => '12.455846',
										'longitude' => '124.878789',
										'area' => 'Samar',
										'branch' => '1',
										'branchName' =>'San Roque, Samar'
				]); 

		DB::table('branches')->insert([	'latitude' => '11.908162',
										'longitude' => '125.114995',
										'area' => 'Samar',
										'branch' => '2',
										'branchName' =>'Paranas, Samar'
				]); 

		DB::table('branches')->insert([	'latitude' => '11.257028',
										'longitude' => '125.400639',
										'area' => 'Samar',
										'branch' => '3',
										'branchName' =>'Balangiga, Samar'
				]); 

		DB::table('branches')->insert([	'latitude' => '11.230090',
										'longitude' => '124.604131',
										'area' => 'Leyte',
										'branch' => '1',
										'branchName' =>'Capoocan, Samar'
				]); 

		DB::table('branches')->insert([	'latitude' => '10.804128',
										'longitude' => '124.845830',
										'area' => 'Leyte',
										'branch' => '2',
										'branchName' =>'Baybay City, Leyte'
				]); 

		DB::table('branches')->insert([	'latitude' => '10.291097',
										'longitude' => '124.873296',
										'area' => 'Leyte',
										'branch' => '3',
										'branchName' =>'Maasin City, Leyte'
				]); 

		DB::table('branches')->insert([	'latitude' => '11.709217',
										'longitude' => '122.170659',
										'area' => 'Iloilo',
										'branch' => '1',
										'branchName' =>'Kalibo, Aklan'
				]); 

		DB::table('branches')->insert([	'latitude' => '11.160037',
										'longitude' => '122.692510',
										'area' => 'Iloilo',
										'branch' => '2',
										'branchName' =>'Passi City, Iloilo'
				]); 

		DB::table('branches')->insert([	'latitude' => '10.717783',
										'longitude' => '122.242070',
										'area' => 'Iloilo',
										'branch' => '3',
										'branchName' =>'Miagao, Iloilo'
				]); 

		DB::table('branches')->insert([	'latitude' => '10.879660',
										'longitude' => '123.362676',
										'area' => 'Negros',
										'branch' => '1',
										'branchName' =>'Sagay City, Negros Occidental'
				]); 

		DB::table('branches')->insert([	'latitude' => '10.188390',
										'longitude' => '123.060552',
										'area' => 'Negros',
										'branch' => '2',
										'branchName' =>'Guihulngan City, Negros Oriental'
				]); 

		DB::table('branches')->insert([	'latitude' => '9.295097',
										'longitude' => '123.022100',
										'area' => 'Negros',
										'branch' => '3',
										'branchName' =>'Dumaguete City, Negros Oriental'
				]); 

		DB::table('branches')->insert([	'latitude' => '11.079187',
										'longitude' => '119.462529',
										'area' => 'Palawan',
										'branch' => '1',
										'branchName' =>'El Nido, Palawan'
				]); 

		DB::table('branches')->insert([	'latitude' => '9.950414',
										'longitude' => '118.709966',
										'area' => 'Palawan',
										'branch' => '2',
										'branchName' =>'Puerto Princesa City, Palawan'
				]); 

		DB::table('branches')->insert([	'latitude' => '8.676565',
										'longitude' => '117.380620',
										'area' => 'Palawan',
										'branch' => '3',
										'branchName' =>'Bataraza, Palawan'
				]); 

		DB::table('branches')->insert([	'latitude' => '9.678780',
										'longitude' => '123.894051',
										'area' => 'Bohol',
										'branch' => '1',
										'branchName' =>'Ubay, Bohol'
				]); 


		DB::table('branches')->insert([	'latitude' => '10.030567',
										'longitude' => '124.481820',
										'area' => 'Bohol',
										'branch' => '2',
										'branchName' =>'Tagbilaran City, Bohol'
				]); 

		DB::table('branches')->insert([	'latitude' => '8.469428',
										'longitude' => '125.774635',
										'area' => 'Davao',
										'branch' => '1',
										'branchName' =>'Bayugan City, Agusan Del Sur'
				]); 

		DB::table('branches')->insert([	'latitude' => '7.190598',
										'longitude' => '125.357154',
										'area' => 'Davao',
										'branch' => '2',
										'branchName' =>'Davao City'
				]); 

		DB::table('branches')->insert([	'latitude' => '6.170364',
										'longitude' => '124.769386',	
										'area' => 'Davao',
										'branch' => '3',
										'branchName' =>'General Santos, South Cotabato'
				]); 

		DB::table('branches')->insert([	'latitude' => '8.029087',
										'longitude' => '123.121437',
										'area' => 'Davao',
										'branch' => '4',
										'branchName' =>'Pagadian City, Zamboanga del Sur'
				]); 

		DB::table('branches')->insert([	'latitude' => '5.952695',
										'longitude' => '121.038997',
										'area' => 'Sulu',
										'branch' => '1',
										'branchName' =>'Talipao, Sulu'
				]); 
    }
}
