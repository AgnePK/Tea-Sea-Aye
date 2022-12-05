<?php

namespace Database\Seeders;

use App\Models\Store;
use App\Models\Tea;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class StoreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Store::factory()->times(3)->create();

        //The foreach is backwards in a video on laravel i watched.

        foreach (Tea::all() as $tea) {
            $stores = store::inRandomOrder()->take(rand(1, 3))->pluck('id');
            $tea->stores()->attach($stores);
        }
    }
}
