<?php

namespace Database\Seeders;

use App\Models\Todo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TodosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        if (Todo::count() > 0) {
            
            return;
        }
        $todos = [

            [
                
                'title' => 'Brush My Teeth',  
            ],

            [
                
                'title' => 'make breakfast',  
            ],

            [
                
                'title' => 'eat breakfast',  
            ],

            
        ];
        foreach ($todos as $todo) {
            Todo::create($todo);
        }
    }
}