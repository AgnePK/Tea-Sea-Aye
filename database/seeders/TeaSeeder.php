<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Tea;

class TeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    // telling it to insert 10 rows of data into my db using the TeaFactory.
    {
        Tea::factory()->times(5)->create();
    }
}
