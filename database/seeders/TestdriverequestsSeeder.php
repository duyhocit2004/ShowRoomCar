<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TestdriverequestsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $list = ['Lái thử tại showroom' , 'Tư vấn qua điện thoại'];

       for ($i=0; $i < 2 ; $i++) { 
          DB::table('testdrivemethod')->insert([
            'name' => $list[$i]
        ]);
       }
      
    }
}
