<?php

namespace Database\Seeders;

use App\Models\Priority;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrioritySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $priorities=['Highest','High','Medium','Low','Lowest'];

        foreach ($priorities as $priority){
            Priority::create(['name'=>$priority]);

        }

    }
}
