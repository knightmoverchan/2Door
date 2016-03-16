<?php

use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
	    DB::table('users')->insert(
        [
            'email' => 'adminCebu1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Cebu',
            'branch' => '1' 
        ]);  

        DB::table('users')->insert(
        [
            'email' => 'adminCebu2@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Cebu',
            'branch' => '2' 
        ]);               

        DB::table('users')->insert(
        [
            'email' => 'adminCebu3@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Cebu',
            'branch' => '3' 
        ]);                       

        DB::table('users')->insert(
        [
            'email' => 'adminLuzon1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Luzon',
            'branch' => '1' 
        ]);                       

        DB::table('users')->insert(
        [
            'email' => 'adminLuzon2@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Luzon',
            'branch' => '2' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminLuzon3@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Luzon',
            'branch' => '3' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminLuzon4@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Luzon',
            'branch' => '4' 
        ]);  

        DB::table('users')->insert(
        [
            'email' => 'adminVigan1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Vigan',
            'branch' => '1' 
        ]);  

        DB::table('users')->insert(
        [
            'email' => 'adminMarinduque1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Marinduque',
            'branch' => '1' 
        ]);  

        DB::table('users')->insert(
        [
            'email' => 'adminMindoro1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Mindoro',
            'branch' => '1' 
        ]);  

        DB::table('users')->insert(
        [
            'email' => 'adminMindoro2@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Mindoro',
            'branch' => '2' 
        ]);  

        DB::table('users')->insert(
        [
            'email' => 'adminMindoro3@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Mindoro',
            'branch' => '3' 
        ]);  

        DB::table('users')->insert(
        [
            'email' => 'adminMasbate1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Masbate',
            'branch' => '1' 
        ]);  

        DB::table('users')->insert(
        [
            'email' => 'adminMasbate2@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Masbate',
            'branch' => '2' 
        ]);  

        DB::table('users')->insert(
        [
            'email' => 'adminSamar1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Samar',
            'branch' => '1' 
        ]);  

        DB::table('users')->insert(
        [
            'email' => 'adminSamar2@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Samar',
            'branch' => '2' 
        ]);  

        DB::table('users')->insert(
        [
            'email' => 'adminSamar3@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Samar',
            'branch' => '3' 
        ]); 

        DB::table('users')->insert(
        [
            'email' => 'adminTacloban1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Tacloban',
            'branch' => '1' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminTacloban2@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Tacloban',
            'branch' => '2' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminTacloban3@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Tacloban',
            'branch' => '3' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminIloilo1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Iloilo',
            'branch' => '1' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminIloilo2@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Iloilo',
            'branch' => '2' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminIloilo3@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Iloilo',
            'branch' => '3' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminNegros1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Negros',
            'branch' => '1' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminNegros2@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Negros',
            'branch' => '2' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminNegros3@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Negros',
            'branch' => '3' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminPalawan1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Palawan',
            'branch' => '1' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminPalawan2@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Palawan',
            'branch' => '2' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminPalawan3@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Palawan',
            'branch' => '3' 
        ]);
                
        DB::table('users')->insert(
        [
            'email' => 'adminBohol1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Bohol',
            'branch' => '1' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminBohol2@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Bohol',
            'branch' => '2' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminDavao1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Davao',
            'branch' => '1' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminDavao2@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Davao',
            'branch' => '2' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminDavao3@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Davao',
            'branch' => '3' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminDavao4@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Davao',
            'branch' => '4' 
        ]);

        DB::table('users')->insert(
        [
            'email' => 'adminSulu1@gmail.com',
            'password' => bcrypt('123123'),
            'user_type' => 'Admin',
            'area' => 'Sulu',
            'branch' => '1' 
        ]);
    }
}
