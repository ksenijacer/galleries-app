<?php

 namespace Database\Seeders;

 use Illuminate\Database\Seeder;
 use App\Models\User;
 use App\Models\Gallery;

 class AuthorSeeder extends Seeder
 {
     /**
      * Run the database seeds.
      *
      * @return void
      */
     public function run()
     {
         /// Used to create a user with 10+ galleries to check author page pagination :)
        User::factory()->has(Gallery::factory()->count(15)->hasImages(3))->create();
     }
 }