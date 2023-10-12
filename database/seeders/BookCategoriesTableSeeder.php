<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BookCategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('book_categories')->delete();
        
        \DB::table('book_categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Asseessment Guide',
                'position' => 0,
                'icon' => NULL,
                'is_feature' => 'No',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Classroom Resources',
                'position' => 0,
                'icon' => NULL,
                'is_feature' => 'No',
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
        
        
    }
}