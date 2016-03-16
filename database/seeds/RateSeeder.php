<?php

use Illuminate\Database\Seeder;

class RateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        DB::table('rates')->insert(['type' => '1pounder',
                                    'excess' =>'500',
                                    'rate' => '120',
                                    'weight' => '500',
                                    'ecost' => '60',
                                    'image' => '1pounder.png'
                                    ]);

        DB::table('rates')->insert(['type' => '3pounder',
                                    'excess' =>'500',
                                    'rate' => '220',
                                    'weight' => '1500',
                                    'ecost' => '110',
                                    'image' => '3pounder.png'
                                    ]);

        DB::table('rates')->insert(['type' => '5pounder',
                                    'excess' =>'500',
                                    'rate' => '253',
                                    'weight' => '2500', 
                                    'ecost' => '126.5',
                                    'image' => '5pounder.png'
                                    ]);

        DB::table('rates')->insert(['type' => 'ExtraSmallBox',
                                    'excess' =>'1000',
                                    'rate' => '420',
                                    'weight' => '4000',
                                    'ecost' => '100',
                                    'image' => 'ExtraSmallBox.png'
                                    ]);

        DB::table('rates')->insert(['type' => 'ExpressBoxSmall',
                                    'excess' =>'1000',
                                    'rate' => '350',
                                    'weight' => '3000',
                                    'ecost' => '60',
                                    'image' => 'ExpressBoxSmall.png'
                                    ]);

        DB::table('rates')->insert(['type' => 'ExpressBoxMedium',
                                    'excess' =>'1000',
                                    'rate' => '750',
                                    'weight' => '6000',
                                    'ecost' => '160',
                                    'image' => 'ExpressBoxMedium.png'
                                    ]);

        DB::table('rates')->insert(['type' => 'ExpressBoxLarge',
                                    'excess' =>'1000',
                                    'rate' => '1600',
                                    'weight' => '10000',
                                    'ecost' => '320',
                                    'image' => 'ExpressBoxLarge.png'
                                    ]);

        DB::table('rates')->insert(['type' => 'GeneralCargo',
                                    'excess' =>'500',
                                    'rate' => '165',
                                    'weight' => '3000',
                                    'ecost' => '82.5',
                                    'image' => 'GeneralCargo.png'
                                    ]);
                                    
    }
}
