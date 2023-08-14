<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        \App\Models\User::factory(20)->create();
        \App\Models\company::factory(20)->create();
        \App\Models\job::factory(20)->create();
        
        $categories=[
            'Technology',
            'Engineering',
            'Government',
            'Construction',
            'Medical',
            'Software',

        ];

        foreach( $categories as $category )
        {
            category::create(['name'=>$category]);
        }
    
    }
}
