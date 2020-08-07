<?php

use Illuminate\Database\Seeder;

class companyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Company::class, 15)->create();
    }
}
