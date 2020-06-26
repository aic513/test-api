<?php

use Illuminate\Database\Seeder;

/**
 * Class IndicatorSeeder
 */
class IndicatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Indicator::class, 50)->create();
    }
}
